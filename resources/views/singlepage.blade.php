@extends('layouts.header')


@section('content')
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>{{ $singlePages->name }}</h2>
			<p>{{ $singlePages->body }}</p>
		</div>
	</div>
@endsection

@section('title')
    {{ $singlePages->name }}
@endsection