<div class="max-w-3xl mx-auto mt-8 bg-white p-6 shadow-lg rounded">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-bold">Edit Parent-Child Records</h2>
        {{-- <a href="{{ route('parents') }}">
            <button type="button" wire:click="addRow"
                class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none">
                Parents
            </button>
        </a> --}}
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update">
        <div class="mb-4">
            <label for="parent_name" class="block text-gray-700">Parent Name</label>
            <input type="text" id="parent_name" wire:model="parent_name"
                class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('parent_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="child_name" class="block text-gray-700">Child Name</label>
            <input type="text" id="child_name" wire:model="child_name"
                class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('child_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
            <select type="text" id="language" wire:model="gender"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option  value="">Select Gender</option>
                <option value="Male" >Male</option>
                <option value="Female" >Female</option>
            </select>
            @error('gender')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="mobile_number" class="block text-gray-700">Mobile Number</label>
            <input type="text" id="mobile_number" wire:model="mobile_number"
                class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('mobile_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="date_of_birth" class="block text-gray-700">Date of Birth</label>
            <input type="date" id="date_of_birth" wire:model="date_of_birth"
                class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" wire:model="email"
                class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Guardian/Father's Name</label>
            <input type="text" wire:model="guardian_name"
                   class="w-full border border-gray-300 px-4 py-2 rounded focus:ring focus:ring-green-200 focus:outline-none">
            @error('guardian_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Guardian/Father's Mobile Number</label>
            <input type="text" wire:model="guardian_mobile"
                   class="w-full border border-gray-300 px-4 py-2 rounded focus:ring focus:ring-green-200 focus:outline-none">
            @error('guardian_mobile')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="language" class="block text-sm font-medium text-gray-700">Preferred Language</label>
            <select type="text" id="language" wire:model="language"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option selected value="">Select Language</option>
                @foreach ($languages as $item)
                    <option value="{{$item->language_id ?? ''}}" selected>{{$item->name ?? ''}}</option>
                @endforeach
            </select>
            @error('language') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between items-center">
            <button type="submit"
                class="bg-green-900 text-white px-6 py-2 rounded hover:bg-green-700 focus:outline-none">
                Update
            </button>
            <a href="{{ route('parents') }}"
               class="inline-block bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">Cancel</a>
        </div>
    </form>
</div>
