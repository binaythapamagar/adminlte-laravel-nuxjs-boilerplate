{{-- Extends Layout --}}
@extends('layouts.backend')

{{-- Page Title --}}
@section('page-title', 'Admin')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Control panel')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('admin') !!}
@endsection

{{-- Header Extras to be Included --}}
@section('head-extras')
    @parent
@endsection
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">

    <div class="container gallery-container">
        <div class="tz-gallery">
            <div class="row">
                @foreach($data as $image)
                    @foreach($image->gallery_images as $images)
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <a class="lightbox" href="{{ asset('images/'.$images->image) }}">
                                    <img src="{{ asset('images/'.$images->image) }}" alt="{{ $images->caption}}">
                                </a>
                                <div class="caption">
                                    <a class="btn btn-danger" href=" {{ route('admingallery.delete-image',$images->id) }}"> <i class="glyphicon glyphicon-trash" ></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
@endsection
