@props(['title' => '', 'subtitle' => ''])

<div class="flex flex-col gap-2">
    @if ($title)
        <h2 class="text-3xl font-semibold">{{ $title }}</h2>
    @endif

    @if ($subtitle)
        <p class="text-gray-500">{{ $subtitle }}</p>
    @endif
</div>