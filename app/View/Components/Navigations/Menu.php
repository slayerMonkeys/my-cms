<?php

namespace App\View\Components\Navigations;

use Illuminate\View\Component;

class Menu extends Component
{
    public string $icon;
    public string $title;
    public bool $isActive;

    public function __construct(string $icon, string $title, bool $isActive = false)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->isActive = $isActive;
    }

    public function render()
    {
        return view("components.admin.navigations.menu");
    }
}
