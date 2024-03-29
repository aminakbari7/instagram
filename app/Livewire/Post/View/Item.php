<?php

namespace App\Livewire\Post\View;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Notifications\PostLikedNotification;
use App\Notifications\NewCommentNotification;
class Item extends Component
{


    public Post $post;

    public $body;
    public $parent_id=null;
    function toggleFavorite()  {

        abort_unless(auth()->check(),401);
        auth()->user()->toggleFavorite($this->post);

    }
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
        $comment= Comment::create([
            'body'=>$this->body,
            'parent_id'=>$this->parent_id,
            'commentable_id'=>$this->post->id,
            'commentable_type'=>Post::class,
            'user_id'=>auth()->id()

        ]);
 #Notifiy User
        #make sure post does not belong to auth
        if ($this->post->user_id != auth()->id()) {

            $this->post->user->notify(new NewCommentNotification(auth()->user(),$comment));

         }


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
