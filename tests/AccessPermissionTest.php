<?php

namespace Skynettechnologies\StatamicSkynetA11yPdfRemediation\Tests;

use Statamic\Facades\User;

class AccessPermissionTest extends TestCase
{
    private string $url = '/cp/skynettechnologies/statamic-skyneta11y-pdf-remediation';

    /** @test */
    public function a_user_without_the_permission_is_forbidden_on_the_page(): void
    {
        $user = User::make()->email('editor@example.com')->makeSuper(false)->save();

        $this->actingAs($user)->get($this->url)->assertForbidden();
    }

    /** @test */
    public function a_user_without_the_permission_is_forbidden_on_the_frame(): void
    {
        $user = User::make()->email('editor2@example.com')->makeSuper(false)->save();

        $this->actingAs($user)->get($this->url.'?frame=1')->assertForbidden();
    }

    /** @test */
    public function a_super_user_can_open_the_page(): void
    {
        $user = User::make()->email('admin@example.com')->makeSuper()->save();

        $this->actingAs($user)->get($this->url)->assertOk();
    }
}