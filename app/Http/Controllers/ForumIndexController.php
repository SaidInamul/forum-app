<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\DiscussionResource;
use App\Http\QueryFilters\NoRepliesQueryFilter;
use App\Http\QueryFilters\ParticipateQueryFilter;
use App\Http\QueryFilters\MyDiscussionQueryFilter;

class ForumIndexController extends Controller
{
    protected function allowedFilters() {
        return [
            AllowedFilter::custom('noreplies', new NoRepliesQueryFilter()),
            AllowedFilter::custom('mine', new MyDiscussionQueryFilter()),
            AllowedFilter::custom('participate', new ParticipateQueryFilter()),
        ];
    }

    public function __invoke (Request $request) {
        return inertia()->render('Forum/Index', [
            'query' => (object) $request->query(),
            'discussions' => DiscussionResource::collection(
                QueryBuilder::for(Discussion::class)
                    ->allowedFilters($this->allowedFilters())
                    ->with(['topic', 'post', 'latestPost.user', 'participants'])
                    ->withCount('replies')
                    ->orderByPinned()
                    ->orderByLastPost()
                    ->paginate(7)
                    ->appends($request->query())
            )
        ]);
    }
}
