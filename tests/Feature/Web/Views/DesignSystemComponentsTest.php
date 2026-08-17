<?php

namespace Tests\Feature\Web\Views;

use Illuminate\Support\ViewErrorBag;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DesignSystemComponentsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    private function renderBlade(string $blade, array $data = []): string
    {
        \Illuminate\Support\Facades\View::share('errors', new ViewErrorBag);

        return $this->blade($blade, array_merge(['errors' => new ViewErrorBag], $data));
    }

    #[Test]
    public function button_component_renders_default_and_anchor_variants(): void
    {
        $html = $this->renderBlade('<x-button.button>Guardar</x-button.button>');

        $this->assertStringContainsString('<button', $html);
        $this->assertStringContainsString('ui-button--primary', $html);
        $this->assertStringContainsString('Guardar', $html);

        $link = $this->renderBlade('<x-button.button href="/ui/tickets" variant="secondary">Voltar</x-button.button>');

        $this->assertStringContainsString('href="/ui/tickets"', $link);
        $this->assertStringContainsString('ui-button--secondary', $link);
    }

    #[Test]
    public function button_component_renders_loading_and_disabled_states(): void
    {
        $html = $this->renderBlade('<x-button.button loading disabled>Processar</x-button.button>');

        $this->assertStringContainsString('ui-button--loading', $html);
        $this->assertStringContainsString('ui-button--disabled', $html);
        $this->assertStringContainsString('disabled="disabled"', $html);
        $this->assertStringContainsString('aria-busy="true"', $html);
    }

    #[Test]
    public function card_component_renders_content_and_link_state(): void
    {
        $html = $this->renderBlade('<x-card.card>Conteúdo do cartão</x-card.card>');

        $this->assertStringContainsString('ui-card', $html);
        $this->assertStringContainsString('Conteúdo do cartão', $html);

        $link = $this->renderBlade('<x-card.card href="/ui/rooms/1">Sala 1</x-card.card>');

        $this->assertStringContainsString('href="/ui/rooms/1"', $link);
        $this->assertStringContainsString('Sala 1', $link);
    }

    #[Test]
    public function card_component_renders_loading_skeleton_state(): void
    {
        $html = $this->renderBlade('<x-card.card loading>A carregar...</x-card.card>');

        $this->assertStringContainsString('ui-card--loading', $html);
        $this->assertStringContainsString('aria-busy="true"', $html);
        $this->assertStringContainsString('ui-card-skeleton', $html);
        $this->assertStringContainsString('A carregar...', $html);
    }

    #[Test]
    public function badge_component_renders_label_dot_and_pill_variants(): void
    {
        $html = $this->renderBlade('<x-card.badge variant="success" dot pill>Ativo</x-card.badge>');

        $this->assertStringContainsString('ui-card-badge--success', $html);
        $this->assertStringContainsString('ui-card-badge--pill', $html);
        $this->assertStringContainsString('ui-card-badge--has-dot', $html);
        $this->assertStringContainsString('Ativo', $html);
    }

    #[Test]
    public function alert_component_renders_title_and_slot_content(): void
    {
        $html = $this->renderBlade(
            '<x-card.alert variant="danger" title="Erro">Verifique os dados.</x-card.alert>'
        );

        $this->assertStringContainsString('ui-card-alert--danger', $html);
        $this->assertStringContainsString('Erro', $html);
        $this->assertStringContainsString('Verifique os dados.', $html);
    }

    #[Test]
    public function input_component_renders_label_hint_and_error_state(): void
    {
        $html = $this->renderBlade(
            '<x-input.input name="email" label="E-mail" placeholder="a@b.pt" required hint="Será usado para login" />'
        );

        $this->assertStringContainsString('ui-input-field', $html);
        $this->assertStringContainsString('E-mail', $html);
        $this->assertStringContainsString('required', $html);
        $this->assertStringContainsString('Será usado para login', $html);
        $this->assertStringContainsString('aria-invalid="false"', $html);

        $errors = new ViewErrorBag;
        $errors->put('default', new \Illuminate\Support\MessageBag(['email' => 'O campo e-mail é obrigatório.']));

        \Illuminate\Support\Facades\View::share('errors', $errors);

        $errorHtml = $this->blade('<x-input.input name="email" label="E-mail" />');

        $this->assertStringContainsString('ui-input-field--error', $errorHtml);
        $this->assertStringContainsString('aria-invalid="true"', $errorHtml);
        $this->assertStringContainsString('O campo e-mail é obrigatório.', $errorHtml);
    }

    #[Test]
    public function pill_component_renders_tone_and_text(): void
    {
        $html = $this->renderBlade('<x-ui.text.pill tone="success">Concluído</x-ui.text.pill>');

        $this->assertStringContainsString('Concluído', $html);
    }

    #[Test]
    public function page_header_partial_renders_header_and_slot(): void
    {
        $html = $this->renderBlade(
            '<x-ui.partials.page-header title="Painel" subtitle="Resumo geral">Corpo do painel</x-ui.partials.page-header>'
        );

        $this->assertStringContainsString('Painel', $html);
        $this->assertStringContainsString('Resumo geral', $html);
        $this->assertStringContainsString('Corpo do painel', $html);
    }
}
