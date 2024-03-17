<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public $query;
    public $results;

    public $drawer=false;
    public $shrink=false;



    function updatedQuery($query)
    {

        //return null if query is empty
        if ($query == '') {
            return  $this->results = null;
        }

        $this->results = User::where('username', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')
            ->get();
    }

    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
