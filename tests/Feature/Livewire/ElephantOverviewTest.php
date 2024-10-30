<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ElephantOverview;
use App\Models\Elephant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ElephantOverviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        Livewire::test(ElephantOverview::class)
            ->assertStatus(200);
    }

    public function test_display_message_on_empty_elephants()
    {
        Livewire::test(ElephantOverview::class)
            ->assertViewHas('elephants', fn ($elephants) => $elephants->count() === 0)
            ->assertSeeText('No elephants found..');
    }

    public function test_display_elephants()
    {
        $elephant = Elephant::factory()->create();

        Livewire::test(ElephantOverview::class)
            ->assertViewHas('elephants', fn ($elephants) => $elephants->count() === 1)
            ->assertSeeText($elephant->name)
            ->assertSeeText($elephant->description);
    }

    public function test_searching_elephants_without_match()
    {
        Elephant::factory()->create(['name' => 'kees']);

        Livewire::test(ElephantOverview::class)
            ->set('search', 'sjaak')
            ->assertViewHas('elephants', fn ($elephants) => $elephants->count() === 0)
            ->assertSeeText('No elephants found..');
    }

    public function test_searching_elephants_with_match()
    {
        Elephant::factory()->createMany([
            ['name' => 'kees'],
            ['name' => 'mees'],
            ['name' => 'klaas'],
        ]);


        Livewire::test(ElephantOverview::class)
            ->set('search', 'ees')
            ->assertViewHas('elephants', fn ($elephants) => $elephants->count() === 2)
            ->assertSeeText('kees')
            ->assertSeeText('mees');
    }
}
