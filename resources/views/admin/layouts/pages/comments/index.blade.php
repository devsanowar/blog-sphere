@extends('admin.layouts.app')
@section('title')
All Commets
@endsection

@push('styles')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
@endpush

@section('admin_content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase"> All Comments </h4>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse ($comments as $key => $comment)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td><img src="{{ $comment->image ? asset($comment->image) : 'https://randomuser.me/api/portraits/lego/3.jpg' }}" alt="Brand Image" width="40"></td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->comment_text }}</td>

                            <td>
                                @auth
                                    @if(auth()->user()->system_admin === 'Admin')
                                        <form class="d-inline-block" action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-raised bg-pink waves-effect show_confirm"> <i class="material-icons">delete</i> </button>
                                        </form>
                                    @endif
                                @endauth
                            </td>

                        </tr>
                        @empty
                            <tr>
                                Feature Not Found! :) Please Add brand. Thank you
                            </tr>

                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend') }}/assets/bundles/datatablescripts.bundle.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend') }}/assets/js/pages/tables/jquery-datatable.js"></script>
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
