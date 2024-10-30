<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
        <div>
            <h1 class="text-3xl mb-6">Trade Partners for {{$collection->elephant->name}}</h1>
            <div class="flex flex-col gap-12">
                @forelse($tradableUsers as $tradableUser)
                    <div wire:key="user-{{$tradableUser->id}}"
                         class="bg-white dark:bg-gray-800  overflow-hidden justify-between w-full shadow-sm sm:rounded-lg p-5 items-center">
                        <h1 class="text-2xl">{{$tradableUser->name}}</h1>
                        <p class="text-gray-400 mt-6">Available Elephant to trade with:</p>
                        <div class="mt-6">
                            @foreach($tradableUser->collections as $collection)
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-7">
                                        <img src="{{asset($collection->elephant->image_path)}}"
                                             class="rounded-2xl w-24">
                                        <h2 class="text-xl">{{$collection->elephant->name}}</h2>
                                        <h2 class="text-md">{{$collection->elephant->description}}</h2>
                                    </div>
                                    <div>
                                        <x-primary-button wire:click="requestTrade({{$tradableUser->id}}, {{$collection->elephant->id}})">Request trade</x-primary-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400">No trading partner found that could be interested..</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
