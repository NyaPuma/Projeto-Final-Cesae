<?php

namespace Tests\Unit\Mail;

use App\Mail\PasswordResetMail;
use App\Mail\TestMail;
use App\Mail\TicketCreated;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class MailablesTest extends FeatureTestCase
{
    use CreatesTickets;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();
    }

    #[Test]
    public function test_mail_has_subject_and_renders_the_recipient_name(): void
    {
        $mail = new TestMail('Utilizador Teste');

        $this->assertSame('Teste de Envio de E-mail', $mail->envelope()->subject);
        $this->assertStringContainsString('Utilizador Teste', $mail->render());
    }

    #[Test]
    public function password_reset_mail_has_subject_and_renders_the_reset_url(): void
    {
        $mail = new PasswordResetMail('token-abc');

        $this->assertSame('Recuperação de Credenciais', $mail->envelope()->subject);

        $rendered = $mail->render();

        $this->assertStringContainsString(
            route('api.password.reset.form', ['token' => 'token-abc']),
            $rendered,
        );
    }

    #[Test]
    public function ticket_created_mail_has_subject_and_renders_the_ticket_title(): void
    {
        $ticket = $this->createTicket(['title' => 'Máquina avariada']);

        $mail = new TicketCreated($ticket);

        $this->assertSame("Nova avaria registada [#{$ticket->id}]", $mail->envelope()->subject);
        $this->assertStringContainsString('Máquina avariada', $mail->render());
    }
}
