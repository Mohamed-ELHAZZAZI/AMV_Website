<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Save;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class PostsController extends Controller
{
    //show all posts
    function index()
    {
        $posts = Post::with('saves')->latest()->get();
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    //show single post
    function show($id)
    {
        return view('posts.show', [
            'post' => Post::with('comments')->findOrFail($id)
        ]);
    }

    //show posts with Tag
    public function TagFilter($tag)
    {
        return view('posts.index', [
            'tag' => $tag,
            'posts' => Post::latest()->filter($tag)->get(),
        ]);
    }

    //show posts with Searhc
    public function SearchFilter()
    {

        return view('posts.index', [
            'search' => request('query'),
            'posts' => Post::latest()->search(request('query'))->get(),
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
            'media' => 'required | mimes:jpg,jpeg,gif,png,mp4,webm,quicktime,x-m4v'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $path = 'media/';
            $media = $res->file('media');
            $file_extention = $media->getClientOriginalExtension();
            $media_Name = date('mdYHis') . uniqid() . '.' . $file_extention;
            $upload = $media->storeAs($path, $media_Name, 'public');

            if ($upload) {

                $post = new Post;
                $post->media = $media_Name;
                $post->title = $res->input('title');
                $post->tags = $res->input('tags');
                $post->user_id = auth()->user()->id;
                $post->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Post added successfully',
                ]);
            }
            return response()->json([
                'status' => 400,
                'message' => 'Upload incomplete!',
            ]);
        }
    }

    function vote($post_id , $vote,Request $request)
    {
        
        $post = Post::find($post_id);
        $other_select = false;
        if ($post) {
            $voteExists = Vote::where('user_id', auth()->user()->id )->where('post_id' , $post_id)->first();
            if ($voteExists) {
                if ($voteExists->status === $vote) {
                    $voteExists->delete();
                    $post->upvotes = count(Vote::where('status' , "upvote")->where('post_id' ,$post->id)->get());
                    $post->downvotes = count(Vote::where('status' , 'downvote')->where('post_id' ,$post->id)->get());
                    $post->save();
                    return response()->json([
                        'status' => 502,
                        'vote' => $vote,
                    ]);
                }
                $voteExists->delete();
                $other_select = true;
            }

            Vote::create([
                'post_id' => $post_id,
                'user_id' => auth()->user()->id,
                'status' => $vote
            ]);

            $post->upvotes = count(Vote::where('status' ,'upvote')->where('post_id' ,$post->id)->get());
            $post->downvotes = count(Vote::where('status' ,'downvote')->where('post_id' ,$post->id)->get());
            $post->save();

           return response()->json([
            'status' => 200,
            'other_selected' => $other_select,
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'Error,try again later',
        ]);
    }

    function save($post_id)
    {
        $post = Post::find($post_id);
        
        if ($post) {

            $saveExists = Save::where('post_id', $post_id)->where('user_id', auth()->user()->id)->first();

            if (!$saveExists) {

                Save::create([
                    'post_id' => $post_id,
                    'user_id' => auth()->user()->id,
                ]);
                
                return response()->json([
                    'status' => 200,
                    'message' => $post_id
                ]);
            }

            $saveExists->delete();

            return response()->json([
                'status' => 250,
                'message' => 'deleted'
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'Error try again later',
        ]);
    }

    function delete($post_id)
    {
        $post = auth()->user()->posts()->findOrFail($post_id);
        $post->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Post Deleted',
        ]);

    }

    function modify($post_id)
    {
        $post = Post::where('user_id', auth()->user()->id)->findOrFail($post_id);

            return view('posts.modify', [
                'post' => $post,
            ]);
    }

    function update($post_id , Request $res)
    {
        $post = Post::where('user_id', auth()->user()->id)->findOrFail($post_id);
          
        $validator = Validator::make($res->all(), [
            'title' => 'required | max: 280',
            'tags' => 'required',
            'media' => "nullable | mimes:jpg,jpeg,gif,png,mp4,webm,quicktime,x-m4v"
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        if ($res->hasFile('media')) {
            
            $path = 'media/';
            $media = $res->file('media');
            $file_extention = $media->getClientOriginalExtension();
            $media_Name = date('mdYHis') . uniqid() . '.' . $file_extention;

            $media->storeAs($path, $media_Name, 'public');
            
            $oldMedia = "storage/media/".$post->media;
            $post->media = $media_Name;
            $file = public_path($oldMedia);
            if (File::isFile($file)) {
                File::delete($file);
            }
        }
        
        $post->title = $res->input('title');
        $post->tags = $res->input('tags');
        $post->update();
        

        return response()->json([
            'status' => 200,
            'message' => 'Post added successfully',
            'id' => $post_id
        ]);

    }
}
