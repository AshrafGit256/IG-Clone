<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $url = $this->getUrl('post');
        $mime = $this->getMime($url);

        return [

            'url' => $url,
            'mime' => $mime,
            'mediable_id' => Post::factory(),
            'mediable_type' => function (array $attributes) {
                return Post::find($attributes['mediable_id'])->getMorphClass();
            }
        ];
    }

    function getUrl($type = 'post'): string
    {
        switch ($type) {
            case 'post':

                $urls = [

                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
                    'https://images.unsplash.com/photo-1487744480471-9ca1bca6fb7d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fHNob3BwaW5nfGVufDB8fDB8fHww',
                    'https://plus.unsplash.com/premium_photo-1672883551967-ab11316526b4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8c2hvcHBpbmd8ZW58MHx8MHx8fDA%3D'

                ];
                return $this->faker->randomElement(array: $urls);

                break;


            case 'reel':

                $urls = [

                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4'

                ];
                return $this->faker->randomElement(array: $urls);

                break;

            default:
                # code...
                break;
        }
    }

    function getMime($url): string
    {
        $url = strtolower($url);

        if (str()->contains($url, 'gtv-videos-bucket')) {
            return 'video';
        } elseif (str()->contains($url, 'images.unsplash.com')) {
            return 'image';
        }

        // Default to 'image' if no condition matches
        return 'image';
    }



    #chainable methods(reel)
    function reel(): Factory
    {
        $url = $this->getUrl('reel');
        $mime = $this->getMime($url);

        return $this->state(state: function (array $attributes) use ($url, $mime) {

            return [
                'mime' => $mime,
                'url' => $url,
            ];
        });
    }

    #chainable methods(post)
    function post(): Factory
    {
        $url = $this->getUrl('post');
        $mime = $this->getMime($url);

        return $this->state(state: function (array $attributes) use ($url, $mime) {

            return [
                'mime' => $mime,
                'url' => $url,
            ];
        });
    }
}
