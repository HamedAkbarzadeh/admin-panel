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
                    /**
     * @OA\Get(
     *    path="/admin/comment",
     *    operationId="comment",
     *    tags={"Comment"},
     *    summary="Get Comments Detail",
     *    description="Get Comments Detail",
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
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

       /**
     * @OA\Post(
     *      path="/admin/comment/answer/{comment}",
     *      operationId="commentAnswer",
     *      tags={"Comment"},
     *      summary="Answer Comment in DB",
     *      description="Answer Brand in DB",
     *        @OA\Parameter(name="comment", in="path", description="Id of comment", required=true,
     *        @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"body"},
     *            @OA\Property(property="body", type="string", format="string", example="Test body"),

     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
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
                    /**
     * @OA\Get(
     *    path="/admin/comment/show/{comment}",
     *    operationId="Commentshow",
     *    tags={"showComment"},
     *    summary="Get comment Detail",
     *    description="Get comment Detail",
     *    @OA\Parameter(name="comment", in="path", description="Id of comment", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
     */
    public function show(Comment $comment)
    {
        return $comment;
    }


                /**
     * @OA\Get(
     *    path="/admin/comment/approved/{comment}",
     *    operationId="commentApproved",
     *    tags={"Comment"},
     *    summary="Approved Comment Detail",
     *    description="Approved Brand Detail",
     *    @OA\Parameter(name="comment", in="path", description="Id of comment", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
     */
    public function approved(Comment $comment)
    {
        $comment->approved == 0 ? $comment->approved = 1 : $comment->approved = 0;
        $comment->save();
        return response()->json([
            'msg' => 'عملیات با موفقیت انجام شد',
            'status' => true,
        ]);
    }
              /**
     * @OA\Get(
     *    path="/admin/comment/status/{comment}",
     *    operationId="commentStatus",
     *    tags={"Comment"},
     *    summary="Change Status",
     *    description="Change Status",
     *    @OA\Parameter(name="comment", in="path", description="Id of comment", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
     */
    public function status(Comment $comment)
    {
        $comment->status == 0 ? $comment->status = 1 : $comment->status = 0;
        $comment->save();
        return response()->json([
            'msg' => 'عملیات با موفقیت انجام شد',
            'status' => true,
        ]);
    }
    // custom
}
