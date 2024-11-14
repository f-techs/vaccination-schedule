<div class="max-w-3xl mx-auto mt-8 bg-white p-6 shadow-lg rounded">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-bold">Activate Credit Payment</h2>
    </div>
    @if (session('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('message') }}
        </div>
    @endif


    <form wire:submit.prevent="save">

        <div class="mb-4">
            <label for="language" class="block text-sm font-medium text-gray-700">Credit Type</label>
            <select type="text" id="" wire:model="creditType"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option selected value="">Select Type</option>
                @foreach (['email', 'sms'] as $item)
                    <option value="{{$item}}" selected>{{ $item }}</option>
                @endforeach
            </select>
            @error('creditType') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Number of Units</label>
            <input type="number" min="0" id="title" wire:model="credits"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
            @error('credits') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Activation Code</label>
            <input type="password" id="title" wire:model="code"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
            @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>




        <div class="flex justify-between items-center">
            <button type="submit"
                    class="bg-green-900 text-white px-6 py-2 rounded hover:bg-green-700 focus:outline-none">
                Save
            </button>
            <div wire:target="save" wire:loading.delay class="loading-overlay">
                <div class="spinner"></div>
                <p class="loading-text">Processing...</p>
            </div>
            <a href="{{ route('dashboard') }}"
               class="inline-block bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">Cancel</a>
        </div>
    </form>
</div>

