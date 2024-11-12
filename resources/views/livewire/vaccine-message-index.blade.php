<div class="m-8">
    <div class="overflow-x-auto">
        <div class="mb-4 flex justify-between items-center">
            <h2 class="text-lg font-bold">Vaccination Messages</h2>
            <a href="{{ route('vaccine-message.create') }}">
                <button type="button" wire:click="addRow"
                        class="bg-green-900 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none">
                    Add
                </button>
            </a>
        </div>

        @if (session('message'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Table -->
        <table class="min-w-full border-collapse border border-gray-200 shadow-lg">
            <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border border-gray-300 px-4 py-2">Title</th>
                <th class="border border-gray-300 px-4 py-2">Message</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($vaccineMessages as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $item->title }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $item->message_body }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <button type="button" wire:click="addVoice({{ $item->vaccine_message_id }})"
                                class="text-indigo-500 hover:underline">AddVoice</button>
                        <button type="button" wire:click="editRow({{ $item->vaccine_message_id }})"
                                class="text-blue-500 hover:underline">Edit</button>
                        <button type="button" wire:click="removeRow({{ $item->vaccine_message_id }})"
                                class="text-red-500 hover:underline">Remove</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
