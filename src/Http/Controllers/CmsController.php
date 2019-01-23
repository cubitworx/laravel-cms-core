<?php

namespace Cubitworx\Laravel\Cms\Core\Http\Controllers;

use App\Support\Meta;
use App\Support\Page;
use App\Support\Tagger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class CmsController extends Controller {

	public function show(Request $request) {

		if (!($page = new Page($request))) {
			if ($redirect = Page::redirect())
				return $redirect;
			$legacyController = new LegacyController();
			return $legacyController->handle();
		}

		$links = ['button' => 'Options', 'links' => null];
		if ($page->template_view === 'both-sidebars') {
			if (isset($page->options['links-button-text']))
				$links['button'] = $page->options['links-button-text'];
			if (!$page->children->isEmpty())
				$links['links'] = $page->children;
			elseif ($page->parent_id)
				$links['links'] = \App\Model\Page::where('parent_id', $page->parent_id)->where('id', '!=', $page->id)->orderBy('title')->get();
		}

		$meta = (new Meta())
			->page($page)
			->breadcrumbs([
				['title' => $page->title]
			]);

		$data = [
			'links' => $links,
			'contents' => Tagger::translateEach($page->contents, ['meta'=>$meta]),
			'meta' => $meta,
		];

		$view = 'cms.' . $page->template_view;

		if( !View::exists($view) ) {
			// TODO: Notify admin here
			Log::error("CMS view template does not exist: [$view]. Template ID: [{$page->template_id}]");
			abort( 404 );
		}

		\PC::debug($view, 'debug.cms.view');
		return view($view, $data);
	}

}
