<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountsTest extends TestCase
{
    public function test_home_return_a_succesfull_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('/');
    }

    public function test_accounts_return_a_succesful_response(): void
    {
        $response = $this->get('/accounts');

        $response->assertStatus(200);

        $response->assertSee('accounts');
    }

    public function test_reports_view_a_successfull_response(): void
    {
        $response = $this->get('/reports/view');

        $response->assertStatus(200);

        $response->assertSee('reports.view');
    }
    


}
