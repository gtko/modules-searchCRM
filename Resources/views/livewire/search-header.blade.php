<div>
    <div class="relative mr-3 sm:mr-6 w-80">
        <div class="search hidden sm:block">
            <input type="text" wire:keydown.escape="close" wire:model.defer.debounce.500ms="search" class="w-full search__input form-control border-transparent placeholder-theme-13" placeholder="Recherche ...">
            <span class="flex items-center">
                <span wire:loading.remove>
                    @icon('search',null,'search__icon dark:text-gray-300')
                </span>
                <span wire:loading>
                     @icon('spinner',null,'search__icon animate-spin')
                </span>
            </span>
        </div>

        @if(!empty($this->search))
            @if($results->count() > 0)
            <div class="search-result show" >
                <div class="intro-x search-result__content">
                    @foreach($results->groupBy('tag') as $label => $items)
                        <div class="intro-y search-result__content__title">
                            {{\Illuminate\Support\Str::ucfirst($label)}}
                        </div>
                        <div class="intro-y mb-5">
                            @foreach($items as $result)
                                <a href="{{$result->url}}" class="intro-x flex items-center mt-2">
                                    <div class="flex justify-start items-center ml-3">
                                        @if($result->getImg() ?? false)
                                            <x-basecore::avatar :url="$result->getImg()"/>
                                        @endif
                                        @if($result->getIcon() ?? false)
                                            <i data-feather="{{$result->getIcon()}}"></i>
                                        @endif
                                        @if($result->getSvg() ?? false)
                                            {!! $result->getSvg() !!}
                                        @endif
                                        <div class="ml-2 flex flex-col">
                                            <div>{{ $result->title }}</div>
                                            @if($result->html)
                                                <div class="-mt-1.5">{!! $result->html ?? '' !!}</div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            @else
                <div class="search-result show" >
                    <div class="intro-x search-result__content">
                        <button type="button" wire:click='close' class="relative block w-full  p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            @icon('empty', null, 'mx-auto h-12 w-12 text-gray-400')
                            <span class="mt-2 block text-sm font-medium text-gray-900">
                                Aucun résultat pour votre recherche "{{$this->search}}"
                            </span>
                        </button>
                    </div>
                </div>
            @endif
        @endif
    </div>
    @if(!empty($this->search))
        <div class="fixed top-0 bottom-0 left-0 right-0 cursor-pointer bg-black bg-opacity-20" wire:click="close">
        </div>
    @endif
</div>
