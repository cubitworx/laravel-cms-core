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
			'heading' => 'Page heading',
			'title' => 'Page title',
			'url' => '/',
			'description' => 'Page description',
			'status' => config('status.page.published'),
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
