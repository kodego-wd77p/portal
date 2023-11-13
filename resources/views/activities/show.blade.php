@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="card-show">
                <div class="card-header">Id No. {{ $activity->id }}</div>

                <div class="card-body container">
                        <div class="row justify-content-start">
                            @if ($user->roles_id == 2)
                            <div class="col-1">
                                <button type="button" class="btn btn-primary" onclick='window.location.href = "/activity/{{ $activity->id }}/edit"'>Edit</button>
                            </div>
                            <div class="col-9">
                                <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Activity</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete activity {{ $activity->activity }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="/activity/{{ $activity->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick='window.location.href = "/activities"'>Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-secondary" onclick='window.location.href = "/activities"'>Back</button>
                            </div><br><br>
                            
                            @elseif ($user->roles_id == 1)
                                <div class="col">
                                    <form action="/activity/{{ $activity->id }}/complete" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <button type="submit" class="btn btn-primary">Complete</button>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <form action="/activity/{{ $activity->id }}/incomplete" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <button type="submit" class="btn btn-danger" id="incomplete-show">Incomplete</button>
                                    </form>
                                </div>
                            <div class="col" id="back-show">
                                <button type="button" class="btn btn-secondary" onclick='window.location.href = "/activities"'>Back</button>
                            </div>
                        </div>
                            @endif
                    </div>
                    <div class="card">
                        <div class="card-header">
                        <h3><center>{{ $activity->title }}</center></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><center>{{ $activity->description }}</center></p>
                            <img class="img-show" src="{{URL::asset('/storage/images/'.substr($activity->file, 14))}}" height="750" width="650"></img>
                        </div>
                    </div><br>
                    @if(session('success'))
                    <h6 class="alert alert-success">
                    {{ session('success') }}
                    </h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






