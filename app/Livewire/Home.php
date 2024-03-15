<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class Home extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::latest()->get();

    }
    public function render()
    {
        return view('livewire.home');
    }
}
