@extends('frontend.layouts.default')
@section('content')
    @php
        $appList = appList();
    @endphp
    <style>
    .m-dropzone.m-dropzone--primary {
        border-color: #5867dd;
    }
    .m-dropzone {
        border: 2px dashed #5867dd !important;
            border-top-color: rgb(235, 237, 242);
            border-right-color: rgb(235, 237, 242);
            border-bottom-color: rgb(235, 237, 242);
            border-left-color: rgb(235, 237, 242);
        border-radius: 4px;
        padding: 20px;
        text-align: center;
        cursor: pointer;

    }
    .dropzone, .dropzone * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    .dropzone.dz-clickable .dz-message, .dropzone.dz-clickable .dz-message * {
        cursor: pointer;
    }
    .dropzone .dz-message {
        text-align: center;
        margin: 2em 0;
    }
    .dropzone.dz-clickable * {
        cursor: default;
    }
    .m-dropzone .m-dropzone__msg-title {
        color: #575962;
    }
    .m-dropzone .m-dropzone__msg-title {
        margin: 0 0 5px 0;
        padding: 0;
        font-weight: 400;
        font-size: 0.9rem;
    }
    .dz-remove{
        color: #007bff !important;
    }
    </style>
    @php
        $appList = appList();
    @endphp
    <section class="loan-process-section section-padding" style="background-color:#fff;">
        <div class="container">
            <div class="row process-list">
                <div class="col-lg-12 col-md-12">
                    <div class="row">   
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success text-black" role="alert">
                                    <i class="fas fa-check"></i> {{ $message }}.
                                </div>
                            @endif
                            @if ($message = Session::get('warning'))
                            <div class="alert alert-warning text-black" role="alert">
                                <i class="fas fa-info"></i> {{ $message }}.
                            </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger text-black" role="alert">
                                    <i class="fas fa-times"></i> Something went wrong.
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <div class="card">
                                <article class="card-group-item">
                                    <header class="card-header" style="background-color: #000;"><h6 class="title text-white h6 mt-2 ml-2">Withdraw Method</h6></header>
                                </article>
                                <div class="filter-content">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        @forelse(@$appList as $key => $app)
                                        <a class="border-0 list-group-item list-group-item-action text-black {{(@$slug==$app->slug || (@$slug==null && $key == 0))?'active':''}}" href="{{route('earning',['slug'=>@$app->slug])}}"><img class="col-md-3 w-25" src="{{@$app->image_path}}" alt=""> {{@$app->title}}</a>
                                        @empty
                                            <a class="border-0 list-group-item list-group-item-action text-black " href="#">Comming Soon</a>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('app-content')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection