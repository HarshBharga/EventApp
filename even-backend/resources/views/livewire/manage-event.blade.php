<div class="p-6 max-w-7xl mx-auto">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @if (session()->has('success'))
        <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">Events</h2>
        <button wire:click="openModalForCreate"
            class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            + Add Event
        </button>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description</th>
                    <th scope="col" class="relative px-6 py-3 w-36">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($events as $event)
                    <tr>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $event->title }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $event->time }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $event->location }}</td>
                        <td class="whitespace-normal px-6 py-4 text-sm text-gray-500">
                            {{ \Illuminate\Support\Str::limit($event->description, 50) }}</td>
                        <td class="relative whitespace-nowrap px-6 py-4 text-right text-sm font-medium space-x-2">
                            <button wire:click="openModalForEdit({{ $event->id }})"
                                class="text-blue-600 hover:text-blue-900">Edit</button>
                            <button wire:click="confirmDelete({{ $event->id }})"
                                class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center px-6 py-4 text-gray-500">No events found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Background --}}
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            wire:keydown.escape="closeModal" wire:click.self="closeModal">
            <div class="w-full max-w-lg rounded-lg bg-white p-6 shadow-lg" role="dialog" aria-modal="true"
                aria-labelledby="modal-title" wire:keydown.enter="save">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900 mb-4">
                    {{ $isEdit ? 'Edit Event' : 'Add Event' }}
                </h3>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" id="title" wire:model.defer="title"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" id="location" wire:model.defer="location"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('location') border-red-500 @enderror">
                        @error('location')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" rows="3" wire:model.defer="description"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror"></textarea>
                        @error('description')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" id="date" wire:model.defer="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('date') border-red-500 @enderror">
                            @error('date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                            <input type="time" id="time" wire:model.defer="time"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('time') border-red-500 @enderror">
                            @error('time')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal"
                            class="rounded-md bg-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Cancel
                        </button>
                        <button type="submit"
                            class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ $isEdit ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            wire:keydown.escape="$set('showDeleteModal', false)" wire:click.self="$set('showDeleteModal', false)">
            <div class="w-full max-w-sm rounded-lg bg-white p-6 shadow-lg">
                <h3 class="text-lg font-semibold text-red-600 mb-4">Confirm Delete</h3>
                <p>Are you sure you want to delete this event?</p>
                <div class="mt-6 flex justify-end space-x-2">
                    <button wire:click="$set('showDeleteModal', false)"
                        class="rounded-md bg-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button wire:click="deleteConfirmed"
                        class="rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
