<?php

namespace App\Livewire\Post;
use Illuminate\Support\Facades\Auth;

use App\Models\Media;
use App\Models\Post;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;


class Create extends ModalComponent
{

    use WithFileUploads;

    public $media=[];
    public $description;
    public $location;
    public $hide_like_view=false;
    public $allow_commenting=false;

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '4xl';
    }


    function submit() {
        #validate

        $this->validate( rules: [
            'media.*'=>'required|file|mimes:png,webp,jpg,mp4,jpeg,mov|max:100000',
            'allow_commenting'=>'boolean',
            'hide_like_view'=>'boolean',
        ]);

        #determine if reel or post

        $type=$this->getPostType($this->media);

        #create post

        $post = Post::create([
            
            'user_id' => Auth::id(), // Instead of auth()->user()->id
            'description'=>$this->description,
            'location'=>$this->location,
            'allow_commenting'=>$this->allow_commenting,
            'hide_like_view'=>$this->hide_like_view,
            'type'=>$type
        ]);

        #add media 

        foreach ($this->media as $key => $media){
            #get mime type

            $mime = $this->getMime($media);

            #save to storage

            $path = $media->store('media', 'public');

            $url=url(path: Storage::url(path: $path));


            #Create media

            Media::create([

                'url'=>$url,
                'mime'=>$mime,
                'mediable_id'=>$post->id,
                'mediable_type'=>Post::class
            ]);

            $this->reset();
            $this->dispatch( event: 'close');

            
            #dispatch event for post created
            $this->dispatch('post-created', $post->id);
        }

    }


    function getMime($media) : string {

        if (str()->contains($media->getMimeType(), 'video')) {
            return 'video';
        } else {
            return 'image';
        }
    }


    function getPostType($media) :string {

        if (count($media)===1 && str()->contains($media[0]->getMimeType(), 'video')) {
            
            return "reel";
        }else {
            return "post";
        }
    }
    

    public function render()
    {
        return view(view: 'livewire.post.create');
    }
}
