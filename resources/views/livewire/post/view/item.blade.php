<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@4.6.1/dist/index.min.js"></script>

<div class="grid lg:grid-cols-12 gap-3 h-full w-full overflow-hidden">

    <!-- Left Section: Media Display -->
    <aside class="hidden lg:flex lg:col-span-7 m-auto items-center w-full overflow-hidden">
        <div class="relative flex overflow-x-auto snap-x snap-mandatory gap-2 px-2 w-[500px]">
            @foreach($post->media as $key => $file)
            <div class="w-full h-full shrink-0 snap-center">
                @switch($file->mime)
                @case('video')
                <x-video source="{{ $file->url }}" />
                @break
                @case('image')
                <img src="{{ $file->url }}" alt="Post image" class="h-full w-full block object-cover">
                @break
                @default
                @endswitch
            </div>
            @endforeach
        </div>
    </aside>

    <!-- Right Section: Post Details -->
    <aside class="lg:col-span-5 h-full flex flex-col gap-4 overflow-y-auto scrollbar-hide">

        <header class="flex items-center gap-3 border-b py-2 sticky top-0 bg-white z-10">
            <x-avatar story src="https://randomuser.me/api/portraits/men/{{ rand(1, 10) }}.jpg" class="h-12 w-12" />
            <div class="grid grid-cols-7 w-full gap-2">
                <div class="col-span-5">
                    <h5 class="font-semibold truncate text-sm">{{$post->user->name}}</h5>
                </div>

                <div class="flex col-span-2 text-right justify-end">
                    <button wire:click="$dispatch('closeModal')" class="text-gray-500 ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <main>
            @if($comments)

            @foreach($comments as $comment)
            <section class="flex flex-col gap-2">

                {{----main comment-----}}
                <div class="flex items-center gap-3 py-2">
                    <x-avatar story src="https://randomuser.me/api/portraits/men/{{ rand(1, 10) }}.jpg" class="h-12 w-12 mb-auto" />
                    <div class="grid grid-cols-7 w-full gap-2">
                        <div class="col-span-6 flex flex-wrap text-sm">
                            <p>
                                <span class="font-bold text-sm"> {{$comment->user->name}} </span>
                                {{$comment->body}}
                            </p>
                        </div>

                        <div class="col-span-1 flex text-right justify-end mb-auto">
                            <button class="font-bold text-sm ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </button>
                        </div>

                        <div class="col-span-7 flex gap-2 text-sm items-center text-gray-700">
                            <span>{{$comment->created_at->diffForHumans()}}</span>
                            <span class="font-bold">345 Likes</span>
                            <span class="font-bold">Reply</span>
                        </div>
                    </div>
                </div>

                {{----reply-------}}
                <div class="flex items-center gap-3 w-11/12 ml-auto py-2">
                    <x-avatar story src="https://randomuser.me/api/portraits/men/{{ rand(1, 10) }}.jpg" class="h-10 w-10 mb-auto" />
                    <div class="grid grid-cols-7 w-full gap-2">
                        <div class="col-span-6 flex flex-wrap text-sm">
                            <p>
                                <span class="font-bold text-sm"> {{$post->user->name}} </span>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore, similique eligendi? Aspernatur repellat nesciunt qui!
                            </p>
                        </div>

                        <div class="col-span-1 flex text-right justify-end mb-auto">
                            <button class="font-bold text-sm ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </button>
                        </div>

                        <div class="col-span-7 flex gap-2 text-sm items-center text-gray-700">
                            <span> 2d</span>
                            <span class="font-bold">345 Likes</span>
                            <span class="font-bold">Reply</span>
                        </div>
                    </div>
                </div>

            </section>
            @endforeach

            @else
                <p>No comments available for this post</p>
            @endif
        </main>

        <footer class="mt-auto sticky border-t bottom-0 z-10 bg-white">
            <div class="flex gap-4 items-center my-2">
                <!-- icons here -->
            </div>
            
            <p class="font-bold text-sm">104,474 likes</p>

            <div class="flex text-sm gap-2 font-medium">
                <p> <strong class="font-bold">{{ $post->user->name }}</strong>
                    {{ $post->description }}
                </p>
            </div>

            <button onclick="Livewire.dispatch('openModal', { component: 'post.view.modal', arguments: [{{$post->id}}] })" class="btn bg-gray-500 text-white mt-4">
                View all {{ $comments->count() }} comments
            </button>

            <div class="border-t-2 mt-2"></div>

            <div class="flex gap-2 items-center mt-3 text-lg text-gray-800 justify-between">
                <textarea id="comment" placeholder="Add a comment" class="h-12 p-2 outline-none resize-none w-full border-none" x-model="inputText"></textarea>

                <button x-show="inputText.length > 0" x-cloak type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md">Post</button>

                <button @click="emojiPicker.showPicker()" class="text-xl">
                    <span>😀</span>
                </button>
            </div>
        </footer>
    </aside>
</div>

<script>
    let picker = new EmojiButton();
    document.querySelector("button").addEventListener("click", () => {
        picker.togglePicker(document.querySelector("button"));
    });

    picker.on('emoji', emoji => {
        document.getElementById('comment').value += emoji;
    });
</script>
