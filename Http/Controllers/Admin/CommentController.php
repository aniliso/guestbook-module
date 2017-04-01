<?php

namespace Modules\Guestbook\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Guestbook\Entities\Comment;
use Modules\Guestbook\Repositories\CommentRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CommentController extends AdminBaseController
{
    /**
     * @var CommentRepository
     */
    private $comment;

    public function __construct(CommentRepository $comment)
    {
        parent::__construct();

        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = $this->comment->all();

        return view('guestbook::admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('guestbook::admin.comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->comment->create($request->all());

        return redirect()->route('admin.guestbook.comment.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('guestbook::comments.title.comments')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Comment $comment
     * @return Response
     */
    public function edit(Comment $comment)
    {
        return view('guestbook::admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Comment $comment
     * @param  Request $request
     * @return Response
     */
    public function update(Comment $comment, Request $request)
    {
        $this->comment->update($comment, $request->all());

        return redirect()->route('admin.guestbook.comment.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('guestbook::comments.title.comments')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        $this->comment->destroy($comment);

        return redirect()->route('admin.guestbook.comment.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('guestbook::comments.title.comments')]));
    }
}
