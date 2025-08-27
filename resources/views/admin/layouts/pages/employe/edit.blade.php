@extends('admin.layouts.app')
@section('title', 'Edit Employe')
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
                        <h4>Edit Employe <span><a href="{{ route('employe.index') }}" class="btn btn-primary right">All Employe</a></span></h4>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('employe.update',$employe->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="employe_name" class="form-label">Name</label>
                                <input type="text" id="employe_name" name="employe_name"
                                    class="form-control" placeholder="Enter employe name" value="{{ $employe->employe_name }}">
                            </div>

                            <div class="mb-3">
                                <label for="employe_phone" class="form-label">Phone</label>
                                <input type="text" id="employe_phone" name="employe_phone"
                                    class="form-control" placeholder="Enter phone number" value="{{ $employe->employe_phone }}">
                            </div>

                            <div class="mb-3">
                                <label for="employe_email" class="form-label">Email</label>
                                <input type="email" id="employe_email" name="employe_email"
                                    class="form-control" placeholder="Enter Email" value="{{ $employe->employe_email }}">
                            </div>


                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
