@extends('admin.layouts.app')
@section('title', 'Contact')
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
                        <h4 class="text-uppercase"> All Contact </h4>
                    </div>

                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Phone</th>
                                    <th>Email</th>
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
                                        <td>{{ $team->phone }}</td>
                                        <td>{{ $team->email }}</td>
                                        <td>
                                            <!-- Call button -->
                                            <a href="tel:{{ $team->phone }}" class="btn btn-sm btn-primary" title="Call">
                                                <i class="zmdi zmdi-phone"></i>
                                            </a>

                                            <!-- WhatsApp Chat button -->
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $team->phone) }}" target="_blank" class="btn btn-sm btn-success" title="Chat on WhatsApp">
                                                <i class="zmdi zmdi-comment-text"></i>
                                            </a>

                                            <!-- Email button -->
                                            <a href="mailto:{{ $team->email }}" class="btn btn-sm btn-info" title="Send Email">
                                                <i class="zmdi zmdi-email"></i>
                                            </a>
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
