<?php


namespace Modules\SearchCRM\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface SearchableRepository
{

    public function isSearchActivate(): bool;

    public function searchStart();
    public function searchStop();

    public function newQuery():Builder;

    public function searchQuery(Builder $query, string $value, mixed $parent = null):Builder;

}
