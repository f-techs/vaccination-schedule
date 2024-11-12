<div class="max-w-3xl mx-auto mt-8 bg-white p-6 shadow-lg rounded">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-bold">Vaccination Messages</h2>
        {{-- <a href="{{ route('parents') }}">
            <button type="button" wire:click="addRow"
                class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none">
                Parents
            </button>
        </a> --}}
    </div>
    @if (session('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" wire:model="title"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea type="text" id="title" wire:model="message_body"
                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700"></textarea>
            @error('message_body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between items-center">
            <button type="submit"
                    class="bg-green-900 text-white px-6 py-2 rounded hover:bg-green-700 focus:outline-none">
                Save
            </button>
            <a href="{{ route('vaccine-messages') }}"
               class="inline-block bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">Cancel</a>
        </div>
    </form>
</div>
