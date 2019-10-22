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
            <h3 class="box-title">Create new gallery</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admingallery.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="grname">Gallery Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="gallery_name">
                </div>
                <div class="form-group">
                    <label for="grdesc">Description</label>
                    <input type="text" class="form-control"  placeholder="Description" name="description">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-group" name="status">
                        <option value = 1>Active</option>
                        <option value = 0>Inactive</option>
                    </select>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')

@endsection
