<?php

namespace App\Livewire\Profile;

use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Notifications\NewFollowerNotification;
class Home extends Component
{

    public $user;

       #!!!import use Livewire\Attributes\On;
       #[On('closeModal')]
       public function revertUrl()
       {

           $this->js("history.replaceState({}, '', '/')");
       }


    function toggleFollow()  {
        abort_unless(auth()->check(),401);
        auth()->user()->toggleFollow($this->user);
        if (auth()->user()->isFollowing($this->user)) {

            $this->user->notify(new NewFollowerNotification(auth()->user()));

        }
    }


    function mount($user)  {
        $this->user= User::whereUsername($user)->withCount(['followers','followings','posts'])->firstOrFail();
    }

    public function render()
    {

        #add this in order to update the withCount() variables on hydrate
        $this->user= User::whereUsername($this->user->username)->withCount(['followers','followings','posts'])->firstOrFail();

        $posts= $this->user->posts()->whereType('post')->get();
        return view('livewire.profile.home',['posts'=>$posts]);
    }
}
