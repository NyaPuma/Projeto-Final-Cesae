<?php

namespace Tests\Performance\Auth;

use Illuminate\Support\Facades\Hash;
use Tests\Performance\PerformanceTestCase;

class AuthPerformanceTest extends PerformanceTestCase
{
    private const MAX_LOGIN_MS = 250;

    public function test_login_response_time(): void
    {
        $password = 'TestPassword123!';
        $this->commonUser->update(['password' => Hash::make($password)]);

        $this->startQueryLog();

        $time = $this->measureTime(function () use ($password) {
            $this->postJson('/login', [
                'email' => $this->commonUser->email,
                'password' => $password,
            ])->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(800, $time,
            "POST /login took {$time}ms, exceeds 800ms");
        $this->assertLessThanOrEqual(10, count($queries),
            'Login should use 10 or fewer queries, used '.count($queries));
    }

    public function test_login_invalid_credentials_response_time(): void
    {
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->postJson('/api/login', [
                'email' => 'nonexistent@example.com',
                'password' => 'wrongpassword',
            ])->assertStatus(401);
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(self::MAX_LOGIN_MS, $time,
            "Failed login took {$time}ms");
        $this->assertLessThanOrEqual(5, count($queries));
    }

    public function test_logout_response_time(): void
    {
        $this->asUser();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->postJson('/logout')->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(self::MAX_LOGIN_MS, $time,
            "POST /logout took {$time}ms");
        $this->assertLessThanOrEqual(5, count($queries));
    }

    public function test_register_response_time(): void
    {
        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->postJson('/admin/users/register', [
                'name' => 'New User Perf',
                'email' => 'new-user-perf-'.uniqid().'@test.com',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
            ])->assertStatus(201);
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(500, $time,
            "POST /admin/users/register took {$time}ms");
    }

    public function test_multiple_consecutive_logins(): void
    {
        $password = 'TestPassword123!';
        $this->commonUser->update(['password' => Hash::make($password)]);

        $totalTime = $this->measureTime(function () use ($password) {
            for ($i = 0; $i < 20; $i++) {
                $this->postJson('/login', [
                    'email' => $this->commonUser->email,
                    'password' => $password,
                ])->assertOk();
            }
        });

        $avgTime = $totalTime / 20;

        $this->assertLessThanOrEqual(self::MAX_LOGIN_MS, $avgTime,
            "Average login time was {$avgTime}ms across 20 requests");
    }

    public function test_middleware_auth_overhead(): void
    {
        $this->seedRooms(2);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/api/rooms')->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(self::MAX_LOGIN_MS, $time,
            "Authenticated request took {$time}ms (includes middleware overhead)");
        $this->assertLessThanOrEqual(5, count($queries),
            'Authenticated request should use minimal queries for auth');
    }

    public function test_unauthenticated_request_overhead(): void
    {
        $time = $this->measureTime(function () {
            $this->getJson('/api/tickets')->assertStatus(401);
        });

        $this->assertLessThanOrEqual(100, $time,
            "Unauthenticated rejection took {$time}ms");
    }

    public function test_password_change_response_time(): void
    {
        $password = 'TestPassword123!';
        $this->commonUser->update(['password' => Hash::make($password)]);

        $this->asUser();

        $time = $this->measureTime(function () use ($password) {
            $this->postJson('/password/change', [
                'current_password' => $password,
                'new_password' => 'NewPassword456!',
            ])->assertOk();
        });

        $this->assertLessThanOrEqual(700, $time,
            "POST /password/change took {$time}ms");
    }
}
