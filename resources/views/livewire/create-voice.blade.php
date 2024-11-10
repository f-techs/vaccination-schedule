<div class="max-w-3xl mx-auto mt-8 bg-white p-6 shadow-lg rounded">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-bold">Record Voice</h2>
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
    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" wire:model="title" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
            <select type="text" id="language" wire:model="language" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option selected value="">Select Language</option>
                @foreach ($languages as $item)
                <option value="{{$item->language_id}}" selected>{{$item->name}}</option>
                @endforeach
            </select>
            @error('language') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="voice" class="block text-sm font-medium text-gray-700">Voice</label>
            <input type="file" id="voice" wire:model="voice" accept="audio/*" hidden>
            
            <div class="mt-2 flex space-x-2">
                <button type="button" id="startRecording" 
                    class="px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">
                    Start Recording
                </button>
                <button type="button" id="stopRecording" disabled 
                    class="px-4 py-2 bg-red-500 text-white rounded-md shadow hover:bg-red-600 disabled:opacity-50">
                    Stop Recording
                </button>
            </div>

            @error('voice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div id="audioPreview" class="mt-4 hidden">
            <h4 class="text-sm font-medium text-gray-700">Audio Preview:</h4>
            <audio controls id="audioPlayer" class="mt-2 w-full"></audio>
        </div>

        <div class="my-6 border-t border-gray-300"></div>

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
<script>
   navigator.mediaDevices
  .getUserMedia(constraints)
  .then((stream) => {
    /* use the stream */
  })
  .catch((err) => {
    /* handle the error */
  });
</script>

