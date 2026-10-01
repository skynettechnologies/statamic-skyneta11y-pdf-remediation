<?php

namespace Skynettechnologies\StatamicSkynetA11yPdfRemediation\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Statamic\Console\RunsInPlease;

class CopyAssets extends Command
{
    use RunsInPlease;

    protected $signature = 'skynet-pdf-remediation:copy-assets';

    protected $description = 'Copy the SkynetA11y PDF Remediation addon assets to the public folder';

    public function handle()
    {
        $from = __DIR__ . '/../../resources/public';
        $to = public_path('vendor/skynettechnologies/statamic-skyneta11y-pdf-remediation');

        File::ensureDirectoryExists($to);
        File::copyDirectory($from, $to);

        $this->info('SkynetA11y PDF Remediation assets copied to: ' . $to);

        return self::SUCCESS;
    }
}
