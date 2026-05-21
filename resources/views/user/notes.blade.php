<div class="space-y-4">

    @if (session()->has('message'))
        <div class="text-green-600">{{ session('message') }}</div>
    @endif

    <form method="POST" action="{{ route('notes.store') }}" class="space-y-2">
        @csrf

        <textarea name="text" placeholder="Write your note..." class="w-full border p-2">{{ old('text') }}</textarea>

        <select name="tag_id" class="w-full border p-2">
            <option value="">-- Select Tag --</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" @selected(old('tag_id') == $tag->id)>{{ $tag->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add Note</button>
    </form>

    <hr>

    <h2 class="text-xl font-bold">Your Notes</h2>

    @foreach ($notes as $note)
        <div class="border p-3 flex justify-between items-start">
            <div>
                <p>{{ $note->text }}</p>
                <small class="text-gray-500">Tag: {{ $note->tag->name ?? '-' }}</small>
            </div>

            <form method="POST" action="{{ route('notes.destroy', $note) }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="text-red-500 text-sm">Delete</button>
            </form>
        </div>
    @endforeach

</div>
