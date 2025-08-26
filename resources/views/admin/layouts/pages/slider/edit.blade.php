@extends('admin.layouts.app')
@section('title', 'Edit Slider')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@endpush
@section('admin_content')
<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase"> Edit Slider <span><a href="{{ route('slider.index') }}" class="btn btn-primary right">All Sliders</a></span></h4>

                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('slider.update', $slider->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="slider_title_id"><b>Slider Title*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="slider_title_id" name="slider_title" class="form-control @error('slider_title')invalid @enderror"
                                        placeholder="Enter slider title " value="{{ $slider->slider_title }}">
                                </div>
                                @error('slider_title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="slider_sub_title"><b>Slider Sub-Title</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" name="slider_sub_title" value="{{$slider->slider_sub_title}}" class="form-control @error('slider_sub_title')invalid @enderror">
                                </div>
                                @error('slider_sub_title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="slider_description"><b>Slider Description</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <textarea type="text" id="" name="slider_description" class="form-control @error('slider_description')invalid @enderror" >
                                        {{$slider->slider_description}}
                                    </textarea>
                                </div>
                                @error('slider_description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="customFile"><b> Image* (Max size :500kb )</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" name="image">
                                </div>
                                <img class="mt-2" src="{{ asset($slider->image) }}" alt="" width="60">
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="brand_id"><b>Status</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <select name="is_active" class="form-control show-tick">
                                        <option @if( $slider->is_active == 1 ) selected @endif value="1">Active</option>
                                        <option @if( $slider->is_active == 0 ) selected @endif value="0">DeActive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

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
