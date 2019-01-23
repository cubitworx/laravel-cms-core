<?php

namespace Cubitworx\Laravel\Cms\Core\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $casts = [
		'options' => 'array',
	];

	protected $guarded = [
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
	];

	public static function boot() {
		parent::boot();

		static::saving(function($model)  {
			$model->status = $model->status ?? config('status.page.draft');
			$model->url_hash = $model->url_hash ?? md5($model->url);
		});
	}

	public function contents() {
		return $this->hasMany(Content::class);
	}

	public static function upsert(array $doc, array $where = null) {
		if (isset($doc['template_view']))
			$doc['template_id'] = Template::where('view', $doc['template_view'])->first()->id;

		$result = parent::updateOrCreate($where ? $where : ['url' => $doc['url']], $doc);

		if (!empty($doc['contents'])) {
			foreach ($doc['contents'] as $name => $content) {
				Content::upsert([
					'content' => $content,
					'name' => $name,
					'page_id' => $result->id,
				]);
			}
		}

		return $result;
	}

}
