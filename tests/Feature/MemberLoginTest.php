<?php

namespace Tests\Feature;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberLoginTest extends TestCase
{
    public function test_member_can_login()
    {
        $member = Member::where('membership_number', 'MS-2026-0001')->first();
        $this->assertNotNull($member, 'Test member not found');

        $response = $this->get(route('member.login'));
        $response->assertStatus(200);

        $response->assertSee('Member Portal');
        $response->assertSee('Membership Number');

        $captcha = session('member_captcha_answer');
        $this->assertNotNull($captcha, 'Captcha not set in session');

        $loginResponse = $this->post(route('member.login'), [
            'membership_number' => 'MS-2026-0001',
            'dob' => '1990-01-01',
            'captcha' => $captcha,
        ]);

        $loginResponse->assertRedirect(route('member.dashboard'));

        $this->assertEquals($member->id, session('member_id'));
    }

    public function test_invalid_credentials_fail()
    {
        $response = $this->get(route('member.login'));

        $captcha = session('member_captcha_answer');

        $loginResponse = $this->post(route('member.login'), [
            'membership_number' => 'MS-2026-0001',
            'dob' => '1900-01-01',
            'captcha' => $captcha,
        ]);

        $loginResponse->assertSessionHasErrors('membership_number');
    }

    public function test_wrong_captcha_fails()
    {
        $loginResponse = $this->post(route('member.login'), [
            'membership_number' => 'MS-2026-0001',
            'dob' => '1990-01-01',
            'captcha' => 999,
        ]);

        $loginResponse->assertSessionHasErrors('captcha');
    }
}
