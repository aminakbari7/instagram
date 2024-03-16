<?php

namespace App\Livewire\Post;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Item extends Component
{

    public Post $post;


    public $body;


    function togglePostLike()  {

        abort_unless(auth()->check(),401);
        auth()->user()->toggleLike($this->post);


    }

    function toggleCommentLike(Comment $comment)  {

        abort_unless(auth()->check(),401);
        auth()->user()->toggleLike($comment);


    }

    function addComment()  {

        $this->validate(['body'=>'required']);

        #create comment
        Comment::create([
            'body'=>$this->body,
            'commentable_id'=>$this->post->id,
            'commentable_type'=>Post::class,
            'user_id'=>auth()->id()

        ]);

        $this->reset( ['body']);


    }


    public function render()
    {
       // dd($this->post);
        return view('livewire.post.item');
    }
}
