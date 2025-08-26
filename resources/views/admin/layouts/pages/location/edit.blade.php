@extends('admin.layouts.app')
@section('title', 'Edit Location URL')
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
                        <h4 class="text-uppercase"> Edit Location <span><a href="{{ route('location.index') }}" class="btn btn-primary right"> All Location </a></span></h4>

                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('location.update', $location->id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="loation_url_id"><b> Location URL </b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="loation_url_id" name="location_url" value="{{ $location->location_url }}" class="form-control"
                                               placeholder="Enter Location Url ">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="brand_id"><b>Status</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <select name="is_active" class="form-control show-tick">
                                            <option {{ $location->location_url == 1 ? 'selected' : '' }} value="1">Active</option>
                                            <option {{ $location->location_url == 0 ? 'selected' : '' }} value="0">DeActive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit"
                                        class="btn btn-raised btn-primary m-t-15 waves-effect">Update</button>
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
