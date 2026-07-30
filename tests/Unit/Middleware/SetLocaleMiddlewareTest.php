<?php

namespace Tests\Unit;

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
        $request->cookies->set('locale', 'en');

        $middleware->handle($request, function ($req) {
            $this->assertEquals('en', App::getLocale());

            return response('OK');
        });
    }

    public function test_fallback_to_pt_when_invalid_locale()
    {
        $middleware = new SetLocaleMiddleware;
        $request = Request::create('/', 'GET');
        $request->cookies->set('locale', 'fr');

        $middleware->handle($request, function ($req) {
            $this->assertEquals('pt', App::getLocale());

            return response('OK');
        });
    }
}
