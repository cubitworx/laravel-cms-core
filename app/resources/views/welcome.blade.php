<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CMS Page Tests</title>
</head>
<body>

	@foreach ([page(), page('/test-1'), page('/test-2', ['heading'=>'Custom heading'])] as $page)
		<h1>{{ $page->heading }}</h1>
		<table>
			<tr><td>branding</td><td>{{ $page->branding }}</td></tr>
			<tr><td>breadcrumbs</td><td>{{ json_encode($page->breadcrumbs) }}</td></tr>
			<tr><td>canonical</td><td>{{ $page->canonical }}</td></tr>
			<tr><td>currentPageUrl</td><td>{{ $page->currentPageUrl }}</td></tr>
			<tr><td>description</td><td>{{ $page->description }}</td></tr>
			<tr><td>heading</td><td>{{ $page->heading }}</td></tr>
			<tr><td>nextPageUrl</td><td>{{ $page->nextPageUrl }}</td></tr>
			<tr><td>noindex</td><td>{{ $page->noindex ? 'true' : 'false' }}</td></tr>
			<tr><td>options</td><td>{{ json_encode($page->options) }}</td></tr>
			<tr><td>previousPageUrl</td><td>{{ $page->previousPageUrl }}</td></tr>
			<tr><td>title</td><td>{{ $page->title }}</td></tr>
			<tr><td>type</td><td>{{ $page->type }}</td></tr>
			<tr><td>url</td><td>{{ $page->url }}</td></tr>
		</table>
	@endforeach

</body>
</html>
