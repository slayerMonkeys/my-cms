<?php

namespace App\View\Components\Navigations;

use Illuminate\View\Component;

class Link extends Component
{
    public $title;
    public $icon;
    public $route;

    public function __construct(string $title, string $icon, $route)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->route = route($route);
    }

    public function render()
    {
        return view('components.navigations.link');
    }
}
