@extends('admin.layouts.app')
@section('title', 'Edit Teacher')
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
                        <h4>Edit Teacher <span><a href="{{ route('teacher.index') }}" class="btn btn-primary right">All Teacher</a></span></h4>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('teacher.update', $teacher->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="teacher_name"
                                    class="form-control" placeholder="Enter name" value="{{ $teacher->teacher_name }}">
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" id="subject" name="subject"
                                    class="form-control" placeholder="Enter subject" value="{{ $teacher->subject }}">
                            </div>


                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
