<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Controller para páginas estáticas e utilitárias
 * que anteriormente usavam closures nas rotas.
 *
 * Consolidar aqui permite que php artisan route:cache funcione.
 */
class PageController extends Controller
{
    /**
     * Página inicial (landing page).
     */
    public function home()
    {
        return view('main');
    }

    /**
     * Alternar idioma da aplicação (pt / en).
     *
     * Se o utilizador já estiver autenticado (token presente no cookie),
     * redireciona para o painel em vez da página de login.
     */
    public function switchLang(Request $request, string $locale)
    {
        if (! in_array($locale, ['en', 'pt'])) {
            $locale = 'pt';
        }

        // Store the locale in session and set a permanent cookie
        session(['locale' => $locale]);
        $cookie = cookie()->forever('locale', $locale);

        // Check if user is authenticated by looking for the auth_token cookie
        $authToken = $request->cookie('api_token') ?: $request->cookie('auth_token');

        if ($authToken) {
            // User appears to be logged in — redirect to dashboard
            return redirect()->route('ui.index')->withCookie($cookie);
        }

        // Not authenticated — redirect to login page
        return redirect()->route('ui.login')->withCookie($cookie);
    }

    /**
     * Vista de login (formulário de autenticação).
     */
    public function login()
    {
        return view('ui.auth');
    }

    /**
     * Rota de teste de e-mail (apenas em ambientes não-produção).
     */
    public function testEmail()
    {
        if (app()->environment('production')) {
            abort(404);
        }

        Mail::raw('Teste de comunicação com Mailtrap!', function ($message) {
            $message->to('teste@exemplo.com')
                ->subject('Teste do Sistema de Avarias');
        });

        return 'E-mail enviado com sucesso!';
    }

    /**
     * Formulário de reset de password (API).
     */
    public function passwordResetForm(string $token)
    {
        return view('ui.auth-reset', ['token' => $token]);
    }
}
