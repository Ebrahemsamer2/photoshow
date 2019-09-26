<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Photo;
use App\Album;
use App\Video;
use App\Image;

use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'admin' => $faker->randomElement([0, 1]),
    ];
});

$factory->define(Album::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->words(10, true),
        'user_id' => User::all()->random()->id,
    ];
});

$factory->define(Image::class, function (Faker $faker) {
    $user_id = User::all()->random()->id;
    $album_id = Album::all()->random()->id;
    $id = $faker->randomElement([$user_id, $album_id]);

    $type = $id == $user_id ? 'App\User' : 'App\Album';
    return [
        'filename' => $faker->randomElement(['user.jpeg', 'image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg']),
        'imageable_id' => $id,
        'imageable_type' => $type,
    ];
});

$factory->define(Photo::class, function (Faker $faker) {
    return [
    	'name' => $faker->word,
    	'filename' => $faker->unique()->randomElement(['1','2','3','4','5','6','7','8','9','10','11', '12', '13', '14', '15']) . '.jpg',
    	'user_id' => User::all()->random()->id,
    	'album_id' => Album::all()->random()->id,
    ];
});


$factory->define(Video::class, function (Faker $faker) {
    return [
    	'title' => $faker->word,
        'filename' => $faker->unique()->randomElement(['1.mp4', '2.mp4', '3.mp4', '4.mp4', '5.mp4']),
        'user_id' => User::all()->random()->id,
    ];
});