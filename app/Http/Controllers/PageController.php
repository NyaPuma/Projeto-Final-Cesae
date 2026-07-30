<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Controller para páginas estáticas e utilitárias
 * que anteriormente usavam closures nas rotas.
 *
 * Consolidar aqui permite que php artisan route:cache funcione.
 */
final class PageController extends Controller
{
    /**
     * Página inicial (landing page).
     */
    public function home(): View
    {
        return view('main');
    }

    /**
     * Alternar idioma da aplicação (pt / en).
     *
     * Se o utilizador já estiver autenticado (token presente no cookie),
     * redireciona para o painel em vez da página de login.
     */
    public function switchLang(Request $request, string $locale): RedirectResponse
    {
        if (! in_array($locale, ['en', 'pt'], true)) {
            $locale = 'pt';
        }

        // Armazena o idioma na sessão e define um cookie permanente
        session(['locale' => $locale]);
        $cookie = cookie()->forever('locale', $locale);

        // Verifica se o utilizador está autenticado através dos cookies de sessão
        $authToken = $request->cookie('api_token') ?: $request->cookie('auth_token');

        if ($authToken) {
            // Utilizador autenticado — redireciona para o dashboard
            return redirect()->route('ui.index')->withCookie($cookie);
        }

        // Não autenticado — redireciona para a página de login
        return redirect()->route('ui.login')->withCookie($cookie);
    }

    /**
     * Vista de login (formulário de autenticação).
     */
    public function login(): View
    {
        return view('ui.auth');
    }

    /**
     * Rota de teste de e-mail (apenas em ambientes não-produção).
     */
    public function testEmail(): string
    {
        if (app()->environment('production')) {
            abort(404);
        }

        Mail::raw('Teste de comunicação com Mailtrap!', function ($message) {
            $message->to('teste@exemplo.com')
                ->subject('Teste do Sistema de Avarias');
        });

        return __('E-mail enviado com sucesso!');
    }

    /**
     * Formulário de reset de password (API).
     */
    public function passwordResetForm(string $token): View
    {
        return view('ui.auth-reset', ['token' => $token]);
    }
}
