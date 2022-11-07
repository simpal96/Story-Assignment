<?php
  
namespace App\Http\Controllers;
   
use App\Models\Story;
use Auth;
use Illuminate\Http\Request;
  
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
            $users = Story::latest()->paginate(5);    
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
        return view('story.create');
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
        return view('story.edit',compact('story'));
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
        $story->delete();
    
        return redirect()->route('story.index')
                        ->with('success','Story deleted successfully');
    }
}