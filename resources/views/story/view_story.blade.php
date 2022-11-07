@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
     @foreach($users as $user)
        <div class="col-3">
            <figure>
                <div class="snipcart-item block">
                   <div class="snipcart-thumb">
                       <a href="{{route('story.show', $user->id)}}"><img src="{{asset('images/').'/'.$user->content_with_image}}" height="200" width="200"></a>
                       <h4>{{$user->title}} </h4>
                   </div>
                   <div class="snipcart-details top_brand_home_details">
                     <form action="#" method="post">
                       <fieldset>
                       </fieldset>
                     </form>
                   </div>
                </div>
            </figure>
        </div>
        @endforeach 
      </div> 
    </div>  
@endsection