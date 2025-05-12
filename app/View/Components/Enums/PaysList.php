<?php

namespace App\View\Components\enums;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaysList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.enums.pays-list',[
            'pays' => \App\Models\Pays::all()
        ]);
    }
}
