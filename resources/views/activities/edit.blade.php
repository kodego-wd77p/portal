@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit service') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- CSRF - CROSS SITE REQUEST FORGERY -->
                    <form action="/activity/{{ $activity->id }}/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $activity->title) }}"><br>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ old('description', $activity->description) }}</textarea><br>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">File</label>
                            <input type="file" class="form-control" name="file" value="{{ old('file', $activity->file) }}"><br>
                            @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <p class="text-right">
                                <button type="button" onclick='window.location.href = "/activity/{{ $activity->id }}"' class="btn btn-secondary">Back</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </p>
                        </div>
                    </form>
                </div>
                @if(session('success'))
                <h6 class="alert alert-success">
                    {{ session('success') }}
                </h6>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection






