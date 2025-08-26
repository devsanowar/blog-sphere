@extends('admin.layouts.app')
@section('title', 'Teams')
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
                        <h4 class="text-uppercase"> All Team Members
                            <span>
                                <button type="button" class="btn btn-primary right" data-bs-toggle="modal" data-bs-target="#addTeamModal">
                                    Add Member
                                </button>
                            </span>
                        </h4>
                    </div>


                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($teams as $key => $team)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td><img src="{{ asset($team->image) }}" alt="image" width="30"></td>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->position }}</td>
                                        <td>
                                            @if($team->is_active == 1)
                                                <a href="" class="btn btn-success">Active</a>
                                            @else
                                                <a href="" class="btn btn-danger">DeActive</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('team.edit', $team->id) }}" class="btn btn-raised bg-warning"> <i class="material-icons text-white">edit</i></a>

                                            <form class="d-inline-block" action="{{ route('team.destroy',$team->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-raised bg-pink waves-effect show_confirm"> <i
                                                        class="material-icons">delete</i> </button>
                                            </form>
                                        </td>

                                    <tr>
                                    @empty
                                    <table>
                                        <thead>
                                            <tr>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                Team Member Not Found! :) Please Add Team Member. Thank you
                                            </tr>
                                        </tbody>
                                    </table>

                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <!--Add Team Modal -->
                    <div class="modal fade" id="addTeamModal" tabindex="-1" aria-labelledby="addTeamModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Member</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"><i class="zmdi zmdi-close"></i> </button>
                                </div>
                                <div class="modal-body">

                                    <!-- Check if any validation errors exist and show them -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('team.store') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="team_name_id" class="form-label">Name</label>
                                            <input type="text" id="team_name_id" name="name"
                                                class="form-control" placeholder="Enter name">
                                        </div>

                                        <div class="mb-3">
                                            <label for="team_designation" class="form-label">Designation</label>
                                            <input type="text" id="team_designation" name="position"
                                                class="form-control" placeholder="Enter designtaion">
                                        </div>

                                        <div class="mb-3">
                                            <label for="team_phone" class="form-label">Phone</label>
                                            <input type="text" id="team_phone" name="phone"
                                                class="form-control" placeholder="Enter Phone Number">
                                        </div>

                                        <div class="mb-3">
                                            <label for="team_email" class="form-label">Email</label>
                                            <input type="text" id="team_email" name="email"
                                                class="form-control" placeholder="Enter Your Email">
                                        </div>

                                        <div class="mb-3">
                                            <label for="adjective" class="form-label">Adjective</label>
                                            <input type="text" id="adjective" name="adjective"
                                                class="form-control" placeholder="Enter adjective">
                                        </div>

                                        <div class="mb-3">
                                            <label for="facebook_url" class="form-label">Facebook Url</label>
                                            <input type="text" id="facebook_url" name="facebook_url"
                                                class="form-control" placeholder="Enter facebook_url">
                                        </div>

                                        <div class="mb-3">
                                            <label for="linkedin_url" class="form-label">Linkedin Url</label>
                                            <input type="text" id="linkedin_url" name="linkedin_url"
                                                class="form-control" placeholder="Enter linkedin_url">
                                        </div>

                                        <div class="mb-3">
                                            <label for="instagram_url" class="form-label">Instagram Url</label>
                                            <input type="text" id="instagram_url" name="instagram_url"
                                                   class="form-control" placeholder="Enter instagram_url">
                                        </div>

                                        <div class="mb-3">
                                            <label for="twitter_url" class="form-label">Twitter Url</label>
                                            <input type="text" id="twitter_url" name="twitter_url"
                                                   class="form-control" placeholder="Enter twitter_url">
                                        </div>

                                        <div class="mb-3">
                                            <label for="pinterest_url" class="form-label">Pinterest Url</label>
                                            <input type="text" id="pinterest_url" name="pinterest_url"
                                                   class="form-control" placeholder="Enter pinterest_url">
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image* (Image Size 350 X 400)- Max: 300kb</label>
                                            <div class="" style="border: 1px solid #ccc">
                                                <input type="file" class="form-control" id="customFile" name="image">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="team_designation" class="form-label">Status</label>
                                            <select name="is_active" class="form-control show-tick">
                                                <option value="1">Active</option>
                                                <option value="0">DeActive</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">SAVE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
<script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>


<script>
    $('.show_confirm').click(function(event){
        let form = $(this).closest('form');
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
                });
            }
            });

    });


</script>


@endpush
