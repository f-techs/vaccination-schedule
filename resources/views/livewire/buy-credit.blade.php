<div class="max-w-3xl mx-auto mt-8 bg-white p-6 shadow-lg rounded">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-bold">Buy Credits: 0.30 per credit</h2>
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

    @if(session('emailSendingError'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('emailSendingError') }}
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
            <input type="number" min="0" id="title" wire:model="credits" wire:input="updateCredit"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
            @error('credits') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" id="title" wire:model="clientPhone"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
            @error('clientPhone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="text" id="title" wire:model="clientEmail"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
            @error('clientEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            Total Credit Cost: GHC <strong>{{$totalAmount}}</strong>. Pay to <strong>0559153528 (F-TECHS CONSULT)</strong>. Use your mobile number as reference.
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
