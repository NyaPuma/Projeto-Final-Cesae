<?php

namespace App\Http\Controllers;

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
     */
    public function switchLang(string $locale)
    {
        if (in_array($locale, ['en', 'pt'])) {
            session(['locale' => $locale]);

            return redirect()->route('ui.login')->withCookie(cookie()->forever('locale', $locale));
        }

        return redirect()->route('ui.login');
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
