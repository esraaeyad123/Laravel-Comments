<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Input;
use  App\Post;
use  App\User;
use Illuminate\Support\Facades\Storage;




class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allpost=Post::all();
        return view('image')->with('$allpost');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $dim_rule = 'required|integer';
        $validatedData = $request->validate([
                'description'   => 'required|max:255',
                'profile_image' => 'mimes:jpeg,png|max:2000', 
                // we took the most common type of images, also we setup the max size as 2MB 
                'x1'            => $dim_rule,
                'y1'            => $dim_rule,
                'w'             => $dim_rule,
                'h'             => $dim_rule,
            ]);
        // if there is something wrong with the validation it will return the user back with the errors, 
        // I added the in the  layouts/app.blade.php the code that will show the errors if any. 

        if ($request->file('profile_image')->isValid()) // to make sure that it was uploaded to the server correctly 
        {
            $path = $request->profile_image->store('profile_images', 'public'); // see type of disks in config/filesystm.php
        }

        $croppath = public_path('storage/cropped/profile_images/');

        if (!file_exists($croppath)) {
            mkdir($croppath, 0777, true);
        }
        $img = Image::make( public_path('storage/') .  $path); 


        $img->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'));
        
        $img->save($croppath .'/'. $request->profile_image->hashName()); 
        // we save the file to another location BUT with the same name so we can keep the orgoinal file 

       $post = new Post();

       $post->description = $request->description;
       $post->user_id     = auth()->user()->id;
       $post->image       = $path;

       if ($post->save()) 
       {
           return redirect()->back()->with('success', 'post has been created successfully');
       } 

       return redirect()->back()->with('success', 'something went wrong');
       
            
    }

    public function old_store(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();
            $Post = new Post;
        if($request->hasFile('profile_image')) {
            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('profile_image')->storeAs('public/profile_images', $filenametostore);

            if(!file_exists(public_path('storage/profile_images/crop'))) {
                mkdir(public_path('storage/profile_images/crop'), 0755);
            }

            // crop image
            $img = Image::make(public_path('storage/profile_images/'.$filenametostore));
            $croppath = public_path('storage/profile_images/crop/'.$filenametostore);

            $img->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'));
            $img->save($croppath);

            // you can save crop image path below in database
            $path = asset('storage/profile_images/crop/'.$filenametostore);
            $Post->description = $data['description'];
            $Post->image= $path;
            $Post->user_id=auth()->user()->id;

            $Post->save();
            return redirect('home')->with('flash_message_success', 'post has been created successfully');
        }
    }}

    public function show($id)
    {
        $user_id=auth()->user()->id;
        $user=User::find( $user_id);

        return view('view')->with('posts',$user->posts);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {


        $user_id=auth()->user()->id;

        $posts=User::find($user_id);
        $Details = Post::find($id);
      //  dd( $Details);
        return view('edit')->with(compact('Details'));


   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request ,$id )
    { if ($request->isMethod('PATCH')) {
            $data = $request->all();
            $post = Post::find($id);

           $request->hasFile('profile_image');
                //get filename with extension

                $filenamewithextension = $request->file('profile_image')->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $request->file('profile_image')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename.'_'.time().'.'.$extension;

                //Upload File
                $request->file('profile_image')->storeAs('public/profile_images', $filenametostore);

                if(!file_exists(public_path('storage/profile_images/crop'))) {
                    mkdir(public_path('storage/profile_images/crop'), 0755);
                }

                // crop image
                $img = Image::make(public_path('storage/profile_images/'.$filenametostore));
                $croppath = public_path('storage/profile_images/crop/'.$filenametostore);

                $img->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'));
                $img->save($croppath);

                // you can save crop image path below in database
                $path = asset('storage/profile_images/crop/'.$filenametostore);
                $post->image=$path;
            }
            $post->description = $data['description'];


            $post->save();
            return redirect()->back()->with('flash_message_success', 'post has been edited successfully');
        }
        /**}}
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showcomment($id)
    {
        $post = Post::find($id);

        return view('show', compact('post'));
    }
    public function destroy($id)
    {
        Post::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'post has been deleted successfully');
    }
}
