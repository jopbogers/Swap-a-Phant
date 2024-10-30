<?php

namespace Database\Seeders;

use App\Models\Elephant;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ElephantSeeder extends Seeder
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Run the database seeds.
     * @throws GuzzleException
     */
    public function run(): void
    {
        $elephants = [
            [
                'name' => 'Savvy',
                'description' => 'The blue with white elephant representing safefive',
                'image_url' => 'https://elephpant.me/storage/elephpants/81-savvy.jpg',
            ],
            [
                'name' => 'Oscar',
                'description' => 'The blue with orange elephant representing php[tek]',
                'image_url' => 'https://elephpant.me/storage/elephpants/80-oscar.jpg',
            ],
            [
                'name' => 'Ploi',
                'description' => 'The blue elephant representing ploi.io',
                'image_url' => 'https://elephpant.me/storage/elephpants/79-ploi.jpg',
            ],
            [
                'name' => 'Eddie',
                'description' => 'The light blue elephant representing PHP UK',
                'image_url' => 'https://elephpant.me/storage/elephpants/78-eddie.jpg',
            ],
        ];

        foreach ($elephants as $elephant) {
            $image = $this->client->get($elephant['image_url'])->getBody()->getContents();

            $path = 'elephants/' . uniqid() . '.jpg';
            Storage::disk('public')->put($path, $image);

            Elephant::create([
                'name' => $elephant['name'],
                'description' => $elephant['description'],
                'image_path' => 'storage/' . $path,
            ]);
        }
    }
}
