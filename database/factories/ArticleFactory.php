<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

function imageUrl($width = 640, $height = 480)
{
	// $baseUrl = "http://lorempixel.com/";
	$baseUrl = "https://loremflickr.com/";
	// $url = "{$width}x{$height}/";
	$url = "{$width}/{$height}";

	$url .= '?random=' . rand(1, 400);

	return $baseUrl . $url;
}

$factory->define(Article::class, function (Faker $faker) {
	return [
		'title' => $faker->sentence(5, true),
		'content' => $faker->paragraphs(15, true),
		'image' => imageUrl(720, 240),
		'user_id' => User::all()->random()->id,
	];
});
