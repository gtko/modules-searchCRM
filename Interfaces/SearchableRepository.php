<?php


namespace Modules\SearchCRM\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface SearchableRepository
{
    public function newQuery():Builder;

    public function searchQuery(Builder $query, string $value, mixed $parent = null):Builder;

}
