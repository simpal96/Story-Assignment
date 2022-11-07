@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Story</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('story.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
        There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('story.update',$story->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="title" value="{{ $story->title }}" class="form-control" placeholder="Name">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>slug:</strong>
                        <input type="text" name="slug" value="{{ $story->slug }}" class="form-control" placeholder="Slug">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="image" class="form-control" placeholder="Image">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Publish Date:</strong>
                        <input type="date" name="publish_date" value="{{ $story->publish_date }}" class="form-control">
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Status:</strong>
                        <select class="form-control" name="status">
                        <option value="1" {{ ( $story->status == 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ ( $story->status == 0) ? 'selected' : '' }}>Inactive</option>
                        </select> 
                    </div>
                </div>
            </div>
           
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection