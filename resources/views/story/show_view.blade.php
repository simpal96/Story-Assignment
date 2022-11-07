@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Story</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('story.index') }}"> Back</a>
            </div>
            <br>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $story[0]->title }}
            </div>
            <div class="form-group">
                <strong>Slug:</strong>
                {{ $story[0]->slug }}
            </div>
            <div class="form-group">
                <strong>Publish Date:</strong>
                {{ $story[0]->publish_date }}
            </div>
             <div class="form-group">
                <strong>Status:</strong>
                {{ $story[0]->status == 1 ? "Active" : "Inactive" }}
            </div>
            <div class="form-group">
                <strong>Image:</strong>
                <img src="{{asset('images/').'/'.$story[0]->content_with_image}}" height="200" width="200">
            </div>          
        </div>
    </div>
@endsection