<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\DiscussionResource;
use App\Http\Requests\StoreDiscussionRequest;

class DiscussionController extends Controller
{
    protected const POSTS_PER_PAGE = 5;

    protected function getPageForPost(Discussion $discussion, $postId) {
        $index = ($discussion->posts->search(fn ($post) => $post->id == $postId));
        $page = (int) ceil(($index + 1) / self::POSTS_PER_PAGE);

        return $page;
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
        if ($postId = $request->get('post')) {
            return redirect()->route('discussion.show', [
                'discussion' => $discussion,
                'page' => $this->getPageForpost($discussion, $postId),
                'postId' => $postId
            ]);
        }
        $discussion->load('topic', 'post.discussion', 'solution');
        $discussion->loadCount('replies');
        return inertia()->render('Forum/Show', [
            'query' => (object )$request->query(),
            'discussion' => DiscussionResource::make($discussion),
            'posts' => PostResource::collection(
                Post::whereBelongsTo($discussion)
                ->with(['user', 'discussion'])
                ->oldest()
                ->paginate(self::POSTS_PER_PAGE)
            ),
            'postId' => (int) $request->postId,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        //
        Gate::authorize('delete', $discussion);
        
        $discussion->delete();
        return redirect()->route('home');
    }

    public function solution (Request $request, Discussion $discussion) {
        $discussion->solution()->associate($discussion->posts()->find($request->post_id));
        $discussion->save();

        return back();
    }
}
