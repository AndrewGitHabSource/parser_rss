<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostsFilter extends QueryFilter
{
    private $limit;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->limit = config('common.limitPagination');
    }

    public function description(string $description)
    {
        $this->builder->where('description', 'like', '%' . strtolower($description) . '%');
    }

    public function title(string $title)
    {
        $this->builder->where('title', 'like', '%' . strtolower($title) . '%');
    }

    public function author(string $author)
    {
        $this->builder->where('author', 'like', '%' . strtolower($author) . '%');
    }

    public function page(int $page)
    {
        $skip = $page === 1 ? 0 : ($this->limit * $page) - $this->limit;
        $this->builder->skip($skip)->take($this->limit);
    }
}
