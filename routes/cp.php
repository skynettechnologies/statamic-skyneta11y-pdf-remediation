<?php

use Illuminate\Support\Facades\Route;
use Skynettechnologies\StatamicSkynetA11yPdfRemediation\Http\Controllers\PdfRemediationController;

Route::prefix('skynettechnologies/statamic-skyneta11y-pdf-remediation')
    ->name('skynettechnologies.statamic_skyneta11y_pdf_remediation.')
    ->group(function () {
        // Single CP route. Without ?frame=1 it renders the Statamic layout
        // wrapper; with ?frame=1 it renders the standalone dashboard that the
        // wrapper embeds in an iframe.
        Route::get('/', [PdfRemediationController::class, 'index'])->name('dashboard');
    });
