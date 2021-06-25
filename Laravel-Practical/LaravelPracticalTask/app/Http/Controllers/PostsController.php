<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Posts;

class PostsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        
         $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','show']]);
         $this->middleware('permission:post-create', ['only' => ['create','store']]);
         $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::all();
        return view('posts.index',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

     
        $input = $request->all();
       
        if ($image = $request->file('image')) {
            $destinationPath = 'posts-Images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $posts = Posts::create($input);

        return redirect()->route('posts.index')
                        ->with('success','Product created successfully.');
    }
    
  
  
    public function show($id)
    {
        $posts = Posts::find($id);
        return view('posts.show',compact('posts'));
    }
    

 

    public function edit($id)
    {
        $posts = Posts::find($id);
       
        return view('posts.edit',compact('posts'));

    }
    
    public function update(Request $request, $id)
    {
       
        request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
     
        $input = $request->all();
       
        if ($image = $request->file('image')) {
            $destinationPath = 'posts-Images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        $posts = Posts::find($id);
        $posts->update($input);

    
        return redirect()->route('posts.index')
                        ->with('success','posts updated successfully');
    }
    
    public function destroy($id)
    {
        Posts::find($id)->delete();
    
        return redirect()->route('posts.index')
                        ->with('success','posts deleted successfully');
    }

  

}