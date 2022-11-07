@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Story Lists</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('story.create') }}"> Create Story</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Image</th>
            <th>Publish Date</th>
            <th>Status</th>
            <th>Created By</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->title }}</td>
            <td>{{ $user->slug }}</td>
            <td>{{ $user->content_with_image }}</td>
            <td>{{ $user->publish_date }}</td>
            <td>{{ $user->status == 1 ? "Active" : "Inactive" }}</td>
            <td>{{ $user->user_id }}</td>
            <td>
                <form action="{{ route('story.destroy',$user->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('story.show',$user->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('story.edit',$user->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $users->links() !!}
      
@endsection