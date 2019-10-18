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

    <div class="box box-info">
        <div class="box-title">
            <h2>Settings</h2>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#general">General</a></li>
                <li><a data-toggle="tab" href="#socialmedia">Social Media</a></li>
                <li><a data-toggle="tab" href="#meta">meta</a></li>
                <li><a data-toggle="tab" href="#other1">other</a></li>
            </ul>
        </div>
        <div class="box-body">
            <div class="tab-content">
                <div id="general" class="tab-pane fade in active">
                    <div class="col-md-6 col-md-offset-1">
                        <!-- Horizontal Form -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="system_name" class="col-sm-4 control-label">System Name <span
                                            style="color: red">*</span></label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="system_name"
                                               placeholder="System Name" value="{{ old('system_name') ? old('system_name') : App\Utils\Options::get('siteconfig')['system_name'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="slogan" class="col-sm-4 control-label">Slogan<span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="system_slogan" placeholder="Slogan" value="{{ old('system_slogan') ? old('system_slogan') :App\Utils\Options::get('siteconfig')['system_slogan'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="adress" class="col-sm-4 control-label">Address<span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="system_address" placeholder="Address"  value="{{ old('system_address') ? old('system_address') : App\Utils\Options::get('siteconfig')['system_address'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="admin_email" class="col-sm-4 control-label">Admin Email<span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="system_email"
                                               placeholder="Admin Email" value="{{ old('system_email') ? old('system_email') : App\Utils\Options::get('siteconfig')['system_email'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="feedback_email" class="col-sm-4 control-label">Support Email<span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="system_feedback_email"
                                               placeholder="Support Email" value="{{ old('system_feedback_email') ? old('system_feedback_email') : App\Utils\Options::get('system_feedback_email') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telno" class="col-sm-4 control-label">Telephone Number<span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="system_telephone_no"
                                               placeholder="Telephone Number" value="{{ old('system_telephone_no') ? old('system_telephone_no') : App\Utils\Options::get('system_telephone_no') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="mobile" class="col-sm-4 control-label">Mobile Number<span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="system_mobile"
                                               placeholder="Mobile Number" value="{{ old('system_mobile') ? old('system_mobile') : App\Utils\Options::get('system_mobile') }}">
                                    </div>
                                </div>
                                @if( App\Utils\Options::get('brand_image') && App\Utils\Options::get('brand_image') != "" )
                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-8">
                                        <img src="{{ asset('uploads/config/'.App\Utils\Options::get('brand_image')) }}">
                                    </div>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="file" class="col-sm-4 control-label">Brand Logo <span
                                            style="color: red">*</span> </label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" name="logo">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info col-md-offset-6 "> Save</button>
                                </div>
                                <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
            <div id="socialmedia" class="tab-pane fade in ">
                <div class="col-md-6 col-md-offset-1">
                    <!-- Horizontal Form -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{route('admin.settings.social.store')}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="facebook" class="col-sm-4 control-label">Facebook <span
                                        style="color: red">*</span></label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="facebook_url" placeholder="Facebook" value="{{ old('facebook_url') ? old('facebook_url') : App\Utils\Options::get('facebook_url') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="twitter" class="col-sm-4 control-label">Twitter<span
                                        style="color: red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="twitter_url" placeholder="Twitter" value="{{ old('twitter_url') ? old('twitter_url') : App\Utils\Options::get('twitter_url') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="insta" class="col-sm-4 control-label">Instagram<span
                                        style="color: red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="instagram_url" placeholder="Instagram url" value="{{ old('instagram_url') ? old('instagram_url') : App\Utils\Options::get('instagram_url') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="youtube" class="col-sm-4 control-label">Youtube<span
                                        style="color: red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="youtube_url" placeholder="Youtube url" value="{{ old('youtube_url') ? old('youtube_url') : App\Utils\Options::get('youtube_url') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="whats app" class="col-sm-4 control-label">Whats App<span
                                        style="color: red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="whatsapp_number" placeholder="Whatsapp Number" value="{{ old('whatsapp_number') ? old('whatsapp_number') : App\Utils\Options::get('whatsapp_number') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="youtube" class="col-sm-4 control-label">Viber Number<span
                                        style="color: red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="viber_number" placeholder="Viber Number" value="{{ old('viber_number') ? old('viber_number') : App\Utils\Options::get('viber_number') }}">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info col-md-offset-6 "> Save</button>
                            </div>
                            <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
        <div name="meta" class="tab-pane fade in ">
            <div class="col-md-6 col-md-offset-1">
                <!-- Horizontal Form -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="system_name" class="col-sm-4 control-label">meta Name <span
                                    style="color: red">*</span></label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="system_name" placeholder="System Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slogan" class="col-sm-4 control-label">Slogan<span
                                    style="color: red">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="slogan" placeholder="Slogan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="adress" class="col-sm-4 control-label">Address<span style="color: red">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="adress" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="admin_email" class="col-sm-4 control-label">Admin Email<span style="color: red">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="adress" placeholder="Admin Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="feedback_email" class="col-sm-4 control-label">Support Email<span
                                    style="color: red">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="feedback_email"
                                       placeholder="Support Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telno" class="col-sm-4 control-label">Telephone Number<span
                                    style="color: red">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="telno" placeholder="Telephone Number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-sm-4 control-label">Mobile Number<span
                                    style="color: red">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="mobile" placeholder="Mobile Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img_preview" class="col-sm-4 control-label"></label>
                            <div class="col-sm-8">
                                <img src="" class="form-control" height="100" width="100">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file" class="col-sm-4 control-label">Brand Logo <span
                                    style="color: red">*</span> </label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="file" placeholder="Mobile Number">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info col-md-offset-6 "> Save</button>
                        </div>
                        <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
    <div id="other1" class="tab-pane fade in ">
        <div class="col-md-6 col-md-offset-1">
            <!-- Horizontal Form -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ route('admin.settings.store') }}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="system_name" class="col-sm-4 control-label">other Name <span
                                style="color: red">*</span></label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="system_name" placeholder="System Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slogan" class="col-sm-4 control-label">Slogan<span
                                style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="slogan" placeholder="Slogan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adress" class="col-sm-4 control-label">Address<span
                                style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="adress" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="admin_email" class="col-sm-4 control-label">Admin Email<span
                                style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="adress" placeholder="Admin Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="feedback_email" class="col-sm-4 control-label">Support Email<span
                                style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="feedback_email" placeholder="Support Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telno" class="col-sm-4 control-label">Telephone Number<span
                                style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="telno" placeholder="Telephone Number">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile" class="col-sm-4 control-label">Mobile Number<span
                                style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="mobile" placeholder="Mobile Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img_preview" class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <img src="" class="form-control" height="100" width="100">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="file" class="col-sm-4 control-label">Brand Logo <span style="color: red">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="file" placeholder="Mobile Number">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info col-md-offset-6 "> Save</button>
                    </div>
                    <!-- /.box-footer -->
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')

@endsection
