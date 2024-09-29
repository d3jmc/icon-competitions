<button {{ $attributes->merge(['type' => 'submit', 'class' => 'min-w-[95px] h-[48px] px-4 bg-primary text-white font-medium border-primary rounded']) }}>
    {{ $slot }}
</button>