<?php

namespace Tests\Feature;

use Tests\TestCase;

final class RuntimeRoutesTest extends TestCase
{
    public function test_anonymous_root_route_preserves_its_destination(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_public_entry_page_renders_without_a_database_connection(): void
    {
        $this->get('/admin/login')->assertOk();
    }
}
