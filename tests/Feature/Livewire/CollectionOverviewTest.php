<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CollectionOverview;
use App\Models\Collection;
use App\Models\Elephant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Tests\TestCase;

class CollectionOverviewTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    private function livewireTestInstance(): Testable
    {
        return Livewire::actingAs($this->user)->test(CollectionOverview::class);
    }

    public function test_renders_successfully()
    {
        $this->livewireTestInstance()
            ->assertStatus(200);
    }

    public function test_display_message_on_empty_collections()
    {
        $this->livewireTestInstance()
            ->assertViewHas('collections', fn($collections) => $collections->count() === 0)
            ->assertSeeText('No elephants found in your collection..');
    }

    public function test_display_message_on_empty_available_elephants()
    {
        $this->livewireTestInstance()
            ->assertViewHas('availableElephants', fn($collections) => $collections->count() === 0)
            ->assertSeeText('No available elephants found...');
    }

    public function test_display_available_elephants()
    {
        $elephant = Elephant::factory()->create();

        $this->livewireTestInstance()
            ->assertViewHas('collections', fn($collections) => $collections->count() === 0)
            ->assertViewHas('availableElephants', fn($collections) => $collections->count() === 1)
            ->assertSeeText('No elephants found in your collection..')
            ->assertDontSee('No available elephants found...')
            ->assertSeeText($elephant->name)
            ->assertSeeText($elephant->description);
    }

    public function test_add_available_elephant_to_collection()
    {
        $elephant = Elephant::factory()->create();

        $this->livewireTestInstance()
            ->assertViewHas('availableElephants', fn($collections) => $collections->count() === 1)
            ->call('addToCollection', $elephant->id)
            ->assertViewHas('collections', fn($collections) => $collections->count() === 1)
            ->assertSeeText('No available elephants found...')
            ->assertDontSee('No elephants found in your collection..')
            ->assertSeeText($elephant->name)
            ->assertSeeText($elephant->description);
    }

    public function test_remove_available_elephant_from_collection()
    {
        $elephant = Elephant::factory()->create();
        $collection = $this->user->collections()->create([
            'elephant_id' => $elephant->id,
            'quantity' => 1
        ]);

        $this->livewireTestInstance()
            ->assertViewHas('collections', fn($collections) => $collections->count() === 1)
            ->call('decrementCollectionQuantity', $collection->id)
            ->assertViewHas('collections', fn($collections) => $collections->count() === 0)
            ->assertSeeText('No elephants found in your collection..');

    }

    public function test_increment_quantity_to_collection()
    {
        $elephant = Elephant::factory()->create();
        $collection = $this->user->collections()->create([
            'elephant_id' => $elephant->id,
            'quantity' => 5
        ]);

        $this->livewireTestInstance()
            ->assertViewHas('collections', fn($collections) => $collections->count() === 1)
            ->call('incrementCollectionQuantity', $collection->id)
            ->assertSeeText(6);
    }

    public function test_decrement_quantity_from_collection()
    {
        $elephant = Elephant::factory()->create();
        $collection = $this->user->collections()->create([
            'elephant_id' => $elephant->id,
            'quantity' => 5
        ]);

        $this->livewireTestInstance()
            ->assertViewHas('collections', fn($collections) => $collections->count() === 1)
            ->call('decrementCollectionQuantity', $collection->id)
            ->assertSeeText(4);
    }
}
