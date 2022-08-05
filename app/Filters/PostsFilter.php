<?php

namespace App\Filters;

use Illuminate\Http\Request;

class PostsFilter extends QueryFilter
{
    private $limit;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->limit = config('common.limitPagination');
    }

    public function description(string $description): void
    {
        $this->builder->where('description', 'like', '%' . strtolower($description) . '%');
    }

    public function title(string $title): void
    {
        $this->builder->where('title', 'like', '%' . strtolower($title) . '%');
    }

    public function author(string $author): void
    {
        $this->builder->where('author', 'like', '%' . strtolower($author) . '%');
    }

    public function page(int $page): void
    {
        $skip = $page === 1 ? 0 : ($this->limit * $page) - $this->limit;
        $this->builder->skip($skip)->take($this->limit);
    }

    public function sort(string $sort) {
        $order = $sort ?? "DESC";
        $this->builder->orderBy('title', $order);
    }
}
