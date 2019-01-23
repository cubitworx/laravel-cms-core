<?php

namespace Cubitworx\Laravel\Cms\Core\Support;

use Carbon\Carbon;
use Cubitworx\Laravel\Cms\Core\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * TODO: find a better way of stripping out first page pagination from URL (page=1)
 */
class Page {

	public $page;

	protected $_data = [];

	public function __construct(Request $request) {
		$this->request = $request;
		// Cannot use $request->fullUrl() because Laravel sorts the query string parameters by the name & also does not always put / at beginning of path
		$this->url = $request->server('REQUEST_URI');

		$this->_loadPage();
	}

	public function __get($name) {
		if( !array_key_exists($name, $this->_data) ) {
			try {
				switch($name) {
					case 'branding':
						$options = $this->options;
						$this->_data['branding'] = isset($options['branding']) ? $options['branding'] : 'default';
						break;
					case 'breadcrumbs':
						$this->setBreadcrumbs([]);
						break;
					case 'canonical':
						$this->_data['canonical'] = config('app.url') . $this->currentPageUrl;
						break;
					case 'currentPageUrl':
						$paginator = $this->paginator;
						$this->_data['currentPageUrl'] = ($paginator && $paginator->onFirstPage()) ? str_replace('?page=1', '', $this->_url) : $this->_url;
						break;
					case 'description':
						$this->_data['description'] = $this->page->description ? $this->page->description : '';
						break;
					case 'heading':
						$this->_data['heading'] = $this->page->heading ? $this->page->heading : $this->title;
						break;
					case 'nextPageUrl':
						$paginator = $this->paginator;
						$this->_data['nextPageUrl'] = $paginator ? $paginator->nextPageUrl() : null;
						break;
					case 'noindex':
						$this->_data['noindex'] = !empty($this->options['noindex']);
						break;
					case 'options':
						$this->setOptions([]);
						break;
					case 'previousPageUrl':
						$paginator = $this->paginator;
						$this->_data['previousPageUrl'] = $paginator ? (
							($paginator->currentPage() === 2) ? str_replace('?page=1', '', $paginator->previousPageUrl()) : $paginator->previousPageUrl()
						) : null;
						break;
					case 'title':
						$this->_data['title'] = $this->page->title;
						break;
					case 'type':
						$this->_data['type'] = $this->page->type ? $this->page->type : 'website';
						break;
					default:
						throw new \Exception('Invalid page metadata key: '.$name);
				}
			} catch (\Exception $e) {
				Log::error("Error building page key: $name", ['exception' => $e]);
				$this->_data[$name] = '';
			}
		}

		return $this->_data[$name];
	}

	public function __set($name, $value) {
		switch($name) {
			case 'breadcrumbs':
				$this->setBreadcrumbs($value);
				break;
			case 'options':
				$this->setOptions($value);
				break;
			default:
				$this->_data[$name] = $value;
				break;
		}
	}

	public function isEmpty($name) {
		$value = $this->{$name};
		return empty($value);
	}

	public function setBreadcrumbs(array $breadcrumbs) {
		$this->_data['breadcrumbs'] = array_merge(
			[['url' => '/', 'title' => 'Home']],
			$this->page->breadcrumbs ?? [],
			$breadcrumbs
		);
		return $this;
	}

	public function setOptions(array $options) {
		$this->_data['options'] = $this->page->options ? ($this->page->options + $options) : $options;
		return $this;
	}

	public function setPaginator(AbstractPaginator $paginator) {
		$this->_data['paginator'] = $paginator;
		return $this;
	}

	/**
	 * Retrieve page (with contents) for current route
	 */
	protected function _loadPage() {
		if (!$this->page) {
			$this->page = Model\Page::where('url', $this->url)->with('contents')->firstOrFail();

			$contents = [];
			foreach ($this->page->contents as $content)
				$contents[$content['name']] = $content['content'];
			$this->page->contents = $contents;
		}

		return $this;
	}

}
