<div class="max-w-3xl mx-auto mt-8 bg-white p-6 shadow-lg rounded">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-bold">Schedule Vaccination</h2>
    </div>
    @if (session('message'))
        <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
            {{ session('message') }} {{$success}} out of {{$totalMessages}} message(s) sent
        </div>
    @endif

    @if(session('messagingError'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        {{ session('messagingError') }}
        </div>
    @endif

    @if(session('no-credit'))
        <div class="mb-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
            {{ session('no-credit') }}  <a href="{{route('credit.buy')}}">Click Here to buy</a>
        </div>
    @endif


    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Message</label>
            <select type="text" id="voice" wire:model="message"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option  value="">Select Message</option>
                @foreach($vaccineMessages as $item)
                    <option  value="{{$item->vaccine_message_id}}">{{$item->title}}</option>
                @endforeach
            </select>
            @error('message')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Parents</label>
            @if(session('danger')) <span class="text-red-500 text-sm">{{session('danger')}}</span> @endif
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
                    <option value="{{$item->message_type_id ?? ''}}">{{$item->type ?? ''}}</option>
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
    <!-- Loading Spinner -->
    <div wire:target="save" wire:loading.delay class="loading-overlay">
        <div class="spinner"></div>
        <p class="loading-text">Processing...</p>
    </div>
{{--        <p class="text-white text-lg font-semibold">Processing... {{$success}} out of {{$totalMessages}}</p>--}}


</div>
