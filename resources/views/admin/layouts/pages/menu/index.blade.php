@extends('admin.layouts.app')
@section('title', 'All Menu')
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
                        <h4 class="text-uppercase"> All Menu
                            <span>
                            <button type="button" class="btn btn-primary right" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                + Add Menu
                            </button>
                        </span>
                        </h4>
                    </div>

                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Menu Name</th>
                                <th>Menu Slug</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($menus as $key => $menu)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->slug }}</td>
                                    <td>{{ $menu->icon_class }}</td>
                                    <td>
                                        @if($menu->is_active == 1)
                                            <a href="#" class="btn btn-success btn-sm">Active</a>
                                        @else
                                            <a href="#" class="btn btn-danger btn-sm">Deactive</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           class="btn btn-warning editCategoryBtn"
                                           data-id="{{ $menu->id }}"
                                           data-name="{{ $menu->name }}"
                                           data-icon="{{ $menu->icon_class }}"
                                           data-status="{{ $menu->is_active }}">
                                            <i class="material-icons text-white">edit</i>
                                        </a>

                                        <form class="d-inline-block" action="{{ route('menu.destroy', $menu->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger show_confirm">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        Menu Not Found! :) Please Add Menu. Thank you
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Add Category Modal -->
                    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"><i class="zmdi zmdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('menu.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="category_name" class="form-label">Menu Name</label>
                                            <input type="text" id="category_name" name="name"
                                                   class="form-control" placeholder="Enter category name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="icon_class" class="form-label">Icon Class</label>
                                            <input type="text" id="icon_class" name="icon_class"
                                                   class="form-control" placeholder="Enter icon class">
                                        </div>
                                        <div class="mb-3">
                                            <label for="is_active" class="form-label">Status</label>
                                            <select name="is_active" class="form-control show-tick" required>
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">SAVE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Category Modal -->
                    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="zmdi zmdi-close"></i></button>
                                </div>
                                <form method="POST" id="editCategoryForm" action="">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" name="category_id" id="edit_category_id">
                                        <div class="mb-3">
                                            <label for="edit_category_name" class="form-label">Menu Name</label>
                                            <input type="text" id="edit_category_name" name="name" class="form-control" placeholder="Enter category name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_icon_class" class="form-label">Icon Class</label>
                                            <input type="text" id="edit_icon_class" name="icon_class" class="form-control" placeholder="Enter icon class">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_status" class="form-label">Status</label>
                                            <select name="is_active" id="edit_status" class="form-control show-tick" required>
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
                    </div>
                    <!-- End Edit Category Modal -->

                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
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
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.editCategoryBtn');

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const categoryId = this.getAttribute('data-id');
                    const categoryName = this.getAttribute('data-name');
                    const categoryIcon = this.getAttribute('data-icon');
                    const categoryStatus = this.getAttribute('data-status');

                    // Fill the form fields
                    document.getElementById('edit_category_id').value = categoryId;
                    document.getElementById('edit_category_name').value = categoryName;
                    document.getElementById('edit_icon_class').value = categoryIcon;

                    // Set the select value then refresh Bootstrap Select
                    $('#edit_status').val(categoryStatus);
                    $('#edit_status').selectpicker('refresh');

                    // Set form action (assuming route: menu.update)
                    document.getElementById('editCategoryForm').action = `/admin/menu/${categoryId}`;

                    // Show the modal
                    const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
                    editModal.show();
                });
            });
        });
    </script>

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
