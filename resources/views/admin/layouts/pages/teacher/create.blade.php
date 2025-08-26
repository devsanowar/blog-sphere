@extends('admin.layouts.app')
@section('title', 'Create Teacher')
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
                        <h4>Create Teacher <span><a href="{{ route('teacher.index') }}" class="btn btn-primary right">All Teacher</a></span></h4>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('teacher.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="teacher_name"
                                    class="form-control" placeholder="Enter name">
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" id="subject" name="subject"
                                    class="form-control" placeholder="Enter subject">
                            </div>


                            <button type="submit" class="btn btn-primary">SAVE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
