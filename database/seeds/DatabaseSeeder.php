<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\User;
use App\Image;
use App\Video;
use App\Album;
use App\Photo;

class DatabaseSeeder extends Seeder
{
    public function run()
    {	

    	Schema::disableForeignKeyConstraints();

    	User::truncate();
    	Album::truncate();
    	Video::truncate();
    	Photo::truncate();
    	Image::truncate();

    	factory(User::class, 10)->create();
    	factory(Album::class, 5)->create();
        factory(Image::class, 50)->create();
    	factory(Photo::class, 15)->create();
    	factory(Video::class, 5)->create();
    }
}
