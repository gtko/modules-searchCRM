<?php


namespace Modules\SearchCRM\Interfaces;


use Modules\SearchCRM\Entities\SearchResult;

interface SearchableModel
{

    public function getSearchResult():SearchResult;

}
