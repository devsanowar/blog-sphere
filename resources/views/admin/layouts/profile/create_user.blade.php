@extends('admin.layouts.app')
@section('title', 'Create User')

@push('styles')

<style>

.preview {
    display: inline-block;
    margin: 10px;
}
.preview img {
    width: 100px;
    height: 100px;
    margin-right: 10px;
}
.form-line.case-input {
	border: 1px solid #8a8a8a;
}
</style>

<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

@endpush


@section('admin_content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-5 col-md-5 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: inline-block"> Create New User</h4>
                </div>
                <div class="body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label><b>Name</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"> <i class="material-icons">person</i> </span>
                                <div class="form-line case-input">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Name">
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label><b>Email</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"> <i class="material-icons">email</i> </span>
                                <div class="form-line case-input">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email">
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label><b>Phone</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="material-icons">phone</i> </span>
                                <div class="form-line case-input">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Enter Phone Number">
                                </div>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="system_admin"><b>User Type</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="material-icons">person</i> </span>
                                <div class="form-line case-input">
                                    <select name="system_admin" class="form-control show-tick">
                                        <option value="">-- Choose User Type --</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Editor</option>
                                        <option value="3">User</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label><b>Password</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"> <i class="material-icons">lock</i> </span>
                                <div class="form-line case-input">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label><b>Confirm Password</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"> <i class="material-icons">lock</i> </span>
                                <div class="form-line case-input">
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password">
                                </div>
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-raised btn-warning text-white m-t-15 waves-effect right mb-3" style="font-weight: 500"> SAVE </button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-7 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: inline-block"> All Users</h4>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @php
                            $roles = [
                                1 => 'Super Admin',
                                2 => 'Admin',
                                3 => 'User'
                            ];
                        @endphp

                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->system_admin ?? 'Unknown' }}</td>
                                <td>
                                    <a href="{{ route('edit.user', $user->id) }}" class="btn btn-warning btn-sm">
                                        <i class="material-icons text-white">edit</i>
                                    </a>

                                    <form class="d-inline-block" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm show_confirm">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')

<script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->

<script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>


<script>
$(document).ready(function(){
    $("#file-input").on("change", function(){
        var files = $(this)[0].files;
        $("#preview-container").empty();
        if(files.length > 0){
            for(var i = 0; i < files.length; i++){
                var reader = new FileReader();
                reader.onload = function(e){
                    $("<div class='preview'><img src='" + e.target.result + "'><button class='delete'>Delete</button></div>").appendTo("#preview-container");
                };
                reader.readAsDataURL(files[i]);
            }
        }
    });
$("#preview-container").on("click", ".delete", function(){
        $(this).parent(".preview").remove();
        $("#file-input").val(""); // Clear input value if needed
    });
});

</script>

@endpush
