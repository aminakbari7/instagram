<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class Explore extends Component
{
     #!!!import use Livewire\Attributes\On;
     #[On('closeModal')]
     public function revertUrl()
     {

         $this->js("history.replaceState({}, '', '/explore')");
     }


    public function render()
    {

        $posts= Post::limit(20)->get();
        return view('livewire.explore',['posts'=>$posts]);
    }
}
