<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at' , 'desc')->with(['children' , 'parent'])->paginate(15)->get();
        return response()->json([
            'comments' => $comments,
            'status' => true,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function answer(CommentRequest $request , Comment $comment)
    {
        $inputs = $request->all();
        $inputs['commentable_id'] = $comment->commentable_id;
        $inputs['commentable_type'] = $comment->commentable_type;
        $inputs['parent_id'] = $comment->id;
        $inputs['author_id'] = auth()->user()->id;
        $inputs['seen'] = 1;
        $inputs['status'] = 1;
        $inputs['approved'] = 1;
        $comment = Comment::create($inputs);
        return response()->json([
            'comment' => $comment,
            'status' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        Comment::where('id' , $comment->id)->get()->delete();
        $comment->delete();
        return response()->json([
            'msg' => 'کامنت مورد نظر با موفقیت حذف شد',
            'status' => true,
        ]);
    }

    public function approved(Comment $comment)
    {
        $comment->approved == 0 ? $comment->approved = 1 : $comment->approved = 0;
        $comment->save();
        return response()->json([
            'msg' => 'عملیات با موفقیت انجام شد',
            'status' => true,
        ]);
    }

    public function statua(Comment $comment)
    {
        $comment->statua == 0 ? $comment->statua = 1 : $comment->statua = 0;
        $comment->save();
        return response()->json([
            'msg' => 'عملیات با موفقیت انجام شد',
            'status' => true,
        ]);
    }
    // custom
}
