<?php

namespace Skynettechnologies\StatamicSkynetA11yPdfRemediation\Tests;

use Skynettechnologies\StatamicSkynetA11yPdfRemediation\ServiceProvider;
use Statamic\Testing\AddonTestCase;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
