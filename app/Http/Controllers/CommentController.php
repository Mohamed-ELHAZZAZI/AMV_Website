<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    function store($post_id,Request $request)
    {
        $post = Post::where('id' , '=' , $post_id)->first();
        if ($post) {

            $validator = Validator::make($request->all(), [
                'comment_content' => 'required|string',
            ]);

            
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            }

            Comment::create([
                'post_id' => $post_id,
                'user_id' => auth()->user()->id,
                'comment_content' => $request->comment_content,
            ]);

            return response()->json([
                'status' => 200,
                'errors' => 'posted',
            ]);
        }else {
            return response()->json([
                'status' => 400,
                'errors' => 'Error,try again later!',
            ]);
        }
    }
}
