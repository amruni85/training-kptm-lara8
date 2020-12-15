<h1 align="center">Users index</h1>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Index') }}</div>

                <div class="card-body">
                    <table class="table table-hover table-responsive">
                    <thead>
                    <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                    <td>{{ $user->email}}</td>
                    <td>{{$user->name}}</td>
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
