<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BaseLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        if (theme()->getOption('layout', 'base') === 'docs') {
            return view('demo2.layout.docs.master');
        }

        return theme()->getView('demo2.layout.demo2.master');
    }
}
