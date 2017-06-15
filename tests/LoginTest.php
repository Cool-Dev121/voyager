<?php

namespace TCG\Voyager\Tests;

class LoginTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->install();
    }

    public function testSuccessfulLoginWithDefaultCredentials()
    {
        $this->visit(route('voyager.login'));
        $this->type('admin@admin.com', 'email');
        $this->type('password', 'password');
        $this->press(trans('voyager.generic_login'));
        $this->seePageIs(route('voyager.dashboard'));
    }

    public function testShowAnErrorMessageWhenITryToLoginWithWrongCredentials()
    {
        $this->visit(route('voyager.login'))
             ->type('john@Doe.com', 'email')
             ->type('pass', 'password')
             ->press(trans('voyager.generic_login'))
             ->seePageIs(route('voyager.login'))
             ->see(trans('auth.failed'))
             ->seeInField('email', 'john@Doe.com');
    }
}
