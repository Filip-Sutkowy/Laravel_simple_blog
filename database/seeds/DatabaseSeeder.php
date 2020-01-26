<?php

use App\Article;
use App\Comment;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		Comment::truncate();
		Article::truncate();
		User::truncate();

		$usersQuantity = 20;
		$articlesQuantity = 40;
		$commentsQuantity = 200;

		factory(User::class, $usersQuantity)->create();
		factory(Article::class, $articlesQuantity)->create();
		factory(Comment::class, $commentsQuantity)->create();
	}
}
