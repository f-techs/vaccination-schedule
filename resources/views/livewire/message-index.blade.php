<div class="m-8">
    <div class="overflow-x-auto">
        <div class="mb-4 flex justify-between items-center">
            <h2 class="text-lg font-bold">Schedule Messages</h2>
            <a href="{{ route('message.create') }}">
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
                <th class="border border-gray-300 px-4 py-2">Parent Name</th>
                <th class="border border-gray-300 px-4 py-2">Child Name</th>
                <th class="border border-gray-300 px-4 py-2">Message Title </th>
                <th class="border border-gray-300 px-4 py-2">Message Type</th>
                <th class="border border-gray-300 px-4 py-2">Language</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($schedules as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $item->parent->parent_name ?? '' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $item->parent->child_name ?? ''}}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $item->vaccineMessages->title ?? '' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $item->messageType->type ?? ''}}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $item->language->name ?? ''}}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $item->status == 0 ? 'UnRead' : 'Read'}}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
{{--                        <button type="button" wire:click="editRow({{ $item->parent_id }})"--}}
{{--                                class="text-blue-500 hover:underline">Edit</button>--}}
                        <button type="button" wire:click="removeRow({{ $item->message_id ?? '' }})"
                                class="text-red-500 hover:underline">Remove</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
