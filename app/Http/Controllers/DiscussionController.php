<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\DiscussionResource;
use App\Http\Requests\StoreDiscussionRequest;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Already done in ForumIndexController
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscussionRequest $request)
    {
        //
        $discussion = Discussion::make([
            'title' => $request->title
        ]);

        $discussion->user()->associate($request->user());
        $discussion->topic()->associate(Topic::find($request->topic));

        $discussion->save();

        $post = Post::make([
            'body' => $request->body
        ]);

        $post->user()->associate($request->user());
        $discussion->posts()->save($post);

        return redirect()->route('discussion.show', $discussion);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Discussion $discussion)
    {
        //
        $discussion->load('topic');
        $discussion->loadCount('replies');
        return inertia()->render('Forum/Show', [
            'query' => (object )$request->query(),
            'discussion' => DiscussionResource::make($discussion),
            'posts' => PostResource::collection(
                Post::whereBelongsTo($discussion)
                ->with(['user', 'discussion'])
                ->oldest()
                ->paginate(5)
            )
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        //
    }
}
