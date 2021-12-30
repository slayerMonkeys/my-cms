<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Contracts\Support\Htmlable;

class Input extends Component
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $placeholder;

    /**
     * @var integer
     */
    public $cols;

    /**
     * @var integer
     */
    public $rows;

    /**
     * @param string $id
     * @param string $label
     * @param string $type
     * @param int $cols
     * @param int $rows
     * @param string|null $placeholder
     */
    public function __construct(string $id, string $label, string $type, int $cols = 0, int $rows = 0, string $placeholder = null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->cols = $cols;
        $this->rows = $rows;
    }

    /**
     * @return Application|Htmlable|Factory|View
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
