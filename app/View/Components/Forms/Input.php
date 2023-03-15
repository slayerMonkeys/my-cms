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
    public string $id;

    /**
     * @var string
     */
    public string $label;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var string
     */
    public string $placeholder;

    /**
     * @var integer
     */
    public int $cols;

    /**
     * @var integer
     */
    public int $rows;

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
    public function render(): View|Factory|Htmlable|Application
    {
        return view('components.admin.forms.input');
    }
}
