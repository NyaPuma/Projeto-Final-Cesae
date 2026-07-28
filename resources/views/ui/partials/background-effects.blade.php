@props(['class' => ''])

<div {{ $attributes->merge(['class' => $class]) }} aria-hidden="true">
    <div class="absolute inset-0 bg-[var(--bg)]"></div>
    <div
        class="absolute -top-60 left-1/2 -translate-x-1/2 h-[900px] w-[900px] rounded-full bg-primary/10 blur-[180px]">
    </div>
    <div class="absolute bottom-0 right-0 h-[600px] w-[600px] rounded-full bg-blue-500/10 blur-[180px]"></div>
    <div class="absolute top-40 left-0 h-[450px] w-[450px] rounded-full bg-orange-500/10 blur-[140px]"></div>
</div>
