<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
class Item extends Component
{
    public $post;

    public function render()
    {
        return view('livewire.post.item');
    }
}
