<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Playfair Display', serif; }
        </style>
    </head>
    <body class="min-h-screen bg-[#0f110d] antialiased overflow-hidden">

        
        <div class="fixed inset-0 bg-[radial-gradient(circle_at_50%_0%,_rgba(180,120,60,0.15),_transparent_65%)] pointer-events-none"></div>
        <div class="fixed inset-0 bg-[radial-gradient(circle_at_80%_80%,_rgba(120,80,40,0.08),_transparent_60%)] pointer-events-none"></div>

        
        <div class="fixed bottom-0 left-0 flex items-end gap-2 px-6 pb-0 pointer-events-none select-none opacity-40">
            @foreach([['h-48','bg-[#1a1c18]','border-l-[#3d3f38]'],['h-64','bg-[#1c1a18]','border-l-[#3f3b34]'],['h-40','bg-[#181a1c]','border-l-[#34383f]'],['h-56','bg-[#1b181b]','border-l-[#3f343f]'],['h-44','bg-[#161813]','border-l-[#30331f]'],['h-60','bg-[#1a1c18]','border-l-[#3d3f38]'],['h-36','bg-[#1c1a18]','border-l-[#3f3b34]']] as $spine)
                <div class="w-8 {{ $spine[0] }} {{ $spine[1] }} border-l-4 {{ $spine[2] }} rounded-t-sm"></div>
            @endforeach
        </div>
        <div class="fixed bottom-0 right-0 flex items-end gap-2 px-6 pb-0 pointer-events-none select-none opacity-40">
            @foreach([['h-52','bg-[#1b181b]','border-l-[#3f343f]'],['h-40','bg-[#161813]','border-l-[#30331f]'],['h-60','bg-[#1a1c18]','border-l-[#3d3f38]'],['h-36','bg-[#1c1a18]','border-l-[#3f3b34]'],['h-48','bg-[#181a1c]','border-l-[#34383f]'],['h-44','bg-[#1a1c18]','border-l-[#3d3f38]']] as $spine)
                <div class="w-8 {{ $spine[0] }} {{ $spine[1] }} border-l-4 {{ $spine[2] }} rounded-t-sm"></div>
            @endforeach
        </div>

        <div class="relative flex min-h-screen flex-col items-center justify-center gap-8 p-6">

           
            <div class="flex flex-col items-center gap-3 text-center">
                <a href="{{ route('home') }}" wire:navigate>
                    <img src="{{ asset('Alcove.png') }}" alt="Alcove" class="size-16 object-contain drop-shadow-lg" />
                </a>
                <h1 class="text-4xl text-white tracking-tight">Your Alcove awaits.</h1>
                <p class="text-white italic text-base">"A reader lives a thousand lives before he dies."</p>
            </div>

         
            <div class="w-full max-w-md rounded-2xl border border-[#2a2d26] bg-[#141610] shadow-2xl shadow-black/60 px-10 py-8">
                {{ $slot }}
            </div>

        </div>

        @fluxScripts
    </body>
</html>
