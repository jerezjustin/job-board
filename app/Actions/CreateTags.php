<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Str;

class CreateTags
{
    /**
     * @param Tag[] $tags
     */
    public function handle(string|array $tags): Collection
    {
        $tagsArray = $tags;

        if(is_string($tags)) {
            $tagsArray = explode(',', $tags);
        }

        return $this->create($tagsArray);
    }

    /**
     * @param Tag[] $tags
     */
    protected function create(array $tags): Collection
    {
        $result = new Collection();

        foreach($tags as $tag) {
            $result->push(
                Tag::firstOrCreate([
                    'slug' => Str::slug(trim($tag))
                ], [
                    'name' => ucwords(trim($tag))
                ])
            );
        }

        return $result;
    }
}
