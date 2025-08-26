@extends('admin.layouts.app')
@section('title', 'All Students')
@push('styles')
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
@endpush
@section('admin_content')
<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase"> All Students
                        <span>
                            <button type="button" class="btn btn-primary right" data-bs-toggle="modal"
                                data-bs-target="#addStudentModal">
                                + Add Student
                            </button>
                        </span>
                    </h4>
                </div>


                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Roll Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($students as $key => $student)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->roll_number }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-warning editStudentBtn"
                                        data-id="{{ $student->id }}" data-name="{{ $student->name }}"
                                        data-rollnumber="{{ $student->roll_number }}">
                                        <i class="material-icons text-white">edit</i>
                                    </a>

                                    <form class="d-inline-block" action="{{ route('student.destroy',$student->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-raised bg-pink waves-effect show_confirm">
                                            <i class="material-icons">delete</i> </button>
                                    </form>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>

                <!--Add Category Modal -->
                <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                        class="zmdi zmdi-close"></i> </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('student.store') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Student Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Enter student name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="roll_number" class="form-label">Roll Number</label>
                                        <input type="text" id="roll_number" name="roll_number" class="form-control"
                                            placeholder="Enter student roll number">
                                    </div>

                                    <button type="submit" class="btn btn-primary">SAVE</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <!-- <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                            </div>
                            <form method="POST" id="editCategoryForm" action="">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <input type="hidden" name="category_id" id="edit_category_id">

                                    <div class="mb-3">
                                        <label for="edit_menu_id" class="form-label">Menu</label>
                                        <select name="menu_id" id="edit_menu_id" class="form-control show-tick">
                                            <option value=""> -- Select Menu -- </option>
                                            @foreach($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_category_name" class="form-label">Category Name</label>
                                        <input type="text" id="edit_category_name" name="name" class="form-control"
                                            placeholder="Enter category name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_status" class="form-label">Status</label>
                                        <select name="is_active" id="edit_status" class="form-control show-tick">
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
                <!-- End Edit Category Modal -->

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

<script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>

<!-- Custom Js -->
<script src="{{ asset('backend') }}/assets/js/pages/tables/jquery-datatable.js"></script>
<script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.editCategoryBtn');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-id');
            const categoryMenu = this.getAttribute('data-menu');
            const categoryName = this.getAttribute('data-name');
            const categoryStatus = this.getAttribute('data-status');

            // Fill form fields
            $('#edit_category_id').val(categoryId);
            $('#edit_menu_id').val(categoryMenu).selectpicker('refresh');
            $('#edit_category_name').val(categoryName);
            $('#edit_status').val(categoryStatus).selectpicker('refresh');

            // Update form action
            $('#editCategoryForm').attr('action', `/admin/category/${categoryId}`);

            // Show modal
            const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            editModal.show();
        });
    });
});
</script>

<script>
$('.show_confirm').click(function(event) {
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