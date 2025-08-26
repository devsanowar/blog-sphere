@extends('admin.layouts.app')
@section('title', 'Edit Blog')
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
                        <h4 class="text-uppercase"> Edit Blog <span><a href="{{ route('blog.index') }}" class="btn btn-primary right">All Blog</a></span></h4>
                    </div>

                    <div class="body">
                        <form class="form-horizontal" action="{{ route('blog.update', $blog->id) }}"
                              method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="menu_id"><b>Menu Name*</b></label>
                                <div class="form-group">
                                    <div style="border: 1px solid #ccc">
                                        <select name="menu_id" class="form-control show-tick" id="menu_id">
                                            <option value="">Select Menu</option>
                                            @foreach ($menus as $menu)
                                                <option value="{{ $menu->id }}" @selected(old('menu_id', $blog->menu_id ?? '') == $menu->id)>
                                                {{ $menu->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="category_id"><b>Blog Category*</b></label>
                                <div class="form-group">
                                    <div style="border: 1px solid #ccc">
                                        <select name="category_id" class="form-control show-tick" id="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id', $blog->category_id ?? '') == $category->id)>
                                                {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="title_id"><b>Blog Title*</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="title_id" name="title" value="{{ $blog->title }}" class="form-control @error('title')invalid @enderror"
                                               placeholder="Enter project title ">
                                    </div>
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="sub_title_id"><b>Blog Sub Title*</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="sub_title_id" name="sub_title" value="{{ $blog->sub_title }}" class="form-control @error('sub_title')invalid @enderror"
                                               placeholder="Enter project title ">
                                    </div>
                                    @error('sub_title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="blog_content"><b>Blog Content</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea name="blog_content" id="ckeditor" class="@error('blog_content') invalid @enderror">{{ $blog->blog_content }}</textarea>
                                    </div>
                                    @error('blog_content')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Project Image (Challenges Image)*</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" name="image">
                                    </div>
                                    <img src="{{ asset($blog->image) }}" alt="" height="40">
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="brand_id"><b>Publication Status*</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <select name="is_active" class="form-control show-tick">
                                            <option @if( $blog->is_active == 1 ) selected @endif value="1">Active</option>
                                            <option @if( $blog->is_active == 0 ) selected @endif value="0">DeActive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit"
                                        class="btn btn-raised btn-primary m-t-15 waves-effect">SAVE</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
    <script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
    <script>
        $(document).ready(function () {
            $('select[name="menu_id"]').on('change', function () {
                var menuId = $(this).val();
                var categorySelect = $('select[name="category_id"]');

                categorySelect.html('<option value="">Select Category</option>');

                if (menuId) {
                    $.ajax({
                        url: '/get-categories/' + menuId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $.each(data, function (key, category) {
                                categorySelect.append('<option value="' + category.id + '">' + category.name + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
