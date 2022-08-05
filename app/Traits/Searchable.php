<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable {
    private $searchWhere = false;
    private $searchWhereArray = null;

    public function fullSearch(string|null $searchValue, array $columns, string $model, array $with = null): Builder {
        if ($with) {
            $query = $model::query()->with($with);
        }
        else{
            $query = $model::query();
        }

        if ($this->searchWhere) {
            $query->orWhere($this->searchWhereArray['column'], $this->searchWhereArray['exp'], $this->searchWhereArray['value']);
        }

        foreach($columns as $column) {
            $query->orWhere($column, 'LIKE', '%' . $searchValue . '%');
        }

        return $query;
    }
}
