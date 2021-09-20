<?php


namespace Modules\SearchCRM\Entities;


use Illuminate\Support\Collection;

class CollectionSearchResults extends Collection
{
    /**
     * @param mixed ...$values
     * @return $this
     */
    public function push(...$values): CollectionSearchResults
    {
        foreach($values as $value){
            $this->setItem($value);
        }

        return $this;
    }

    protected function setItem(SearchResult $item){
        $this->items[] = $item;

        return $this;
    }

    public function add($item): CollectionSearchResults
    {
        return $this->setItem($item);
    }


}
