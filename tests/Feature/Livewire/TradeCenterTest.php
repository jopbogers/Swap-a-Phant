<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TradeCenter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Tests\TestCase;

class TradeCenterTest extends TestCase
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
        return Livewire::actingAs($this->user)->test(TradeCenter::class);
    }

    public function test_renders_successfully()
    {
        $this->livewireTestInstance()
            ->assertStatus(200);
    }
}
