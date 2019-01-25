<?php

namespace Cubitworx\Laravel\Cms\Core\Model;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

	protected $guarded = [
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
	];

	public static function upsert(array $doc, array $where = null) {
		$doc = static::applyMutations(['saving', 'updating'], $doc);
		return parent::updateOrCreate($where ? $where : ['page_id' => $doc['page_id'], 'name' => $doc['name']], $doc);
	}

}
