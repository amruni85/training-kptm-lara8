@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    <td>{{$training->user->name}}-{{$training->user->email}}</td>
                    <!--<td>{{$training->created_at}}</td>-->
                    <td>{{$training->created_at ? $training->created_at->diffForHumans():'no date update'}}</td>
                    <td>{{$training->created_at ?? 'no date update'}}</td>
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
