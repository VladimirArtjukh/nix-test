<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = \DB::table('tags')->where('id', 1)->count();
        if ($data == 0) {
            Tag::factory(10)->create();
        }
    }
}
