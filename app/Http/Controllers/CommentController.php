<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store()
    {
        $comment = new Comment;
        $comment->content = request()->content;
        $comment->product_id = request()->product_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return back();
    }

        public function destroy($id)
        {
            $comment=Comment::find($id);
        if (Gate::allows('comment-delete',$comment)){
            $comment->delete();
            return back()->withSuccess('Comment is deleted successfully.');
        } else {
            return back()->with('error','Comment is not deleted successfully: Unauthorize!');
        }
    }

}
