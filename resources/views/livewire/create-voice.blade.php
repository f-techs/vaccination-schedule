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
            <label for="language" class="block text-sm font-medium text-gray-700">Vaccination Message</label>
            <select type="text" id="language" wire:model="message"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option selected value="">Select Messages</option>
                @foreach ($vaccineMessages as $item)
                    <option value="{{$item->vaccine_message_id ?? ''}}" >{{$item->title ?? ''}}</option>
                @endforeach
            </select>
            @if(session('record-exist'))<span class="text-red-500 text-sm">{{ session('record-exist') }}</span> @endif
            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
            <select type="text" id="language" wire:model="language"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-700 focus:border-green-700">
                <option selected value="">Select Language</option>
                @foreach ($languages as $item)
                <option value="{{$item->language_id ?? ''}}" selected>{{$item->name ?? ''}}</option>
                @endforeach
            </select>
            @error('language') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="voice" class="block text-sm font-medium text-gray-700">Voice</label>
            <input type="file" id="voice" wire:model="voice_code" accept="audio/*" hidden>

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

            <div id="recordingIndicator" class="hidden mt-2 text-blue-500 text-sm">
                Recording in progress...
            </div>

            @error('voice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div id="audioPreview" class="mt-4 hidden">
            <h4 class="text-sm font-medium text-gray-700">Audio Preview:</h4>
            <audio controls id="audioPlayer" class="mt-2 w-full"></audio>
            <div class="flex justify-between items-center">
            <button type="button" id="removeAudio"
                    class="mt-2 px-4 py-2 bg-red-500 text-white rounded-md shadow hover:bg-red-600">
                Remove Audio
            </button>
                <button type="button" id="uploadVoice" class="bg-green-500 text-white px-4 py-2 rounded">Upload Voice</button>
            </div>
        </div>

        <div class="my-6 border-t border-gray-300"></div>

        <div class="flex justify-between items-center">
            <button type="submit"
                class="bg-green-900 text-white px-6 py-2 rounded hover:bg-green-700 focus:outline-none">
                Save
            </button>
            <a href="{{ route('voices') }}"
               class="inline-block bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">Cancel</a>
        </div>
    </form>


</div>
<script>
    let mediaRecorder;
    let audioChunks = [];

    document.getElementById('startRecording').addEventListener('click', async () => {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        mediaRecorder = new MediaRecorder(stream, {mimeType:'audio/webm'});

        mediaRecorder.start();
        document.getElementById('startRecording').disabled = true;
        document.getElementById('stopRecording').disabled = false;
        document.getElementById('recordingIndicator').classList.remove('hidden');

        mediaRecorder.addEventListener('dataavailable', event => {
            audioChunks.push(event.data);
        });

        mediaRecorder.addEventListener('stop', () => {
            const audioBlob = new Blob(audioChunks, { type: 'audio/mp3' });
            const   file = new File([audioBlob], 'recording.mp3', { type: 'audio/mp3' });
            window.recordedFile = new File([audioBlob], 'recording.mp3', { type: 'audio/mp3' });

            // Simulate file input for Livewire
            // const input = document.querySelector('#voice');
            // const dataTransfer = new DataTransfer();
            // dataTransfer.items.add(file);
            // input.files = dataTransfer.files;
            //@this.upload('voice', audioBlob)
            // input.dispatchEvent(new Event('input', { bubbles: true }));




            // Audio Preview
            const audioUrl = URL.createObjectURL(audioBlob);
            const audioPlayer = document.getElementById('audioPlayer');
            audioPlayer.src = audioUrl;
            document.getElementById('audioPreview').classList.remove('hidden');


            document.getElementById('startRecording').disabled = false;
            document.getElementById('stopRecording').disabled = true;
            document.getElementById('recordingIndicator').classList.add('hidden');

            audioChunks = []; // Reset for new recordings
        });
    });

    document.getElementById('stopRecording').addEventListener('click', () => {
        mediaRecorder.stop();
    });
    document.getElementById('removeAudio').addEventListener('click', () => {
        document.getElementById('audioPlayer').src = '';
        document.getElementById('audioPreview').classList.add('hidden');
        document.getElementById('voice').value = ''; // Clear file input
    });

    document.getElementById('uploadVoice').addEventListener('click', () => {
        if (window.recordedFile) {
        @this.upload('voice', window.recordedFile,
            (uploadedFilename) => {
                console.log('Upload complete: ' + uploadedFilename);
            },
            (error) => {
                console.log('Upload error: ' + error);
            }
        );
        }
    });

</script>

