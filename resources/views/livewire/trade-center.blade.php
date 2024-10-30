<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
        <div>
            <h1 class="text-3xl mb-6">Tradable Collection</h1>

            <x-text-input wire:model.live="searchTradeableCollections" type="search"
                          placeholder="Search in your collection..."
                          class="mb-12 w-full"/>
            <div class="flex flex-col gap-7 mb-12">
                @forelse($tradableCollections as $tradableCollection)
                    <div wire:key="collection-{{$tradableCollection->id}}"
                         class="bg-white dark:bg-gray-800 flex overflow-hidden justify-between w-full shadow-sm sm:rounded-lg p-5 items-center">
                        <div class="flex items-center gap-7">
                            <img src="{{$tradableCollection->elephant->image_path}}" class="rounded-2xl w-24">
                            <h2 class="text-xl">{{$tradableCollection->elephant->name}}</h2>
                            <h2 class="text-md">{{$tradableCollection->elephant->description}}</h2>
                            <h2 class="text-md">Available: {{$tradableCollection->quantity}}</h2>

                        </div>

                        <div class="flex gap-7 items-center">

                            <x-primary-button wire:loading.attr="disabled"
                                              wire:click="trade({{ $tradableCollection->id }})"
                                              class="float-right text-2xl">Trade
                            </x-primary-button>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400">No elephants found in your collection..</p>
                @endforelse
                {{$tradableCollections->links()}}
            </div>
        </div>
        <div>
            <h1 class="text-3xl mb-6">Trade Requests</h1>
            <div class="flex flex-col gap-7 mb-12">
                <p class="text-gray-400">Function not implemented yet...</p>
            </div>
        </div>
        <div>
            <h1 class="text-3xl mb-6">Your Trade Requests</h1>
            <div class="flex flex-col gap-7 mb-12">
                @forelse(Auth::user()->initiatedTrades as $trade)
                    <div wire:key="user-{{$trade->id}}"
                         class="bg-white dark:bg-gray-800  overflow-hidden justify-between w-full shadow-sm sm:rounded-lg p-5 items-center">
                        <h1 class="text-2xl">{{$trade->target->name}}</h1>
                        <p class="text-gray-400 mt-6">Requested</p>
                        <div class="mt-6">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-7">
                                    <img src="{{asset($trade->requestElephant->image_path)}}"
                                         class="rounded-2xl w-24">
                                    <h2 class="text-xl">{{$trade->requestElephant->name}}</h2>
                                    <h2 class="text-md">{{$trade->requestElephant->description}}</h2>
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                        <p class="text-gray-400 mt-6">Offered</p>
                        <div class="mt-6">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-7">
                                    <img src="{{asset($trade->offerElephant->image_path)}}"
                                         class="rounded-2xl w-24">
                                    <h2 class="text-xl">{{$trade->offerElephant->name}}</h2>
                                    <h2 class="text-md">{{$trade->offerElephant->description}}</h2>
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                        <h3 class="text-xl mt-6">Status: {{$trade->status}}</h3>
                    </div>
                @empty
                    <p class="text-gray-400">You don't have any trade requests created..</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
