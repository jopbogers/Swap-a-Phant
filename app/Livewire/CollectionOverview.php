<?php

namespace App\Livewire;

use App\Models\Elephant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CollectionOverview extends Component
{
    public $searchCollection = '';
    public $searchAvailableElephants = '';

    public function addToCollection(int $elephantId)
    {
        $user = Auth::user();

        if (!$user->collections()->where('elephant_id', $elephantId)->exists()) {
            $user->collections()->create([
                'elephant_id' => $elephantId,
            ]);
        }
    }

    public function incrementCollectionQuantity(int $collectionId)
    {
        $collection = Auth::user()->collections()->find($collectionId);
        if ($collection) {
            $collection->increment('quantity');
        }
    }

    public function decrementCollectionQuantity(int $collectionId)
    {
        $collection = Auth::user()->collections()->find($collectionId);

        if ($collection) {
            if ($collection->quantity > 1) {
                $collection->decrement('quantity');
            } else {
                $collection->delete();
            }
        }
    }

    public function render()
    {
        return view('livewire.collection-overview', [
            'collections' => $this->getUserCollections(),
            'availableElephants' => $this->getAvailableElephants(),
        ]);
    }

    private function getUserCollections()
    {
        return Auth::user()->collections()
            ->whereHas('elephant', function ($query) {
                $query->where('name', 'like', '%'.$this->searchCollection.'%');
            })
            ->paginate(4, pageName: 'collection-page');
    }

    private function getAvailableElephants()
    {
        $userElephantIds = Auth::user()->collections()->pluck('elephant_id');

        return Elephant::whereNotIn('id', $userElephantIds)
            ->where('name', 'like', '%'.$this->searchAvailableElephants.'%')
            ->paginate(4, pageName: 'available-page');
    }
}
