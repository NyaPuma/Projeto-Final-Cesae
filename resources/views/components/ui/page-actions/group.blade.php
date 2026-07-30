{{--
|-------------------------------------------------------------------------- |
Page Actions Container Component (Otimizado)
|-------------------------------------------------------------------------- |
| Contentor flexível para alinhamento e espaçamento de botões e ações.
| • Padronizado com utilitários flex nativos do Tailwind.
| • 100% livre de CSS ou JS inline.
| --}}
<div {{ $attributes->merge(['class' => 'flex flex-wrap items-center gap-2']) }}>
    {{ $slot }}
</div>
