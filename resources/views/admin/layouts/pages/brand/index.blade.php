@extends('admin.layouts.app')
@section('title')
All Brand
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
@endpush

@section('admin_content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase"> All Brand <span><a href="{{ route('brand.create') }}" class="btn btn-primary text-white text-uppercase text-bold right">Add Brand</a></span> </h4>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Brand Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse ($brands as $key => $brand)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td><img src="{{ asset($brand->image) }}" alt="Brand Image" width="40"></td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>
                                @if($brand->is_active == 1)
                                    <a href="" class="btn btn-success">Active</a>
                                @else
                                    <a href="" class="btn btn-danger">DeActive</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-warning">  <i class="material-icons text-white">edit</i></a>
                                <form class="d-inline-block" action="{{ route('brand.destroy', $brand->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-raised bg-pink waves-effect show_confirm"> <i class="material-icons">delete</i> </button>
                                </form>
                            </td>

                        <tr>
                        @empty
                            <tr>
                                Brand Not Found! :) Please Add brand. Thank you
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
