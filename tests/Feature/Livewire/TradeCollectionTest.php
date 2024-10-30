<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TradeCollection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Tests\TestCase;

class TradeCollectionTest extends TestCase
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
        return Livewire::actingAs($this->user)->test(TradeCollection::class);
    }

    public function test_renders_successfully()
    {
        $this->livewireTestInstance()
            ->assertStatus(200);
    }
}
