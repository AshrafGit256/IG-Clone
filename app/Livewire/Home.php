<?php

namespace App\Livewire;

use App\Models\Post;
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



    function mount()
    {
        // $this->posts = Post::latest()->get();
        $this->loadPosts();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
