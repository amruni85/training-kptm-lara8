<h1 align=center>Edit Index</h1>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Training') }}</div>

                <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                @csrf <!--nak elakkan 419 Page Expired -->
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $training->title}}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{ $training->description}}</textarea>
                    </div>              
                    <div class="form-group">
                        <label>Trainer</label>
                        <input type="text" name="trainer" class="form-control"  value="{{ $training->trainer}}">
                    </div>
                    <div class="form-group">
                        <label>Attachment</label>
                        <input type="file" name="attachment" class="form-control">
                    </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
