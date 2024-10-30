<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
        <div>
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl">Your Collection</h1>
                <p class="text-gray-400">Total: {{Auth::user()->collections()->count()}}</p>
            </div>
            <x-text-input wire:model.live="searchCollection" type="search" placeholder="Search in your collection..."
                          class="mb-12 w-full"/>
            <div class="flex flex-col gap-7 mb-12">
                @forelse($collections as $collection)
                    <div wire:key="collection-{{$collection->id}}"
                        class="bg-white dark:bg-gray-800 flex overflow-hidden justify-between w-full shadow-sm sm:rounded-lg p-5 items-center">
                        <div class="flex items-center gap-7">
                            <img src="{{$collection->elephant->image_path}}" class="rounded-2xl w-24">
                            <h2 class="text-xl">{{$collection->elephant->name}}</h2>
                            <h2 class="text-md">{{$collection->elephant->description}}</h2>
                        </div>

                        <div class="flex gap-7 items-center">
                            <x-primary-button wire:loading.attr="disabled"
                                              wire:click="incrementCollectionQuantity({{ $collection->id }})"
                                              class="float-right text-2xl">&#10133;
                            </x-primary-button>
                            <p>{{$collection->quantity}}</p>
                            <x-primary-button     wire:loading.attr="disabled"
                                wire:click="decrementCollectionQuantity({{ $collection->id }})"
                                              class="float-right text-2xl">&#10134;
                            </x-primary-button>
                        </div>
                    </div>
                @empty

                    <p class="text-gray-400">No elephants found in your collection..</p>
                @endforelse
                    {{$collections->links()}}
            </div>
        </div>
        <div class="mt-12">
            <h1 class="text-3xl mb-6">Available Elephants</h1>
            <x-text-input wire:model.live="searchAvailableElephants" type="search"
                          placeholder="Search in your collection..."
                          class="mb-12 w-full"/>

            <div class="flex flex-col gap-7 mb-12">
                @forelse($availableElephants as $elephant)
                    <div wire:key="available-{{$elephant->id}}"
                        class="bg-white dark:bg-gray-800 flex overflow-hidden justify-between w-full shadow-sm sm:rounded-lg p-5 items-center">
                        <div class="flex items-center gap-7">
                            <img src="{{$elephant->image_path}}" class="rounded-2xl w-24">
                            <h2 class="text-xl">{{$elephant->name}}</h2>
                            <h2 class="text-md">{{$elephant->description}}</h2>
                        </div>

                        <x-primary-button     wire:loading.attr="disabled" wire:click="addToCollection({{ $elephant->id }})" class="float-right">Add
                        </x-primary-button>
                    </div>
                @empty
                    <p class="text-gray-400">No available elephants found...</p>
                @endforelse
                {{$availableElephants->links()}}
            </div>
        </div>
    </div>
</div>
