@extends('frontend.layouts.default')
@section('content')
@section('title', @$cms->page_title)
<div class="container mt-20 mb-20">
    <div class="col-md-12">
        <h2>
            {{@$cms->page_title}}
        </h2>
        {!! @$cms->page_content !!}
    </div>
</div>
@endsection