<?php

namespace Modules\SearchCRM\Http\Livewire;

use Livewire\Component;
use Modules\SearchCRM\Contracts\SearchContract;
use function collect;
use function view;

class SearchHeader extends Component
{

    public string $search = '';

    public function close(){
        $this->search = "";
    }

    /**
     * Get the views / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render(SearchContract $searchService)
    {
        $results = collect([]);
        if(strlen($this->search) > 2){
            $results = $searchService->all()->search($this->search, 3);
        }

        return view('searchcrm::livewire.search-header', [
            'results' => $results
        ]);
    }
}
