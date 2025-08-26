@extends('admin.layouts.app')
@section('title', 'Messages')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="text-uppercase">Client Messages</h4>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Message</th>
                                <th>Submitted At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($messages as $key => $message)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ Str::words($message->address, 3, '...') }}</td>
                                    <td>{{ Str::words($message->message, 3, '...') }}</td>
                                    <td>{{ $message->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}</td>
                                    <td>
                                        <!-- Detail Button -->
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#messageModal{{ $message->id }}">
                                            <i class="material-icons">info</i>
                                        </button>

                                        @auth
                                            @if(auth()->user()->system_admin === 'Admin')
                                                <!-- Delete Form -->
                                                    <form class="d-inline-block" action="{{ route('sendus.destroy', $message->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-raised bg-pink waves-effect show_confirm">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </form>
                                            @endif
                                        @endauth
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No messages found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($messages as $message)
        <!-- Modal -->
        <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Message Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> {{ $message->name }}</p>
                        <p><strong>Email:</strong> {{ $message->email }}</p>
                        <p><strong>Phone:</strong> {{ $message->phone }}</p>
                        <p><strong>Address:</strong> {{ $message->address }}</p>
                        <p><strong>Subject:</strong> {{ $message->subject }}</p>
                        <p><strong>Message:</strong></p>
                        <div class="border p-2" style="text-align: justify">{{ $message->message }}</div>
                        <p class="mt-3"><strong>Submitted At:</strong> {{ $message->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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
