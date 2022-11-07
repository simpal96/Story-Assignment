<?php
  
namespace App\Http\Controllers;
   
use App\Models\Story;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
Use DB;
class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $users = Story::where('user_id', auth()->user()->id)->paginate(5) ;  
            return view('story.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        }else{
            $users = Story::latest()->paginate(5);    
            return view('story.view_story',compact('users'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('story.create');
        }else{
            return redirect('/login');
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userid = Auth::id();
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ]);

        $image = $request->file('image');
        $name=$image->getClientOriginalName();
        $FileType = pathinfo($name, PATHINFO_EXTENSION);
        $rand = md5(uniqid() . rand());
        $post_image = $rand . "." . $FileType;
        $image->move(public_path().'/images', $post_image);

            $story = new Story;
            $user_id = $userid;
            $story->user_id=$user_id;
            $story->title=$request->title;
            $story->slug=$request->slug;
            $story->content_with_image = $post_image;
            $story->publish_date=$request->publish_date;
            $story->status=$request->status;       
            $story->save(); 
     
        return redirect()->route('story.index')
                        ->with('success','Story created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show_view(Request $request)
    {
        $userid = User::where('username', $request->username)->first()->id;
        $story = DB::table('story')
                ->select('*')
                ->where('story.user_id', '=', $userid)
                ->where('story.slug', '=', $request->slug)
                ->get();
        //echo "<pre>"; print_r($story);
        return view('story.show_view',compact('story'));
    } 


     public function show(Story $story)
    {
        return view('story.show',compact('story'));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        if (Auth::check()) {
            return view('story.edit',compact('story'));
        }else{
            return redirect('/login');
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ]);
            $story = Story::find($story->id);
            if($request->image == null){
                $post_image = $story->content_with_image;
            }else{
                $image = $request->file('image');
                $name=$image->getClientOriginalName();
                $FileType = pathinfo($name, PATHINFO_EXTENSION);
                $rand = md5(uniqid() . rand());
                $post_image = $rand . "." . $FileType;
                $image->move(public_path().'/images', $post_image);
            }

            $user_id = Auth::user()->id;
            $story->user_id=$user_id;
            $story->title=$request->title;
            $story->slug=$request->slug;
            $story->content_with_image = $post_image;
            $story->publish_date=$request->publish_date;
            $story->status=$request->status;       
            $story->save(); 
    
        return redirect()->route('story.index')
                        ->with('success','Story updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        if (Auth::check()) {
        $story->delete();
    
        return redirect()->route('story.index')
                        ->with('success','Story deleted successfully');
        }else{
            return redirect('/login');
        }
    }
}