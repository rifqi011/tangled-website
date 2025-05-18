<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchForm extends Component
{
    /**
     * The route for the search form action.
     *
     * @var string
     */
    public $route;

    /**
     * The current search term.
     *
     * @var string
     */
    public $searchTerm;

    /**
     * The placeholder text for the search input.
     *
     * @var string
     */
    public $placeholder;

    /**
     * Additional hidden inputs to include in the form.
     *
     * @var array
     */
    public $hiddenInputs;

    /**
     * Create a new component instance.
     *
     * @param string $route
     * @param string $searchTerm
     * @param string|null $placeholder
     * @param array $hiddenInputs
     * @return void
     */
    public function __construct(
        string $route,
        string $searchTerm = '',
        string $placeholder = 'Search...',
        array $hiddenInputs = []
    ) {
        $this->route = $route;
        $this->searchTerm = $searchTerm;
        $this->placeholder = $placeholder;
        $this->hiddenInputs = $hiddenInputs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.search-form');
    }
}
