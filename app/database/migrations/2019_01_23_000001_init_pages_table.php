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
		Model\Page::insert([
			'title' => 'Page title',
			'url' => '/',
			'heading' => 'Page heading',
			'description' => 'Page description',
			'status' => config('app.status.page.published'),
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Model\Page::whereIn('url', [
			'/',
		])->delete();
	}

}
