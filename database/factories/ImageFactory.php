<?php
declare(strict_types=1);

/**
 * @author Artuikh Vladimir
 * @copyright 2021 Artuikh Vladimir, vladimir.artjukh@gmail.com
 */

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = \DB::table('image_tags')->where('id', 1)->count();
        if ($data == 0) {
            $now = now();
            return [
                'name' => $this->faker->text($maxNbChars = 10),
                'created_at' => $now,
                'updated_at' => $now
            ];
        } else {
            return [
                //
            ];
        }
    }
}
