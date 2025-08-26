@extends('admin.layouts.app')
@section('title', 'Edit Review')
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
                    <h4 class="text-uppercase"> Edit review <span><a href="{{ route('review.index') }}" class="btn btn-primary right">All reviews</a></span></h4>

                </div>
                <div class="body">

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

                    <form class="form-horizontal" action="{{ route('review.update', $review->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="review_name_id"><b>Name*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="review_name_id" name="name" class="form-control @error('name')invalid @enderror"
                                        placeholder="Enter Name" value="{{ $review->name }}">
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="review_profession_id"><b>Profession*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="profession" name="profession" class="form-control @error('profession')invalid @enderror"
                                           placeholder="Enter profession" value="{{ $review->profession }}">
                                </div>
                                @error('profession')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="address_id"><b>Address*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="address_id" name="address" class="form-control @error('address')invalid @enderror"
                                         placeholder="Enter Address " value="{{ $review->address }}">
                                </div>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label for="rating_id"><b>Rating*</b></label>
                            <div class="form-group" style="border: 1px solid #ccc">
                                <select name="rating" id="rating_id" class="form-control show-tick">
                                    <option value="">Select Rating</option>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                            {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            @error('rating')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="review_content"><b>Review Content*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <textarea type="text" rows="4" name="review" class="form-control @error('review')invalid @enderror" >
                                        {!! $review->review !!}
                                    </textarea>
                                </div>
                                @error('review')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="customFile"><b>Review Image* (Image size:300 X 300 - Max size : 200px )</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" name="image">
                                </div>
                                <img class="mt-2" src="{{ asset($review->image) }}" alt="" width="40">
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                            <button type="submit"
                                class="btn btn-raised btn-primary m-t-15 waves-effect">UPDATE</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
