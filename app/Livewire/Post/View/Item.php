<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Item extends Component
{
    public Post $post;

    public function render()
    {
        // Get the comments associated with the post
        $comments = $this->post->comments;

        // Return the view with comments passed to it
        return view('livewire.post.view.item', ['comments' => $comments]);
    }
}
