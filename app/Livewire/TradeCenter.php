<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TradeCenter extends Component
{
    public $searchTradeableCollections = '';

    public function trade(int $collectionId)
    {
        $this->redirectRoute('trade-collection', ['collectionId' => $collectionId]);
    }

    public function render()
    {
        return view(
            'livewire.trade-center',
            [
                'tradableCollections' => $this->getTradableCollections()
            ]
        );
    }

    public function getTradableCollections()
    {
        return Auth::user()
            ->collections()
            ->where('quantity', '>', 1)
            ->whereHas('elephant', function ($query) {
                $query->where('name', 'like', '%'.$this->searchTradeableCollections.'%');
            })
            ->paginate(4);
    }
}
