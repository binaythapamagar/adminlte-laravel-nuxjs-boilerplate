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
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Image</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form  method="post" action="{{ route('admingallery.storeimages',$id) }}" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="caption">Caption</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="image_caption">
                </div>
                <div class="form-group">
                    <label for="grdesc">Choose Image</label>
                    <input type="file" class="form-control"  placeholder="Description" name="image[]" multiple>
                </div>

            </div>
            <input type="hidden" name="id" value="{{ $id }}">
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')

@endsection

