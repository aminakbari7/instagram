<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Comment;
use App\Notifications\NewCommentNotification;
use App\Notifications\PostLikedNotification;
use App\Notifications\NewFollowerNotification;
class Notifications extends Component
{
    function toggleFollow(User $user)  {


        abort_unless(auth()->check(),401);
        auth()->user()->toggleFollow($user);

             #send notification if is following
             if (auth()->user()->isFollowing($user)) {
                $user->notify(new NewFollowerNotification(auth()->user()));
            }

    }

    public function render()
    {
        return view('livewire.notifications',['notifications'=>auth()->user()->notifications]);
    }
}
