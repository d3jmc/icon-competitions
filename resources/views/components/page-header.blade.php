@props(['title' => '', 'subtitle' => ''])

<div class="flex flex-col gap-2">
    @if ($title)
        <h2 class="text-4xl font-semibold">{{ $title }}</h2>
    @endif

    @if ($subtitle)
        <p>{{ $subtitle }}</p>
    @endif
</div>