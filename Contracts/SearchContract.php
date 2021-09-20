<?php


namespace Modules\SearchCRM\Contracts;


use Modules\SearchCRM\Entities\CollectionSearchResults;

interface SearchContract
{

    public function search(string $value, int $limit = 5): CollectionSearchResults;

    public function with(...$availables):SearchContract;

    public function all():SearchContract;
}
