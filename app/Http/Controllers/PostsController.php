<?php

namespace App\Http\Controllers;


use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class PostsController extends Controller
{
    //show all posts
    function index()
    {
        return view('posts.index', [
            'posts' => Posts::latest()->get(),
        ]);
    }

    //show single post
    function show($id)
    {
        $post = Posts::find($id);
        if ($post) {

            return view('posts.show', [
                'post' => $post
            ]);
        } else {
            abort('404');
        }
    }

    //show posts with Tag
    public function TagFilter($tag)
    {
        return view('posts.index', [
            'tag' => $tag,
            'posts' => Posts::latest()->filter($tag)->get(),
        ]);
    }

    //show posts with Searhc
    public function SearchFilter()
    {

        return view('posts.index', [
            'search' => request('query'),
            'posts' => Posts::latest()->search(request('query'))->get(),
        ]);
    }

    //create post page
    function create()
    {
        return view('posts.create');
    }

    function store(Request $res)
    {
        $validator = Validator::make($res->all(), [
                'title' => 'required | max: 280',
                'tags' => 'required',
                'media' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' =>$validator->messages(),
            ]);
        }else {
            $path = 'media/';
            $media = $res->file('media');
            $file_extention = $media->getClientOriginalExtension() ;
            $media_Name = date('mdYHis') . uniqid() .'.'.$file_extention;
            if (!in_array($file_extention, ['jpg','jpeg','gif','png','mp4','webm','quicktime','x-m4v'])) {
                return response()->json([
                    'status'=> 400,
                    'errors' => ["Invalide file format"],
                ]);
            }
            $upload = $media->storeAs($path, $media_Name, 'public');

            if ($upload) {
                
                $post = new Posts;
                $post->media = $media_Name;
                $post->title = $res->input('title');
                $post->tags = $res->input('tags');
                $post->save();

                return response()->json([
                    'status'=> 200,
                    'message' => 'Post added successfully',
                ]);
            }
            return response()->json([
                'status'=> 400,
                'message' => 'Upload incomplete!',
            ]);

        }
    }
}
