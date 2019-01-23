<?php

namespace Cubitworx\Laravel\Cms\Core\Model;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {

	protected $guarded = [
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
	];

}
