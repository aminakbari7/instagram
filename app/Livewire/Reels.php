<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\On;



class Reels extends Component
{

    #[On('closeModal')]
    public function revertUrl()
    {
        $this->js("history.replaceState({}, '', '/explore')");
    }
    function toggleFavorite(Post $post)  {

        abort_unless(auth()->check(),401);
        auth()->user()->toggleFavorite($post);

    }
    function togglePostLike(Post $post) {

        abort_unless(auth()->check(),401);
        auth()->user()->toggleLike($post);


    }
    public function render()
    {
        $posts= Post::limit(20)->where('type','reel')->get();
        return view('livewire.reels',['posts'=>$posts]);
    }
}
