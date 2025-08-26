@extends('admin.layouts.app')
@section('title', 'Edit Gallery')
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
                        <h4 class="text-uppercase"> Create Gallery
                            <span><a href="{{ route('image-gallery.index') }}" class="btn btn-primary right">All Gallery</a></span>
                        </h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('image-gallery.update', $gallery->id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="title"><b>Image Title</b></label>
                                <div class="form-group">
                                    <div style="border: 1px solid #ccc">
                                        <input type="text" id="title" name="title" value="{{$gallery->title}}" class="form-control"
                                               placeholder="Enter Image Title">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Image</b></label>
                                <div class="form-group">
                                    <div style="border: 1px solid #ccc">
                                        <input type="file" class="form-control @error('images.*')invalid @enderror"
                                               id="customFile" name="image">
                                    </div>
                                    <img src="{{asset($gallery->image)}}" alt="" height="40">
                                    @error('images.*')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="is_active_id"><b>Status</b></label>
                                <div class="form-group">
                                    <div style="border: 1px solid #ccc">
                                        <select name="is_active" class="form-control show-tick">
                                            <option @if($gallery->is_active == 1 ) selected @endif value="1">Active</option>
                                            <option @if($gallery->is_active == 0 ) selected @endif value="0">DeActive</option>
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
@endsection

@push('scripts')
@endpush
