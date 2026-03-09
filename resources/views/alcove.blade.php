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
                <section class="max-w-xl mx-auto mb-24 animate-in fade-in slide-in-from-bottom-8 duration-1000">
                    <div class="p-8 bg-[#161813] border border-[#2a2d26] rounded-2xl shadow-2xl shadow-black/50">
                        <h2 class="font-serif text-2xl text-[#f4f4f0] mb-8 text-center">
                            {{ isset($book) ? 'Refining the details...' : 'What are we reading today?' }}
                        </h2>
                        
                        <form action="{{ isset($book) ? route('books.update', $book) : route('books.store') }}" method="POST" class="space-y-8">
                            @csrf
                            @if(isset($book)) @method('PUT') @endif
                            
                            <div class="space-y-1">
                                <label class="text-[10px] uppercase tracking-[0.2em] text-[#5c5c52]">Title</label>
                                <input type="text" name="title" value="{{ $book->title ?? '' }}" required
                                       class="w-full bg-transparent border-b border-[#2a2d26] border-t-0 border-x-0 p-0 pb-2 text-xl font-serif focus:ring-0 focus:border-orange-900/50 placeholder-[#3a3d35]" 
                                       placeholder="The Great Gatsby">
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] uppercase tracking-[0.2em] text-[#5c5c52]">Author</label>
                                <input type="text" name="author" value="{{ $book->author ?? '' }}" required
                                       class="w-full bg-transparent border-b border-[#2a2d26] border-t-0 border-x-0 p-0 pb-2 text-lg font-serif focus:ring-0 focus:border-orange-900/50 placeholder-[#3a3d35]" 
                                       placeholder="F. Scott Fitzgerald">
                            </div>

                            <div class="flex flex-col sm:flex-row justify-between items-center pt-4 gap-6">
                                <div class="flex flex-col gap-1 w-full sm:w-auto">
                                    <label class="text-[10px] uppercase tracking-[0.2em] text-[#5c5c52]">Shelve under</label>
                                    <select name="status" class="bg-[#1e211b] border-[#2a2d26] text-[#8c8c82] text-xs rounded-lg focus:ring-orange-900/50">
                                        @foreach(['want to read', 'reading', 'finished'] as $status)
                                            <option value="{{ $status }}" {{ (isset($book) && $book->status == $status) ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex items-center gap-6">
                                    <a href="{{ route('alcove') }}" class="text-xs text-[#5c5c52] hover:text-[#f4f4f0] transition-colors">Discard</a>
                                    <button type="submit" class="px-8 py-3 bg-[#f4f4f0] text-[#0f110d] rounded-full text-xs font-bold tracking-widest uppercase hover:bg-white transition-colors shadow-lg shadow-white/5">
                                        {{ isset($book) ? 'Update Log' : 'Save to Library' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-8 gap-y-12">
                @forelse ($books as $item)
                    <div class="group relative aspect-[3/4.5] bg-[#161813] rounded-sm border-l-[3px] border-[#2a2d26] shadow-xl hover:-translate-y-3 hover:shadow-2xl transition-all duration-700 cursor-default">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/40 via-transparent to-white/5 pointer-events-none"></div>
                        
                        <div class="relative p-5 h-full flex flex-col justify-between">
                            <div class="flex justify-end">
                                <div class="h-1.5 w-1.5 rounded-full {{ $item->status == 'reading' ? 'bg-orange-500 shadow-[0_0_8px_rgba(249,115,22,0.6)]' : ($item->status == 'finished' ? 'bg-emerald-500/50' : 'bg-[#3a3d35]') }}"></div>
                            </div>

                            <div>
                                <h3 class="font-serif text-lg leading-snug text-[#f4f4f0]/90 group-hover:text-white transition-colors">{{ $item->title }}</h3>
                                <p class="text-[10px] text-[#5c5c52] mt-2 uppercase tracking-[0.15em] font-medium">{{ $item->author }}</p>
                                
                                <div class="mt-6 flex items-center gap-4 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-2 group-hover:translate-y-0">
                                    <a href="{{ route('books.edit', $item) }}" class="text-[9px] uppercase tracking-widest text-[#8c8c82] hover:text-white">Edit</a>
                                    
                                    <form action="{{ route('books.destroy', $item) }}" method="POST" onsubmit="return confirm('Archive this book?');">
                                        @csrf @method('DELETE')
                                        <button class="text-[9px] uppercase tracking-widest text-red-900/60 hover:text-red-400">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-32 text-center">
                        <div class="inline-block p-8 border border-dashed border-[#2a2d26] rounded-3xl">
                            <p class="text-[#5c5c52] font-serif italic text-lg text-center">Your shelves are waiting for their first story.</p>
                            <a href="{{ route('books.create') }}" class="mt-4 inline-block text-xs uppercase tracking-widest text-[#8c8c82] hover:text-[#f4f4f0]">Begin</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>