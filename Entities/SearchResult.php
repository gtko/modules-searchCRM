<?php


namespace Modules\SearchCRM\Entities;


use Illuminate\Database\Eloquent\Model;

class SearchResult
{
    private string $img = '';
    private string $icon = '';
    private string $svg = '';

    public function __construct(
        public Model $model,
        public string $title,
        public string $url,
        public string $tag = '',
        public string $html = '',
    ){}

    public function setImg(string $url):void
    {
        $this->img = $url;
    }

    public function setIcon(string $icon):void
    {
        $this->icon = $icon;
    }

    public function setSvg(string $svg):void
    {
        $this->svg = $svg;
    }

    public function getImg():string
    {
        return $this->img;
    }

    public function getIcon():string
    {
        return $this->icon;
    }

    public function getSvg():string
    {
        return $this->svg;
    }

    public function toArray(): array
    {
        return [
           'model' => $this->model->toArray(),
           'title' => $this->title,
           'url' => $this->url,
           'img' => $this->img,
           'icon' => $this->icon,
           'svg' => $this->svg,
           'tag' => $this->tag
        ];
    }
}
