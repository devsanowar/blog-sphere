@extends('admin.layouts.app')
@section('title', 'Location')
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
                        <h4 class="text-uppercase"> Office Location <span><a href="{{ route('location.create') }}" class="btn btn-primary right"> + Add Location  </a></span></h4>
                    </div>

                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Location URL</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($locations as $key => $location)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ Str::limit($location->location_url, 80) }}</td>
                                    <td>
                                        @if($location->is_active == 1)
                                            <a href="" class="btn btn-success">Active</a>
                                        @else
                                            <a href="" class="btn btn-danger">DeActive</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('location.edit', $location->id) }}" class="btn btn-warning">  <i class="material-icons text-white">edit</i></a>

                                        @auth
                                            @if(auth()->user()->system_admin === 'Admin')
                                                <form class="d-inline-block" action="{{ route('location.destroy', $location->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-raised bg-pink waves-effect show_confirm"> <i class="material-icons">delete</i> </button>
                                                </form>
                                            @endif
                                        @endauth
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
                                                Url Not Found! :) Please Add Location URL. Thank you
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
