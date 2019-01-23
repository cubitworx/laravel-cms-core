<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('contents', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('page_id');

			$table->string('name');
			$table->longText('content');

			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();

			$table->index('page_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('contents');
	}

}
