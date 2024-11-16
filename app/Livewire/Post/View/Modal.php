<?php

namespace App\Livewire\Post\View;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $post;

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    // Accept the post ID as a parameter to avoid confusion with the model instance
    public function mount($postId)
    {
        // Fetch the post instance by ID
        $this->post = Post::findOrFail($postId);

        // Get URL based on the post ID
        $url = url('post/' . $this->post->id);

        // Push state with corrected syntax
        $this->js("history.pushState({}, '', '{$url}')");
    }
    

    public function render()
    {
        return <<<'BLADE'
        <main class="bg-white h-[calc(100vh_-_3.5rem)] md:h-[calc(100vh_-_5rem)] p-2 flex flex-col border gap-y-4 px-5">
            

            <livewire:post.view.item :post="$this->post" />
            
        </main>
        BLADE;
    }
}
