<?php

namespace App\Livewire;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TradeCollection extends Component
{
    public Collection $collection;

    public function mount(int $collectionId)
    {
        $this->collection = Collection::findOrFail($collectionId);
    }

    public function requestTrade(int $targetId, int $requestElephantId)
    {
        Auth::user()->initiatedTrades()->create([
            'offer_elephant_id' => $this->collection->elephant->id,
            'target_id' => $targetId,
            'request_elephant_id' => $requestElephantId,
        ]);

        $this->redirectRoute('trades');
    }

    public function render()
    {
        return view('livewire.trade-collection',
        [
            'tradableUsers' => $this->getUsersWithoutElephant()
        ]);
    }

    private function getUsersWithoutElephant()
    {
        return User::whereDoesntHave('collections', function ($query)  {
            $query->where('elephant_id', $this->collection->elephant->id);
        })->get();
    }
}
