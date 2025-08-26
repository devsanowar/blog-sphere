@extends('admin.layouts.app')
@section('title', 'Edit Feature')
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
                        <h4 class="text-uppercase"> Edit Feature <span><a href="{{ route('feature.index') }}" class="btn btn-primary right">All Feature</a></span></h4>

                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('feature.update', $feature->id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="brand_id"><b>Feature Title</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="brand_id" name="feature_title" value="{{$feature->feature_title}}" class="form-control"
                                               placeholder="Enter Feature Title">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Feature Image</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" name="image">
                                    </div>
                                    <img src="{{asset($feature->image)}}" alt="" height="40">
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
