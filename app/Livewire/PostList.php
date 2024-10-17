<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    public $search = "";

    use WithPagination;

    #[Computed()]
    public function posts()
    {
        return Post::published()->orderBy('published_at', 'desc')->paginate(5);
    }

    public function render()
    {
        return view('livewire.post-list');
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }
}
