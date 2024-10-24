<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;

use function Laravel\Prompts\search;

class SearchBox extends Component
{
    #[Url()]
    public $search = '';

    public function updateSearch()
    {
        $this->dispatch('search', search: $this->search);
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
