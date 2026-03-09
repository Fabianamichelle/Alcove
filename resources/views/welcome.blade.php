<x-layout>
    <div class="max-w-2xl mx-auto py-12 px-6">
        <header class="mb-12 flex justify-between items-baseline">
            <h1 class="text-3xl font-serif text-gray-900">Alcove</h1>
            <a href="{{ route('books.create') }}" class="text-sm text-gray-400 hover:text-gray-900 transition-colors underline decoration-gray-200 underline-offset-4">Add a new book</a>
        </header>

        <div class="space-y-2">
            @forelse ($books as $book)
                <x-book-card :book="$book" />
            @empty
                <p class="text-gray-400 italic">Your shelves are currently empty. A fresh start.</p>
            @endforelse
        </div>
    </div>
</x-layout>