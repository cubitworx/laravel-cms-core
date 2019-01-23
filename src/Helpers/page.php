<?php

use Cubitworx\Laravel\Cms\Core\Support\Page;

if (!function_exists('page')) {
	function page() {
		return app(Page::class);
	}
}
