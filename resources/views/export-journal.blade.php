<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Great Ledger</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Playfair Display', serif; 
            background-color: #0f110d; /* Deep Midnight */
        }
        @media print {
            .no-print { display: none; }
            body { background-color: white !important; color: black !important; }
            .book-card { border: 1px solid #e5e7eb !important; background: white !important; }
        }
    </style>
</head>
<body class="text-[#e2e2d5] p-8 md:p-20">

    <div class="no-print max-w-5xl mx-auto mb-16 flex justify-between items-center border-b border-yellow-900/30 pb-8">
        <a href="{{ route('alcove') }}" class="text-yellow-700 hover:text-yellow-500 transition-colors italic">
            ← Return to Sanctuary
        </a>
        <button onclick="window.print()" class="bg-yellow-600 hover:bg-yellow-500 text-black px-8 py-3 rounded-full text-xs font-bold uppercase tracking-[0.2em] shadow-[0_0_20px_rgba(202,138,4,0.3)] transition-all">
            Download My Bookshelf Journal
        </button>
    </div>

    <header class="text-center mb-24">
        <div class="text-4xl mb-4 animate-bounce">✨</div>
        <h1 class="text-7xl font-bold italic text-[#f4f4f0] mb-4 tracking-tight">The Great Ledger</h1>
        <p class="text-yellow-600 uppercase tracking-[0.4em] text-xs font-bold">A Chronicle of Completed Conquests</p>
    </header>

    <div class="max-w-5xl mx-auto grid grid-cols-1 gap-10">
        @foreach($books as $book)
            <article class="book-card relative p-10 border border-yellow-900/20 bg-[#161813] rounded-2xl shadow-2xl hover:border-yellow-500/30 transition-all duration-500">
                <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                    <div>
                        <h2 class="text-4xl font-serif text-yellow-500 italic mb-2 capitalize">{{ $book->title }}</h2>
                        <p class="text-xl text-gray-400 font-serif">Mastered the works of <span class="text-white">{{ $book->author }}</span></p>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-[10px] bg-yellow-900/40 text-yellow-500 px-4 py-2 rounded-full border border-yellow-500/20 uppercase tracking-widest font-bold">
                            {{ $book->total_pages }} Pages Conquered
                        </span>
                    </div>
                </div>

                @if($book->notes)
                    <div class="mt-8 bg-black/20 p-8 rounded-xl border-l-4 border-yellow-600 italic text-gray-300 leading-relaxed font-serif">
                        "{{ $book->notes }}"
                    </div>
                @endif
                
                <div class="absolute bottom-4 right-6 text-xl opacity-20">📜</div>
            </article>
        @endforeach
    </div>

    <footer class="max-w-5xl mx-auto mt-32 py-20 border-t border-yellow-900/30 text-center">
        <div class="text-6xl mb-8">🏺</div>
        <h3 class="text-3xl font-serif italic text-yellow-500 mb-2">Grand Accomplishment</h3>
        <p class="text-5xl font-bold text-[#f4f4f0] mb-6">{{ number_format($totalPagesRead) }} <span class="text-sm uppercase tracking-tighter text-gray-500">Pages Traversed</span></p>
        <p class="text-gray-600 uppercase tracking-[0.3em] text-[10px] mt-4 font-bold">The library grows, and so does the mind.</p>
    </footer>

</body>
</html>