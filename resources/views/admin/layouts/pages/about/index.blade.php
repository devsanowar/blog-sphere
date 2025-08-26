@extends('admin.layouts.app')
@section('title')
    About
@endsection
@push('styles')
    <style>
        .form-group .form-control {
            padding-left: 10px;
        }
    </style>
@endpush

@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> About Information Update</h4>
                    </div>
                    <div class="body">

                        <!-- Check if any validation errors exist and show them -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" action="{{ route('about.update') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="about_title_id"><b>About Title</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="about_title_id" name="about_title" class="form-control"
                                               placeholder="Enter about title " value="{{ $about->about_title }}">
                                    </div>
                                </div>
                            </div>

{{--                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">--}}
{{--                                <label for="about_sub_title_id"><b>About Sub-Title</b></label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="" style="border: 1px solid #ccc">--}}
{{--                                        <input type="text" id="about_sub_title_id" name="about_sub_title" class="form-control"--}}
{{--                                               placeholder="Enter about sub-title " value="{{ $about->about_sub_title }}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="banner_description"><b>Short Description</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea type="text" id="ckeditor" name="description" class="form-control">
                                        {!! $about->description !!}
                                    </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label><b>Image </b></label>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="image">
                                    <img src="{{ asset($about->image) }}" width="40" class="mt-2">
                                </div>
                            </div>

{{--                            <div class="col-lg-12 mb-3">--}}
{{--                                <label><b>Image (About Page)</b></label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="file" class="form-control" name="image_two">--}}
{{--                                    <img src="{{ asset($about->image_two) }}" width="40" class="mt-2">--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit"
                                        class="btn btn-raised btn-primary m-t-15 waves-effect">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
    <script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>
@endpush
