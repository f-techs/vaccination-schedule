<div class="max-w-xl w-full bg-white shadow-lg rounded-lg p-8 mx-4">
    <!-- Alert Header -->
    <h1 class="text-2xl font-bold text-green-600 mb-6 text-center">Vaccination Alert</h1>

    <h6 class="text-lg font-bold text-green-900 mb-6 text-center">{{$messageTitle ?? ''}}</h6>
    <!-- Message Section -->
    <p class="text-center mb-6">
        {{$messageBody ?? ''}}
    </p>

    <!-- Audio Section -->
{{--    {{$messageVoice}}--}}
    <div class="relative mb-6">
        <div
            wire:loading
            wire:target="language"
            class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-2 w-8 h-8 border-4 border-green-500 border-t-transparent rounded-full animate-spin z-10">
        </div>
        <audio controls autoplay  class="w-full" id="audioPlayer">
            <source src="{{ asset('storage/' . $messageVoice ?? '') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <input type="hidden" wire:model="updatedVoice" id="updatedVoice" value="{{$updatedVoice}}"/>
    </div>

    <!-- Language Select Section -->
    @if(count($languages) > 0)
    <div class="mb-6">
        <label for="language" class="block text-sm font-medium text-gray-700 mb-2 text-center">Select Different Audio Language:</label>
        <select wire:model.live="language" id="language"  name="language" class="block px-4 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
            @foreach($languages as $item)
                <option value="{{$item->language_id}}">{{$item->language->name ?? ''}}</option>
            @endforeach
        </select>
    </div>
    @endif

    <!-- Footer Section -->
</div>
<script>
    //document.querySelector('audio').muted = false;
    const language = document.getElementById('language');
    const updatedVoice = document.getElementById('updatedVoice');
    const audio = document.getElementById('audioPlayer');

    language.addEventListener('change',function(){
        setTimeout(()=>{
            const audioSource ="{{ asset('storage/') }}" +"/"+ updatedVoice.value;
            audio.src = audioSource;
            audio.load();
            audio.play();
        }, 2000)

    })
</script>
