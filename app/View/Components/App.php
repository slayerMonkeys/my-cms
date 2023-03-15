<?php

namespace App\View\Components;

use Illuminate\View\Component;

class App extends Component
{
    /**
     * @var string
     */
    public $title;

    /**
     * @param string $title
     */
    public function __construct(string $title = 'Laravel')
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('components.app');
    }
}
