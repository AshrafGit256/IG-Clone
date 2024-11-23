<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{
    public $posts;

    public $canLoadMore;
    public $perPageIncrements = 5;
    public $perPage = 10;

    #[On('closeModal')]
    function revertUrl()
    {
        $this->js("history.replaceState({},'','/')");
    }


    #[On('post-created')]
    function postCreated($id)
    {
        $post = Post::find($id);

        $this->posts = $this->posts->prepend($post);
    }

    function loadMore()
    {
        if (!$this->canLoadMore) {
            return null;
        }

        #increment page
        $this->perPage += $this->perPageIncrements;

        #load posts
        $this->loadPosts();
    }


    #function to load posts
    function loadPosts()
    {
        $this->posts = Post::with('comments.replies')
            ->latest()
            ->take($this->perPage)
            ->get();

        $this->canLoadMore = ($this->posts->count() == $this->perPage);
    }


    function toggleFollow(User $user) {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleFollow($user);
    }



    function mount()
    {
        // $this->posts = Post::latest()->get();
        $this->loadPosts();
    }

    public function render()
    {
        $suggestedUsers = User::limit(5)->get();
        return view('livewire.home', ['suggestedUsers'=>$suggestedUsers]);
    }
}
