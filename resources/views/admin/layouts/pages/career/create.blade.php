@extends('admin.layouts.app')
@section('title', 'Add Job Post')

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
                    <h4 class="text-uppercase"> Create Job Post <span><a href="{{ route('career.index') }}" class="btn btn-primary right">All Job Post</a></span></h4>

                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('career.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input:
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="job_title"><b>Job Title</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" name="job_title" class="form-control @error('job_title') invalid @enderror" value="{{ old('job_title') }}">
                                </div>

                                @error('job_title')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="location"><b>Job Location</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" name="location" class="form-control @error('location') invalid @enderror" value="{{ old('location') }}">
                                </div>

                                @error('location')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="job_type"><b>Job Type</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <select name="job_type" class="form-control show-tick">
                                        <option value="Part Time">Part Time</option>
                                        <option value="Full Time">Full Time</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="salary"><b>Salary</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" name="salary" class="form-control @error('salary') invalid @enderror" value="{{ old('salary') }}">
                                </div>

                                @error('salary')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="description"><b>Description</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <textarea name="description" class="form-control ckeditor @error('description') invalid @enderror" id="" cols="30" rows="10">{{ old('description') }}</textarea>
                                </div>

                                @error('description')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="responsibilities"><b>Job Responsibilities</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <textarea name="responsibilities" class="form-control ckeditor @error('responsibilities') invalid @enderror"
                                              id="" cols="30" rows="10">{{ old('responsibilities') }}</textarea>
                                </div>

                                @error('responsibilities')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="others_requirements"><b>Others Requirements</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <textarea name="others_requirements" class="form-control ckeditor @error('others_requirements') invalid @enderror"
                                              id="" cols="30" rows="5">{{ old('others_requirements') }}</textarea>
                                </div>

                                @error('others_requirements')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="educational_requirements"><b>Educational Requirements</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <textarea name="educational_requirements" class="form-control ckeditor @error('educational_requirements') invalid @enderror"
                                              id="" cols="30" rows="5">{{ old('educational_requirements') }}</textarea>
                                </div>

                                @error('educational_requirements')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="experience_requirements"><b>Experience Requirements</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <textarea name="experience_requirements" class="form-control ckeditor @error('experience_requirements') invalid @enderror"
                                              id="" cols="30" rows="5">{{ old('experience_requirements') }}</textarea>
                                </div>

                                @error('experience_requirements')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="is_active"><b>Status</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <select name="is_active" class="form-control show-tick">
                                        <option value="1">Active</option>
                                        <option value="0">DeActive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                            <button type="submit"
                                class="btn btn-raised btn-primary m-t-15 waves-effect">SAVE</button>
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
