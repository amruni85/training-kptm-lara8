@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Training Index') }}</div>

                <div class="card-body">
                    <table class="table table-hover table-responsive">
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Training Name</th>
                    <th>Trainer</th>
                    <th>Trainee</th>
                    <th>Created At</th>
                    <th>Date</th>
                    <tr>
                    </thead>
                    <tbody>
                    @foreach($trainings as $training)
                    <tr>
                    <td>{{ $training->id}}</td>
                    <td>{{$training->title}}</td>
                    <td>{{$training->trainer}}</td>
                    <td>{{$training->user->name}}<br>{{$training->user->email}}</td>
                    <!--<td>{{$training->created_at}}</td>-->
                    <td>{{$training->created_at ? $training->created_at->diffForHumans():'no date update'}}</td>
                    <td>{{$training->created_at ?? 'no date update'}}</td>
                    <td>
                    <a href="{{route('training:show', $training)}}" class="btn btn-primary">View</a>
                    <a href="{{route('training:edit', $training)}}" class="btn btn-success">Edit</a>
                    <a onclick="return confirm('Are you sure to delete?')" href="{{route('training:delete', $training)}}" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{ $trainings->links()}} <!-- untuk pagination-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
