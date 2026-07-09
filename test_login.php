<?php

// Testar o fluxo de login
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Criar uma instância do kernel HTTP
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Testar uma requisição de login
echo "Testando fluxo de login...\n";

// Simular uma requisição POST para /login
$response = $kernel->handle(
    $request = Illuminate\Http\Request::create('/login', 'POST', [
        'email' => 'test@example.com',
        'password' => 'password123'
    ], [], [], [
        'CONTENT_TYPE' => 'application/json',
        'ACCEPT' => 'application/json'
    ])
);

echo "Status: " . $response->status() . "\n";
echo "Content: " . $response->getContent() . "\n";

// Testar uma requisição para /ui com token
$token = 'test_token_123';
echo "\nTestando acesso a /ui com token...\n";

$response = $kernel->handle(
    $request = Illuminate\Http\Request::create('/ui', 'GET', [], [], [], [
        'HTTP_X-AUTH-TOKEN' => $token,
        'HTTP_ACCEPT' => 'text/html'
    ])
);

echo "Status: " . $response->status() . "\n";
echo "Content: " . substr($response->getContent(), 0, 200) . "...\n";