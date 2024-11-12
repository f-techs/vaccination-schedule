<div class="max-w-3xl mx-auto mt-8 bg-white p-6 shadow-lg rounded">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-bold">Schedule Vaccination</h2>
    </div>
    @if (session('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Filter By Language</label>
            <select type="text" id="language" wire:model.live="language"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option  value="">Select Language</option>
                @foreach($languages as $item)
                    <option value="{{$item->language_id}}">{{$item->name}}</option>
                @endforeach
            </select>
            @error('language')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Parents</label>
            <select type="text" id="language" wire:model.live="parent"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option  value="">Select Parents</option>
                @foreach($parents as $item)
                    <option value="{{$item->parent_id}}">{{$item->parent_name.'-'.$item->child_name.'('.$item->gender.')'}}</option>
                @endforeach
            </select>
            @error('parent')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <div id="labelsContainer" class="flex flex-wrap gap-2">
                <!-- Example labels, dynamically generated labels will look the same -->
                @if($selectedParents)
                    @foreach($selectedParents as $item)
                <div class="flex items-center bg-{{$item->gender=='Male' ? 'blue' : 'pink'}}-500 text-white px-3 py-1 rounded-full">
                    <span class="text-sm">{{$item->parent_name}}</span>
                    <button type="button" wire:click="removeParent({{$item->parent_id}})" class="ml-2 text-white hover:text-gray-300">
                        &times;
                    </button>
                </div>
                    @endforeach
                @endif

            </div>
        </div>


        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Voice Message</label>
            <select type="text" id="voice" wire:model="voice"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option  value="">Select Message</option>
                @foreach($voices as $item)
                    <option  value="{{$item->voice_id}}">{{$item->title}}</option>
                @endforeach
            </select>
            @error('voice')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Schedule Date</label>
            <input type="date" wire:model="vaccine_date"
                   class="w-full border border-gray-300 px-4 py-2 rounded focus:ring focus:ring-green-200 focus:outline-none">
            @error('vaccine_date')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Message Type</label>
            <select type="text" id="language" wire:model="message_type"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option  value="">Select Message Type</option>
                @foreach($messageTypes as $item)
                    <option value="{{$item->message_type_id}}">{{$item->type}}</option>
                @endforeach
            </select>
            @error('message_type')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <div class="flex justify-between items-center">
            <button type="submit"
                    class="bg-green-900 text-white px-6 py-2 rounded hover:bg-green-700 focus:outline-none">
                submit
            </button>
            <a href="{{ route('messages') }}"
               class="inline-block bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">Cancel</a>
        </div>
    </form>
</div>
