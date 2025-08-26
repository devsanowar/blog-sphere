@extends('admin.layouts.app')
@section('title', 'All Job Post')

@push('styles')

<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">

@endpush


@section('admin_content')


<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase"> All Job Post<span><a href="{{ route('career.create') }}" class="btn btn-primary text-white text-uppercase text-bold right">
                        + Add Job Post
                   </a></span></h4>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
								<th>Job Title</th>
								<th>Job Type</th>
								<th>Location</th>
								<th>Salary</th>
                                <th>Status</th>
                                <th style="width: 70px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($careers as $key=>$career)
                            <tr>
                                <td>{{$key+1 }}</td>
								<td>{{ $career->job_title }}</td>
                                <td>{{ $career->job_type }}</td>
                                <td>{{ $career->location }}</td>
								<td>{{ $career->salary }}</td>
                                <td>
                                    @if($career->is_active == 1)
                                        <a href="" class="btn btn-success">Active</a>
                                    @else
                                        <a href="" class="btn btn-danger">DeActive</a>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('career.edit', $career->id) }}" class="btn btn-warning btn-sm"> <i class="material-icons text-white">edit</i></a>

                                    @auth
                                        @if(auth()->user()->system_admin === 'Admin')
                                            <form class="d-inline-block" action="{{ route('career.destroy', $career->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="material-icons">delete</i></button>
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
