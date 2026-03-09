@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="Alcove" {{ $attributes }}>
        <x-slot name="logo">
            <img src="{{ asset('Alcove.png') }}" alt="Alcove" class="size-8 object-contain" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="Alcove" {{ $attributes }}>
        <x-slot name="logo">
            <img src="{{ asset('Alcove.png') }}" alt="Alcove" class="size-8 object-contain" />
        </x-slot>
    </flux:brand>
@endif
