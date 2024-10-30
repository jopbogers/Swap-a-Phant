<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
        <h1 class="text-3xl mb-6">Discover the Elephant Collection</h1>
        <x-text-input wire:model.live="search" type="search" placeholder="Search elephants by name..."
                      class="mb-12 w-full"/>
        <div class="grid grid-cols-4 gap-7">
            @forelse($elephants as $elephant)
                <div class="bg-white dark:bg-gray-800 overflow-hidden w-full shadow-sm sm:rounded-lg">
                    <img src="{{$elephant->image_path}}" class="rounded-2xl w-full">
                    <h2 class="p-4 text-xl">{{$elephant->name}}</h2>
                    <h2 class="px-4 pb-4 text-md">{{$elephant->description}}</h2>
                </div>
                @empty
                    <p class="text-gray-400">No elephants found..</p>
            @endforelse
        </div>
    </div>
</div>
