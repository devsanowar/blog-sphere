@extends('admin.layouts.app')
@section('title', 'Edit Video')
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
                        <h4 class="text-uppercase"> Edit Video <span><a href="{{ route('video-gallery.index') }}" class="btn btn-primary right"> All Video </a></span></h4>

                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('video-gallery.update', $videoGallery->id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="video_url_id"><b> Video URL </b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="video_url_id" name="video_url" value="{{ $videoGallery->video_url }}" class="form-control"
                                               placeholder="Enter Video Url ">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Thumbnail Image</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" name="image">
                                    </div>
                                    <img src="{{ asset($videoGallery->image) }}" alt="" height="40">
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
                                            <option {{ $videoGallery->is_active == 1 ? 'selected' : '' }} value="1">Active</option>
                                            <option {{ $videoGallery->is_active == 0 ? 'selected' : '' }} value="0">DeActive</option>
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

@endpush
