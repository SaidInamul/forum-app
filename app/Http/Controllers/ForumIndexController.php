<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\DiscussionResource;
use App\Http\QueryFilters\NoRepliesQueryFilter;

class ForumIndexController extends Controller
{
    protected function allowedFilters() {
        return [
            AllowedFilter::custom('noreplies', new NoRepliesQueryFilter())
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
                    ->paginate(1)
                    ->appends($request->query())
            )
        ]);
    }
}
