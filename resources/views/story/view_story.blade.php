@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
     @foreach($users as $user)
        <div class="col-3">
            <figure>
                <div class="snipcart-item block">
                   <div class="snipcart-thumb">
                <?php $c = DB::table('users')
                ->select('users.username')
                ->where('users.id',$user->user_id)
                ->get(); ?>

                       <a href="{{route('story.show', '@'.$c[0]->username.'/'.$user->slug)}}"><img src="{{asset('images/').'/'.$user->content_with_image}}" height="200" width="200"></a>
                       <h4>{{$user->title}} </h4>
                       <a href="{{ route('story.edit',$user->id) }}">Edit</a>
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