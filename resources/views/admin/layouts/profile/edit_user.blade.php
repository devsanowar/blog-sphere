@extends('admin.layouts.app')
@section('title', 'Edit User')

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
    <div class="row">
        <div class="col-lg-6 col-md-5 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: inline-block"> Edit User Info</h4>
                </div>
                <div class="body">
                    <form action="{{ route('update.user', $user->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label><b>Name</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"> <i class="material-icons">person</i> </span>
                                <div class="form-line case-input">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" placeholder="Enter Name" disabled>
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
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" placeholder="Enter Email" disabled>
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
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$user->phone}}" placeholder="Enter Phone Number" disabled>
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
                                        <option value="1" {{ $user->system_admin == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ $user->system_admin == 2 ? 'selected' : '' }}>Editor</option>
                                        <option value="3" {{ $user->system_admin == 3 ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-raised btn-warning text-white m-t-15 waves-effect right mb-3" style="font-weight: 500"> UPDATE </button>

                    </form>
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
