<button type="{{ $type }}" {{ $attributes->merge(['class' => 'btn rounded-0 bg-black text-white hover:!bg-white hover:!text-black hover:border-2 hover:border-black hover:cursor-pointer']) }}>
    {{ $slot }}
</button>