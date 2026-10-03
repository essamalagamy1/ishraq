<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CanonicalDomainTest extends TestCase
{
    use RefreshDatabase;
    public function test_www_requests_are_permanently_redirected_to_non_www(): void
    {
        $response = $this->get('https://www.ishraq.tech/services');

        $response->assertStatus(301);
        $response->assertRedirect('https://ishraq.tech/services');
    }

    public function test_non_www_requests_pass_through_normally(): void
    {
        $response = $this->get('https://ishraq.tech/services');

        $response->assertStatus(200);
    }
}
