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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Gallery</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="box-tools">
                        <div class="input-group input-group-sm " style="width: 250px;">
                            <div class="input-group-btn">
                                <a href="{{ route('admingallery.create') }}" class="btn btn-primary">Create new</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($data as $gallery)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{$gallery->name}}</td>
                                <td>{{$gallery->description}}</td>
                                @if($gallery ->status == '1')
                                    <td>  <span class="label label-success">Active</span> </td>
                                    @else
                                   <td> <span class="label label-danger">Inactive</span>  </td>
                                    @endif
                                <td> <a href="{{ route('admingallery.images',$gallery->id) }}" title="View Images"><i class="glyphicon glyphicon-eye-open" style="width: 15%"></i> </a>
                                    <a href="{{ route('admingallery.imageadd',$gallery->id) }}" title="Add image"><i class="glyphicon glyphicon-plus" style="width: 15%"></i></a>
                               <a href="{{ route('admingallery.edit',$gallery->id) }}"  title="Edit Album"> <i class="glyphicon glyphicon-pencil" style="width: 15%"></i></a>
                                <a href="{{ route('admingallery.delete',$gallery->id) }}" title="Delete Album"><i class="glyphicon glyphicon-trash danger" style="width: 15%"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')

@endsection
