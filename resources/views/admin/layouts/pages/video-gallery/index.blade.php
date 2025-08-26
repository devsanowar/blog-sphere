@extends('admin.layouts.app')
@section('title', 'Video Gallery')
@push('styles')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
@endpush
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> All Video <span><a href="{{ route('video-gallery.create') }}" class="btn btn-primary right"> + Add Video  </a></span></h4>
                    </div>

                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Thumbnail Image</th>
                                <th>Video URL</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($videoGalleries as $key => $videoGallery)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td><img src="{{ asset($videoGallery->image) }}" alt="" height="40"></td>
                                    <td>{{ Str::limit($videoGallery->video_url, 50) }}</td>
                                    <td>
                                        @if($videoGallery->is_active == 1)
                                            <a href="" class="btn btn-success">Active</a>
                                        @else
                                            <a href="" class="btn btn-danger">DeActive</a>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('video-gallery.edit', $videoGallery->id) }}" class="btn btn-warning">  <i class="material-icons text-white">edit</i></a>

                                        @auth
                                            @if(auth()->user()->system_admin === 'Admin')
                                                <form class="d-inline-block" action="{{ route('video-gallery.destroy', $videoGallery->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-raised bg-pink waves-effect show_confirm"> <i class="material-icons">delete</i> </button>
                                                </form>
                                            @endif
                                        @endauth
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
    <!-- #END# Horizontal Layout -->
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
