<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Auth;
use Session;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $request->postId,
            'body' => $request->comment,
        ]);

        $img = ($comment->user->image) ? asset("storage/".$comment->user->image) : asset("/images/blank-profile.png");

        $wholeComment = '<div id="'.$comment->id.'"single-comment"" class="flex mb-4">'
                            .'<img class="mr-2 absolute" src="'.$img.'" width="50" height="50">'.
                            '<div>'.
                                '<div class="ml-16">'.
                                    '<p>'.$comment->user->userName.' | '.$comment->created_at->diffForHumans().'</p>'.
                                    '<p id="'.$comment->id.'"comment-val"" class="text-base">'.$comment->body.'</p>'.
                                '</div>'.

                                '<div class="flex ml-16">'.
                                    '<span><button type="button" edit-id="'.$comment->id.'" class="edit text-sm text-blue-500">Edit</button> </span>'.

                                    '<span class="ml-2"><button type="button" class="delete text-sm text-red-500" delete-id="'.$comment->id.'">Delete</button> </span>'.
                                '</div>'.
                            '</div>'.
                        '</div>'.

                        '<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Comment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="comment" class="col-form-label">Comment:</label>
                                                <textarea class="form-control" id="comment" name="comment"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button id="edit-button" type="button" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>'. 

                        '<script>
                            $(".delete").on("click", function(e) {
                                var commentId = '.$comment->id.';
                                e.preventDefault();
                                var _token = "'.Session::token().'";
                                $.ajax({
                                    type: "DELETE",
                                    url: "'.route("comment.destroy").'",
                                    data: {commentId:commentId, _token:_token},
                                    success: function(msg) {
                                        $("#" + '.$comment->id.' + "single-comment").remove();
                                        location.reload();
                                    }
                                });
                            });
                        </script>'.

                        '<script>
                            $(".edit").on("click", function(e) {
                                var commentId = '.$comment->id.';
                                var commentVal = "'.$comment->body.'";
                                e.preventDefault();
                                $("#comment").val(commentVal);
                                $("#editModal").modal("show");
                                var _token = "'.Session::token().'";
                                $("#edit-button").on("click", function(e) {
                                    var newCommentVal = $("#comment").val();
                                    $.ajax({
                                        type: "PUT",
                                        url: "'.route("comment.update").'",
                                        data: {commentId:commentId, _token:_token, newCommentVal:newCommentVal},
                                        success: function(msg) {
                                            $("#editModal").modal("hide");
                                            location.reload();
                                        }
                                    });
                                });
                            });
                        </script>';


        return response()->json([

            'commentId' => $comment->id,
            'comment' => $wholeComment,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $comment = Comment::whereId($request->commentId)->firstOrFail();

        $comment->update([
            'body' => $request->newCommentVal,
        ]);

        return response()->json([
            'updatedComment' => $comment->body,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $comment = Comment::whereId($request->commentId)->firstOrFail();

        $comment->delete();

        return response()->json();
    }

}
