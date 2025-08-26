@extends('admin.layouts.app')
@section('title', 'Edit Team')
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
                        <h4>Edit Team Member <span><a href="{{ route('team.index') }}" class="btn btn-primary right">All Team Members</a></span></h4>
                    </div>
                    <div class="card-body">
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

                        <form method="POST" action="{{ route('team.update',$team->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="team_name_id" class="form-label">Name</label>
                                <input type="text" id="team_name_id" name="name"
                                    class="form-control" placeholder="Enter name" value="{{ $team->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="team_designation" class="form-label">Designation</label>
                                <input type="text" id="team_designation" name="position"
                                    class="form-control" placeholder="Enter designtaion" value="{{ $team->position }}">
                            </div>

                            <div class="mb-3">
                                <label for="team_phone" class="form-label">Phone</label>
                                <input type="text" id="team_phone" name="phone"
                                    class="form-control" placeholder="Enter Phone Number" value="{{ $team->phone }}">
                            </div>

                            <div class="mb-3">
                                <label for="team_email" class="form-label">Email</label>
                                <input type="text" id="team_email" name="email"
                                    class="form-control" placeholder="Enter Your Email" value="{{ $team->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="adjective" class="form-label">Adjective</label>
                                <input type="text" id="adjective" name="adjective"
                                       class="form-control" placeholder="Enter adjective" value="{{ $team->adjective }}">
                            </div>

                            <div class="mb-3">
                                <label for="facebook_url" class="form-label">Facebook Url</label>
                                <input type="text" id="facebook_url" name="facebook_url"
                                       class="form-control" placeholder="Enter facebook_url" value="{{ $team->facebook_url }}">
                            </div>

                            <div class="mb-3">
                                <label for="linkedin_url" class="form-label">Linkedin Url</label>
                                <input type="text" id="linkedin_url" name="linkedin_url"
                                       class="form-control" placeholder="Enter linkedin_url" value="{{ $team->linkedin_url }}">
                            </div>

                            <div class="mb-3">
                                <label for="instagram_url" class="form-label">Instagram Url</label>
                                <input type="text" id="instagram_url" name="instagram_url"
                                       class="form-control" placeholder="Enter instagram_url" value="{{ $team->instagram_url }}">
                            </div>

                            <div class="mb-3">
                                <label for="twitter_url" class="form-label">Twitter Url</label>
                                <input type="text" id="twitter_url" name="twitter_url"
                                       class="form-control" placeholder="Enter twitter_url" value="{{ $team->twitter_url }}">
                            </div>

                            <div class="mb-3">
                                <label for="pinterest_url" class="form-label">Pinterest Url</label>
                                <input type="text" id="pinterest_url" name="pinterest_url"
                                       class="form-control" placeholder="Enter pinterest_url" value="{{ $team->pinterest_url }}">
                            </div>

                            <div class="mb-3">
                                <label for="team_designation" class="form-label">Image* (Image Size 350 X 400)- Max: 300kb</label>
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="file" class="form-control" id="customFile" name="image">
                                </div>
                                <img class="mt-2" src="{{ asset($team->image) }}" alt="image" width="60">
                            </div>

                            <div class="mb-3">
                                <label for="team_designation" class="form-label">Status</label>
                                <select name="is_active" class="form-control show-tick">
                                    <option @if($team->is_active == 1 ) selected @endif value="1">Active</option>
                                    <option @if($team->is_active == 0 ) selected @endif value="0">DeActive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
