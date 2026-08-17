<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\SetLocaleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class SetLocaleMiddlewareTest extends TestCase
{
    public function test_sets_locale_from_cookie()
    {
        $middleware = new SetLocaleMiddleware;
        $request = Request::create('/', 'GET');
        $request->cookies->set('locale', 'en-GB');

        $middleware->handle($request, function ($req) {
            $this->assertSame('en-GB', App::getLocale());

            return response('OK');
        });
    }

    public function test_sets_locale_from_session_when_no_cookie()
    {
        $middleware = new SetLocaleMiddleware;
        $request = Request::create('/', 'GET');
        $request->setLaravelSession(app('session')->driver());

        session(['locale' => 'pt-PT']);

        $middleware->handle($request, function ($req) {
            $this->assertSame('pt-PT', App::getLocale());

            return response('OK');
        });
    }

    public function test_session_takes_precedence_over_cookie()
    {
        $middleware = new SetLocaleMiddleware;
        $request = Request::create('/', 'GET');
        $request->cookies->set('locale', 'en-US');
        $request->setLaravelSession(app('session')->driver());

        session(['locale' => 'pt-PT']);

        $middleware->handle($request, function ($req) {
            $this->assertSame('pt-PT', App::getLocale());

            return response('OK');
        });
    }

    public function test_sanitizes_unsupported_locale_from_session()
    {
        $middleware = new SetLocaleMiddleware;
        $request = Request::create('/', 'GET');
        $request->setLaravelSession(app('session')->driver());

        session(['locale' => 'zz-ZZ']);

        $middleware->handle($request, function ($req) {
            $this->assertSame('pt-PT', App::getLocale());

            return response('OK');
        });
    }

    public function test_uses_browser_preference_when_no_cookie_or_session()
    {
        $middleware = new SetLocaleMiddleware;
        $request = Request::create('/', 'GET', [], [], [], [
            'HTTP_ACCEPT_LANGUAGE' => 'en-GB,en;q=0.9,pt;q=0.8',
        ]);

        $middleware->handle($request, function ($req) {
            $this->assertSame('en-GB', App::getLocale());

            return response('OK');
        });
    }

    public function test_browser_preference_matches_base_language()
    {
        $middleware = new SetLocaleMiddleware;
        $request = Request::create('/', 'GET', [], [], [], [
            'HTTP_ACCEPT_LANGUAGE' => 'en;q=0.9,pt;q=0.8',
        ]);

        $middleware->handle($request, function ($req) {
            $this->assertSame('en-GB', App::getLocale());

            return response('OK');
        });
    }

    public function test_falls_back_to_default_when_preference_unsupported()
    {
        $middleware = new SetLocaleMiddleware;
        $request = Request::create('/', 'GET', [], [], [], [
            'HTTP_ACCEPT_LANGUAGE' => 'xx-XX,zz;q=0.9',
        ]);

        $middleware->handle($request, function ($req) {
            $this->assertSame('pt-PT', App::getLocale());

            return response('OK');
        });
    }

    public function test_falls_back_to_default_when_no_preference_at_all()
    {
        $middleware = new SetLocaleMiddleware;
        $request = Request::create('/', 'GET', [], [], [], [
            'HTTP_ACCEPT_LANGUAGE' => '',
        ]);

        $middleware->handle($request, function ($req) {
            $this->assertSame('pt-PT', App::getLocale());

            return response('OK');
        });
    }
}
