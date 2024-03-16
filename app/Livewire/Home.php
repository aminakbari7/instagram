<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Home extends Component
{

    use WithPagination;

    public $posts;

    public $canLoadMore;

    public $perPageIncrement = 5;

    public $perPage = 10;



    #!!!import use Livewire\Attributes\On;
    #[On('closeModal')]
    public function revertUrl()
    {

        $this->js("history.replaceState({}, '', '/')");
    }


    #!!!import use Livewire\Attributes\On;
    #[On('post-created')]
    function postCreated($id)
    {

        $post = Post::find($id);
        $this->posts =  $this->posts->prepend($post);
    }


    /*
     * --------------------------
     * Load more posts
     *---------------------------*/

    public function loadMore()
    {
        if (!$this->canLoadMore) {
            return null;
        }
        #increment page
        $this->perPage += $this->perPageIncrement;

        #load posts
        $this->loadPosts();
    }


    #function to laod posts
    function loadPosts()
    {
        $this->posts = Post::with('comments.replies')->latest()
            ->take($this->perPage)->get();
        $this->canLoadMore = (count($this->posts) >= $this->perPage);
    }

    function toggleFollow(User $user)  {

        abort_unless(auth()->check(),401);
        auth()->user()->toggleFollow($user);

    }


    function mount()
    {
        $this->loadPosts();
    }

    public function render()
    {

       $suggestedUsers=  User::limit(6)->get()->where('id','!=',auth()->user()->id);
        return view('livewire.home',['suggestedUsers'=>$suggestedUsers]);
    }
}
