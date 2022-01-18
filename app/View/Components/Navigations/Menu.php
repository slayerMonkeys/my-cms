<?php

namespace App\View\Components\Navigations;

use Illuminate\View\Component;

class Menu extends Component
{
    public $icon;
    public $title;

    public function __construct(string $icon, string $title)
    {
        $this->title = $title;
        $this->icon = $icon;
    }

    public function render()
    {
        return view("components.admin.navigations.menu");
    }
}
