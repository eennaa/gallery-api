<?php

use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Gallery::class, 50)->create()->each(function ($u) {
            $u->images()->save(factory(App\Image::class)->make());
        });
    }
}
