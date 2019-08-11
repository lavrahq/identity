<?php

namespace Tests\Browser\Auth;

use App\Entities\LoginAttempt;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Auth\Login\Index;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use WithFaker;

    /**
     * Tests that a blank LoginAttempt is created upon visiting
     * the login index page.
     *
     * @return void
     */
    public function test_that_a_cookie_is_created()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('auth.login.index'))
                ->assertHasCookie('idltoken', true);
        });
    }

    /**
     * Tests that a blank LoginAttempt is created upon visiting
     * the login index page and that the LoginAttempt is blank.
     *
     * @return void
     */
    public function test_that_email_sent_page_is_displayed_on_first_logon()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('auth.login.index'))
                ->type('@email', $this->faker->email)
                ->click('@continue')
                ->assertSee('verification link');
        });
    }
}
