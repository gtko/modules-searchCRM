<?php


namespace Modules\SearchCRM\Services;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Modules\SearchCRM\Contracts\SearchContract;
use Modules\SearchCRM\Entities\CollectionSearchResults;
use Modules\SearchCRM\Interfaces\SearchableModel;

class SearchCRM implements SearchContract
{
    private array $repositories = [];

    public function with(...$repositories): SearchContract
    {
        $this->repositories = $repositories;

        return $this;
    }

    public function all(): SearchContract
    {
        $this->repositories = config('searchcrm.repositories');

        return $this;
    }

    public function search(string $value, int $limit = 5): CollectionSearchResults
    {
        $results = new CollectionSearchResults([]);

        if($value) {
            foreach ($this->repositories as $repository) {
                $repository = app($repository);
                if(Gate::allows('view', $repository->getModel())) {
                    $query = $repository->newQuery();
                    foreach (explode(' ', $value) as $lem) {
                        $query->where(function (Builder $query) use ($repository, $lem) {
                            $query->setQuery(
                                $repository->searchQuery($query, $lem)
                                    ->getQuery()
                            );
                        });
                    }

                    $results->push(
                        ...$query
                        ->limit($limit)
                        ->get()
                        ->map(function (SearchableModel $item) {
                            return $item->getSearchResult();
                        })
                    );
                }
            }
        }

        return $results;
    }

}
