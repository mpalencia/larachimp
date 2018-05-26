<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel + MailChimp')
             ->dontSee('Add member');
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test2()
    {
        $this->visit('/list/create')
             ->see('Create New List')
             ->dontSee('Edit');
    }

}
