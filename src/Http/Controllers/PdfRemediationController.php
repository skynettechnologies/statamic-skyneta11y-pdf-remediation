<?php

namespace Skynettechnologies\StatamicSkynetA11yPdfRemediation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Statamic\Http\Controllers\CP\CpController;

class PdfRemediationController extends CpController
{
    /**
     * The Control Panel page.
     *
     * Without ?frame=1 it renders inside the Statamic layout (keeping the CP
     * nav, header and breadcrumb) and embeds the dashboard in a same-origin
     * iframe, so the dashboard's own CSS/JS are isolated from the CP.
     *
     * With ?frame=1 it renders the standalone dashboard the iframe loads.
     */
    public function index(Request $request)
    {
        // Enforce the permission on the controller too, not just the nav item,
        // so a user without access cannot open the page or the ?frame=1 URL
        // directly and see the provisioning config. Super users pass via can().
        $user = $request->user();
        abort_unless(
            $user && $user->can('skynettechnologies/statamic-skyneta11y-pdf-remediation.access'),
            403
        );

        if ($request->boolean('frame')) {
            return $this->renderDashboard($request);
        }

        return view(
            'skynettechnologies/statamic-skyneta11y-pdf-remediation::wrapper',
            [
                'frame_url' => cp_route(
                    'skynettechnologies.statamic_skyneta11y_pdf_remediation.dashboard',
                    ['frame' => 1]
                ),
            ]
        );
    }

    /**
     * Render the standalone dashboard. The dashboard provisions the account
     * client-side, so here we only resolve the identity to inject
     * (name / email / domain) plus the configured API settings. When both email
     * and website are present the dashboard connects on load and skips the
     * "account details" dialog.
     */
    protected function renderDashboard(Request $request)
    {
        [$name, $email] = $this->resolveUser();

        return view(
            'skynettechnologies/statamic-skyneta11y-pdf-remediation::dashboard',
            [
                'website'       => $request->getHost(),
                'user_name'     => $name,
                'user_email'    => $email,
                'api_base'      => rtrim(config('skynet-pdf-remediation.api_base'), '/'),
                'session_url'   => config('skynet-pdf-remediation.session_url', ''),
                'dashboard_url' => rtrim(config('skynet-pdf-remediation.dashboard_url'), '/'),
                'plan_id'       => config('skynet-pdf-remediation.plan_id', 'free'),
                'country'       => config('skynet-pdf-remediation.country', 'US'),
            ]
        );
    }

    /**
     * Resolve the current admin/logged-in user's name and email in a way that
     * works whether Auth::user() returns a Statamic user (name()/email()
     * methods) or a plain Eloquent user (name/email attributes). Falls back to
     * the site's configured mail "from" identity. Empty strings are fine — the
     * dashboard simply shows its details dialog when it cannot connect.
     */
    protected function resolveUser(): array
    {
        $user = Auth::user();

        $name = null;
        $email = null;

        if ($user) {
            $name = method_exists($user, 'name') ? $user->name() : ($user->name ?? null);
            $email = method_exists($user, 'email') ? $user->email() : ($user->email ?? null);
        }

        $name = $name ?: (config('mail.from.name') ?: '');
        $email = $email ?: (config('mail.from.address') ?: '');

        return [$name, $email];
    }
}
