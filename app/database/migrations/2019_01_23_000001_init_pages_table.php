<?php

use Cubitworx\Laravel\Cms\Core\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InitPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		(new Model\Page([
			'title' => 'Home page',
			'url' => '/',
			'heading' => 'Home page heading',
			'description' => 'Home page description',
			'status' => config('app.status.page.published'),
		]))->save();
		(new Model\Page([
			'title' => 'Test-1 title',
			'url' => '/test-1',
			'heading' => 'Test-1 heading',
			'description' => 'Test-1 description',
			'status' => config('app.status.page.published'),
		]))->save();
		(new Model\Page([
			'title' => 'Test-2 title',
			'url' => '/test-2',
			'heading' => 'Test-2 heading',
			'description' => 'Test-2 description',
			'status' => config('app.status.page.published'),
		]))->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::table('pages')->truncate();
	}

}
