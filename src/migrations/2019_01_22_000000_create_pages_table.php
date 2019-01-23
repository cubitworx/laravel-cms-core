<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pages', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->nullable();

			$table->string('description')->nullable();
			$table->string('heading')->nullable();
			$table->text('options')->nullable();
			$table->string('status');
			$table->string('title');
			$table->string('type')->nullable();
			$table->integer('template_id')->nullable();
			$table->text('url');
			$table->string('url_hash');

			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();

			$table->unique('url_hash');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('pages');
	}

}
