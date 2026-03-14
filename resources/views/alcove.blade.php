<x-layouts.app :title="__('Alcove')">
    <div class="min-h-screen bg-[#0f110d] text-[#e2e2d5] selection:bg-orange-500/30 overflow-x-hidden">
        
        <div class="fixed inset-0 bg-[radial-gradient(circle_at_50%_-10%,_rgba(120,110,90,0.18),_transparent_60%)] pointer-events-none"></div>
        
        <div class="relative px-6 py-12 max-w-6xl mx-auto">
            
            <header class="flex flex-col md:flex-row justify-between items-center md:items-end mb-20 gap-6">
                <div class="text-center md:text-left">
                    <h1 class="text-5xl font-serif text-[#f4f4f0] tracking-tight">Your Alcove</h1>
                    <p class="text-[#8c8c82] italic mt-2 font-serif text-lg">"Stillness is the altar of the mind."</p>
                </div>

                <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
                <style>
                    body { font-family: 'Playfair Display', serif; }
                </style>
                
                @if(!request()->routeIs('books.create') && !isset($book))
                    <a href="{{ route('books.create') }}" 
                       class="group flex items-center gap-2 px-6 py-3 bg-[#1e211b] border border-[#3a3d35] rounded-full text-sm tracking-widest uppercase text-[#8c8c82] hover:text-[#f4f4f0] hover:border-[#f4f4f0] transition-all duration-500">
                        <span>Begin a new log</span>
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                    </a>
                @endif
            </header>

            @if(request()->routeIs('books.create') || isset($book))
                <section class="max-w-2xl mx-auto mb-32 animate-in fade-in slide-in-from-bottom-8 duration-1000">
                    <div class="p-10 bg-[#f4f4f0] border border-white rounded-2xl shadow-2xl shadow-black/80">
                        <h2 class="font-serif text-3xl text-[#0f110d] mb-10 text-center italic">
                            {{ isset($book) ? 'Refining the details...' : 'What are we reading today?' }}
                        </h2>
                        
                        <form action="{{ isset($book) ? route('books.update', $book) : route('books.store') }}" method="POST" class="space-y-10">
                            @csrf
                            @if(isset($book)) @method('PUT') @endif
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-1">
                                    <label class="text-[10px] uppercase tracking-[0.2em] text-[#8c8c82]">Title</label>
                                    <input type="text" name="title" value="{{ $book->title ?? '' }}" required
                                           class="w-full bg-transparent border-b border-[#d1d1c7] border-t-0 border-x-0 p-0 pb-2 text-xl font-serif text-[#0f110d] focus:ring-0 focus:border-orange-900/50 placeholder-[#bcbcb0]" 
                                           placeholder="The Great Gatsby">
                                </div>

                                <div class="space-y-1">
                                    <label class="text-[10px] uppercase tracking-[0.2em] text-[#8c8c82]">Author</label>
                                    <input type="text" name="author" value="{{ $book->author ?? '' }}" required
                                           class="w-full bg-transparent border-b border-[#d1d1c7] border-t-0 border-x-0 p-0 pb-2 text-lg font-serif text-[#0f110d] focus:ring-0 focus:border-orange-900/50 placeholder-[#bcbcb0]" 
                                           placeholder="F. Scott Fitzgerald">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-end">
                                <div class="space-y-2">
                                    <label class="text-[10px] uppercase tracking-[0.2em] text-[#8c8c82]">Shelve under</label>
                                    <select name="status" class="w-full bg-white border-[#d1d1c7] text-[#0f110d] text-xs rounded-lg focus:ring-orange-900/50 p-2">
                                        @foreach(['want to read', 'reading', 'finished'] as $status)
                                            <option value="{{ $status }}" {{ (isset($book) && $book->status == $status) ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="space-y-1">
                                    <label class="text-[10px] uppercase tracking-[0.2em] text-[#8c8c82]">Total Pages</label>
                                    <input type="number" name="total_pages" value="{{ $book->total_pages ?? '' }}" required min="1"
                                        class="w-full bg-transparent border-b border-[#d1d1c7] border-t-0 border-x-0 p-0 pb-2 text-lg font-serif text-[#0f110d] focus:ring-0 focus:border-orange-900/50" 
                                        placeholder="350">
                                </div>

                                <div class="space-y-1">
                                    <label class="text-[10px] uppercase tracking-[0.2em] text-[#8c8c82]">Current Page</label>
                                    <input type="number" name="current_page" value="{{ $book->current_page ?? '0' }}" required min="0"
                                        class="w-full bg-transparent border-b border-[#d1d1c7] border-t-0 border-x-0 p-0 pb-2 text-lg font-serif text-[#0f110d] focus:ring-0 focus:border-orange-900/50" 
                                        placeholder="0">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] uppercase tracking-[0.2em] text-[#8c8c82]">Personal Notes</label>
                                <textarea name="notes" rows="3" 
                                        class="w-full bg-transparent border-b border-[#d1d1c7] border-t-0 border-x-0 p-0 pb-2 text-sm font-serif text-[#0f110d] focus:ring-0 focus:border-orange-900/50 placeholder-[#bcbcb0] resize-none" 
                                        placeholder="What does this story leave with you?">{{ $book->notes ?? '' }}</textarea>
                            </div>

                            <div class="flex items-center justify-end gap-8 pt-4">
                                <a href="{{ route('alcove') }}" class="text-xs text-[#8c8c82] hover:text-[#0f110d] transition-colors tracking-widest uppercase">Discard</a>
                                <button type="submit" class="px-10 py-4 bg-[#0f110d] text-[#f4f4f0] rounded-full text-xs font-bold tracking-widest uppercase hover:bg-black transition-all shadow-lg">
                                    {{ isset($book) ? 'Update Log' : 'Save to Library' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            @endif

            @php
                $shelfOrder = [
                    'reading' => 'Currently Immersed',
                    'finished' => 'The Finished Shelf',
                    'want to read' => 'Future Journeys'
                ];
            @endphp

            @foreach($shelfOrder as $statusKey => $displayTitle)
                @if(isset($shelves[$statusKey]))
                    <section class="mb-24 animate-in fade-in duration-1000">
                        <div class="flex items-center gap-6 mb-12">
                            <h2 class="font-serif text-lg text-[#5c5c52] italic tracking-[0.2em] uppercase">{{ $displayTitle }}</h2>
                            <div class="h-[1px] flex-grow bg-[#2a2d26]"></div>
                            <span class="text-[10px] text-[#3a3d35] font-mono tracking-widest">{{ $shelves[$statusKey]->count() }} VOLUMES</span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-10 gap-y-16">
                            @foreach($shelves[$statusKey] as $item)
                                @php
                                    $progress = ($item->total_pages > 0) ? ($item->current_page / $item->total_pages) * 100 : 0;
                                    
                                    $colors = [
                                        ['bg' => 'bg-[#1a1c18]', 'border' => 'border-l-[#2d3129]'], 
                                        ['bg' => 'bg-[#1c1a18]', 'border' => 'border-l-[#312d29]'], 
                                        ['bg' => 'bg-[#181a1c]', 'border' => 'border-l-[#292d31]'], 
                                        ['bg' => 'bg-[#1b181b]', 'border' => 'border-l-[#312931]'], 
                                        ['bg' => 'bg-[#161813]', 'border' => 'border-l-[#2a2d26]'], 
                                    ];
                                    $style = $colors[$item->id % count($colors)];

                                    $glowClass = match($item->status) {
                                        'reading' => 'shadow-[0_0_30px_rgba(249,115,22,0.15)] ring-1 ring-orange-900/20',
                                        'finished' => 'shadow-[0_0_30px_rgba(16,185,129,0.1)] ring-1 ring-emerald-900/20',
                                        default => 'shadow-xl',
                                    };
                                @endphp

                                <div class="group relative aspect-[3/4.5] {{ $style['bg'] }} {{ $style['border'] }} rounded-sm border-l-[4px] transition-all duration-700 cursor-default {{ $glowClass }} hover:-translate-y-3">
                                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-white/5 pointer-events-none"></div>
                                    
                                    <div class="relative p-5 h-full flex flex-col justify-between">
                                        <div class="flex justify-between items-start">
                                            <span class="text-[8px] uppercase tracking-widest text-[#5c5c52]">
                                                {{ $item->status == 'reading' ? round($progress).'%' : '' }}
                                            </span>
                                            
                                            <form action="{{ route('books.toggle', $item) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="h-3 w-3 rounded-full {{ $item->status == 'reading' ? 'bg-orange-500 shadow-[0_0_10px_orange]' : ($item->status == 'finished' ? 'bg-emerald-500' : 'bg-[#3a3d35]') }} transition-transform hover:scale-150"></button>
                                            </form>
                                        </div>

                                        <div class="flex-grow flex flex-col justify-center">
                                            <h3 class="font-serif text-lg leading-tight text-[#f4f4f0]/90 group-hover:text-white transition-colors line-clamp-3">{{ $item->title }}</h3>
                                            <p class="text-[10px] text-[#5c5c52] mt-2 uppercase tracking-[0.15em] font-medium">{{ $item->author }}</p>
                                        </div>

                                        <div class="space-y-4">
                                            @if($item->notes)
                                                <div class="text-[9px] text-[#8c8c82] italic line-clamp-2 font-serif opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                                    "{{ $item->notes }}"
                                                </div>
                                            @endif

                                            <div class="flex items-center gap-4 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                                <a href="{{ route('books.edit', $item) }}" class="text-[9px] uppercase tracking-widest text-[#8c8c82] hover:text-white underline underline-offset-4 decoration-[#3a3d35]">Open Log</a>
                                                <form action="{{ route('books.destroy', $item) }}" method="POST" onsubmit="return confirm('Archive this book?');">
                                                    @csrf @method('DELETE')
                                                    <button class="text-[9px] uppercase tracking-widest text-red-900/60 hover:text-red-400">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @if($item->status == 'reading')
                                        <div class="absolute bottom-0 left-0 w-full h-1 bg-black/30 overflow-hidden">
                                            <div class="h-full bg-orange-600/80 transition-all duration-1000 ease-out" style="width: {{ $progress }}%"></div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endforeach

            @if(!isset($shelves) || $shelves->isEmpty())
                <div class="col-span-full py-32 text-center">
                    <div class="inline-block p-12 border border-dashed border-[#2a2d26] rounded-3xl">
                        <p class="text-[#5c5c52] font-serif italic text-lg text-center">Your shelves are waiting for their first story.</p>
                        <a href="{{ route('books.create') }}" class="mt-6 inline-block text-xs uppercase tracking-widest text-[#8c8c82] hover:text-[#f4f4f0] transition-colors border-b border-[#2a2d26] pb-1">Begin</a>
                    </div>
                </div>
            @endif

            @if(isset($totalPagesRead) && $totalPagesRead > 0)
                <footer class="mt-20 py-12 border-t border-[#2a2d26] text-center">
                    <p class="text-[#5c5c52] font-serif italic text-sm tracking-wide">
                        You have traveled through {{ number_format($totalPagesRead) }} pages in this alcove.
                    </p>
                </footer>
            @endif
        </div>
    </div>
</x-layouts.app>