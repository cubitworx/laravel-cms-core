<?php

use Cubitworx\Laravel\Cms\Core\Support\Page;

if (!function_exists('page')) {
	function page($url = null, array $data = []) {
		return app()->makeWith(Page::class, ['url'=>$url,'data'=>$data]);
	}
}
