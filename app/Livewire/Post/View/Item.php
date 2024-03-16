<?php

namespace App\Livewire\Post\View;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;

class Item extends Component
{


    public Post $post;

    public $body;
    public $parent_id=null;

    function togglePostLike()  {

        abort_unless(auth()->check(),401);
        auth()->user()->toggleLike($this->post);


    }
    function addComment()  {

        $this->validate(['body'=>'required']);

        #create comment
        Comment::create([
            'body'=>$this->body,
            'parent_id'=>$this->parent_id,
            'commentable_id'=>$this->post->id,
            'commentable_type'=>Post::class,
            'user_id'=>auth()->id()

        ]);

        $this->reset( ['body']);


    }

    function setParent(Comment $comment)  {

        $this->parent_id=$comment->id;
        $this->body="@".$comment->user->name;//we will use username in the future
    }

    public function render()
    {


        $comments = $this->post->comments()->whereDoesntHave('parent')->get();




        return view('livewire.post.view.item',['comments'=>$comments]);
    }
}
