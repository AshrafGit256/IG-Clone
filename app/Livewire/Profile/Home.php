<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $user;

    function mount ($user) {
        $this->user = User::whereUsername($user)->withCount(['followers','followings','posts'])->firstOrFail();

    }
    public function render(){
        $this->user = User::whereUsername($this->user->username)->withCount(['followers','followings','posts'])->firstOrFail();
        return view('livewire.profile.home');
    }
}
