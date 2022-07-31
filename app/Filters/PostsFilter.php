<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostsFilter extends QueryFilter
{
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

}
