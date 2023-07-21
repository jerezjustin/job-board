<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        $tags = Tag::factory(5)->create();

        Listing::factory(25)->create()->each(
            function (Listing $listing) use ($tags): void {
                $tagsCount = random_int(1, 3);

                $listing->tags()->attach($tags->random($tagsCount));
            }
        );
    }
}
