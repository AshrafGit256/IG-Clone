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
        <main class="bg-white h-[calc(100vh_-_3.5rem)] md:h-[calc(100vh_-_5rem)] flex flex-col border gap-y-4 px-5">
            {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

            <header class="w-full py-2">
                <div class="flex justify-end">
                    <!-- Close modal with wire directive -->
                    <button wire:click="$dispatch('closeModal')" type="button" class="xl font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </header>

            <livewire:post.view.item :post="$this->post" />
            
        </main>
        BLADE;
    }
}
