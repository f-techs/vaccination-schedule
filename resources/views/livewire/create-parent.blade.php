<div class="max-w-3xl mx-auto mt-8 bg-white p-6 shadow-lg rounded">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-bold">Create Parent-Child Records</h2>
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
                <label class="block text-sm font-medium text-gray-700 mb-2">Parent Name</label>
                <input type="text" wire:model="parent_name"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:ring focus:ring-green-200 focus:outline-none">
                @error('parent_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Child Name</label>
                <input type="text" wire:model="child_name"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:ring focus:ring-green-200 focus:outline-none">
                @error('child_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                <select type="text" id="language" wire:model="language" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option  value="">Select Gender</option>
                <option value="Male" >Male</option>
                <option value="Female" >Female</option>
            </select>
                @error('child_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                <input type="date" wire:model="date_of_birth"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:ring focus:ring-green-200 focus:outline-none">
                @error('date_of_birth')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number</label>
                <input type="text" wire:model="mobile_number"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:ring focus:ring-green-200 focus:outline-none">
                @error('mobile_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" wire:model="email"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:ring focus:ring-green-200 focus:outline-none">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
     
            <div class="flex justify-between items-center">
            <button type="submit"
                class="bg-green-900 text-white px-6 py-2 rounded hover:bg-green-700 focus:outline-none">
                Save
            </button>
            <a href="{{ route('parents') }}" 
               class="inline-block bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">Cancel</a>
        </div>
    </form>
</div>
