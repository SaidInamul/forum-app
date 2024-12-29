<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Discussion $discussion)
    {
        //
        $post = Post::make($request->validated());

        $post->user()->associate($request->user());
        $post->discussion()->associate($discussion);

        $post->parent()->associate($discussion->post);

        $post->save();

        return redirect(route('discussion.show', $discussion) . '?post=' . $post->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        Gate::authorize('update', $post);
        $fields = $request->validate([
            'body' => ['required', 'max:255']
        ]);
        $post->update($fields);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        Gate::authorize('delete', $post);
        $post->delete();
        return back();
    }
}
