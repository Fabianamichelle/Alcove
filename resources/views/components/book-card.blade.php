<div class="group p-6 bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors duration-300">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-xl font-serif text-gray-900 leading-tight">{{ $book->title }}</h3>
            <p class="text-gray-500 font-sans mt-1 italic">by {{ $book->author }}</p>
        </div>
        
        <span class="px-3 py-1 text-xs tracking-widest uppercase border border-gray-200 text-gray-400 rounded-full">
            {{ $book->status }}
        </span>
    </div>

    <div class="mt-4 flex gap-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <a href="{{ route('books.edit', $book) }}" class="text-xs text-blue-400 hover:text-blue-600 uppercase tracking-tighter">Edit</a>
        <form action="{{ route('books.destroy', $book) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-xs text-gray-300 hover:text-red-400 uppercase tracking-tighter">Remove</button>
        </form>
    </div>
</div>