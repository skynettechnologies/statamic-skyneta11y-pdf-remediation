<?php

namespace Skynettechnologies\StatamicSkynetA11yPdfRemediation;

use Illuminate\Support\Facades\File;
use Skynettechnologies\StatamicSkynetA11yPdfRemediation\Commands\CopyAssets;
use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php',
    ];

    protected $commands = [
        CopyAssets::class,
    ];

    /**
     * NOTE: We intentionally do NOT register global CP css/js here. The
     * dashboard loads its own (non-CP) stylesheet and scripts, which would
     * clash with the Statamic Control Panel if injected on every page. The
     * dashboard.blade.php view loads them inside an iframe instead.
     */

    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(
            __DIR__ . '/../config/skynet-pdf-remediation.php',
            'skynet-pdf-remediation'
        );
    }

    public function boot()
    {
        parent::boot();

        // Register permission for the addon
        $this->registerPermissions();

        // Register nav + views once Statamic has fully booted. This MUST be
        // done from boot() (not bootAddon()) so the callback is queued before
        // Statamic::runBootedCallbacks() iterates; registering it from
        // bootAddon() appends to the callback list mid-iteration and it is
        // silently dropped, so the nav item would never appear.
        Statamic::booted(function () {
            $this->bootNavigation();
            $this->loadViewsFrom(
                __DIR__ . '/../resources/views',
                'skynettechnologies/statamic-skyneta11y-pdf-remediation'
            );
        });
    }

    /**
     * Register the navigation item in the Control Panel Tools sidebar.
     */
    protected function bootNavigation(): void
    {
        Nav::extend(function ($nav) {
            $svgPath = __DIR__ . '/../resources/public/images/logo.svg';
            $icon = 'assets';
            if (File::exists($svgPath)) {
                // Drop the fixed width/height so the CP can size the icon via CSS.
                $icon = preg_replace('/\s(width|height)="[^"]*"/', '', File::get($svgPath));
            }

            $nav->create('SkynetA11y PDF Remediation')
                ->can('skynettechnologies/statamic-skyneta11y-pdf-remediation.access')
                ->route('skynettechnologies.statamic_skyneta11y_pdf_remediation.dashboard')
                ->section('Tools')
                ->icon($icon);
        });
    }

    /**
     * Register addon permission.
     */
    protected function registerPermissions(): void
    {
        Permission::register('skynettechnologies/statamic-skyneta11y-pdf-remediation.access')
            ->label('Access SkynetA11y PDF Remediation');
    }

    /**
     * Publish config + public assets.
     */
    protected function bootPublishables(): self
    {
        parent::bootPublishables();

        $this->publishes([
            __DIR__ . '/../config/skynet-pdf-remediation.php' => config_path('skynet-pdf-remediation.php'),
        ], 'skynettechnologies/statamic-skyneta11y-pdf-remediation-config');

        $this->publishes([
            __DIR__ . '/../resources/public' => public_path('vendor/skynettechnologies/statamic-skyneta11y-pdf-remediation'),
        ], 'skynettechnologies/statamic-skyneta11y-pdf-remediation-assets');

        return $this;
    }
}
