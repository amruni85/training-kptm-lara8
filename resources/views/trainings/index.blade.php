
@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('alert'))
            <div class="alert {{ session()->get('alert-type')}}">
                {{ session()->get('alert') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    {{ __('Training Index') }}
                    <div class="float-right">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="keyword" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                
                </div>

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
                    <th>Actions</th>
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
                    @can('view', $training) <!--policy utk appear view button kalau user blh view detail, kalau xboleh view hanya tgk detail on surface only  -->
                    <a href="{{route('training:show', $training)}}" class="btn btn-primary">View</a>
                    @endcan
                    @can('update', $training)
                    <a href="{{route('training:edit', $training)}}" class="btn btn-success">Edit</a>
                    @endcan
                    @can('delete', $training)
                    <a onclick="return confirm('Are you sure to delete?')" href="{{route('training:delete', $training)}}" class="btn btn-danger">Delete</a><hr>
                    <a onclick="return confirm('Are you sure to PERMANENTLY DELETE?')" href="{{route('training:forceDelete', $training)}}" class="btn btn-danger">Force Delete</a>
                    @endcan
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{ $trainings
                        ->appends([
                        'keyword'=>request()->get('keyword') 
                        ])
                        ->links()}} <!-- untuk pagination-->
                        <!-- ni kalau guna paginate utk bwk keyword pd next page guna ->appends....-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
