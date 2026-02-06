<button type="{{ $type }}" {{ $attributes->merge(['class' => 'btn rounded-lg bg-black text-white border-2 border-black hover:!bg-white hover:!text-black hover:border-2 hover:border-black hover:cursor-pointer']) }}>
    {{ $slot }}
</button>