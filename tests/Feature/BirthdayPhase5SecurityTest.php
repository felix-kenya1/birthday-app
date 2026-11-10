<?php

namespace Tests\Feature;

use Tests\TestCase;

class BirthdayPhase5SecurityTest extends TestCase
{
    public function test_admin_dashboard_requires_authentication(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/admin/login');
    }

    public function test_public_birthday_page_is_available_and_has_security_headers(): void
    {
        $this->get('/birthday')
            ->assertOk()
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'DENY')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_sitemap_is_xml(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function test_admin_responses_are_not_cacheable(): void
    {
        $this->get('/admin/login')
            ->assertOk()
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow, noarchive')
            ->assertHeader('Cache-Control', 'no-store, no-cache, must-revalidate, private');
    }
}
