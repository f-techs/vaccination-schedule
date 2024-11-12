<div class="m-8">
    <div class="overflow-x-auto">
        <div class="mb-4 flex justify-between items-center">
            <h2 class="text-lg font-bold">Parent-Child Records</h2>
            <a href="{{ route('parent.create') }}">
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
                    <th class="border border-gray-300 px-4 py-2">Gender</th>
                    <th class="border border-gray-300 px-4 py-2">Date of Birth</th>
                    <th class="border border-gray-300 px-4 py-2">Mobile Number</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Preferred Language</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parents as $item)
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $item->parent_name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $item->child_name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($item->gender === 'Male')
                                <div class="w-4 h-4 bg-blue-500 rounded-full mx-auto"></div>
                            @elseif ($item->gender === 'Female')
                                <div class="w-4 h-4 bg-pink-500 rounded-full mx-auto"></div>
                            @else
                                <div class="w-4 h-4 bg-gray-500 rounded-full mx-auto"></div>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $item->date_of_birth }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $item->mobile_number }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $item->email }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $item->language->name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button type="button" wire:click="editRow({{ $item->parent_id }})"
                                class="text-blue-500 hover:underline">Edit</button>
                            <button type="button" wire:click="removeRow({{ $item->parent_id }})"
                                class="text-red-500 hover:underline">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
