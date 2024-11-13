<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@4.6.1/dist/index.min.js"></script>

<div class="grid grid-cols-12 gap-3 h-full w-full overflow-hidden">

    <!-- Left Section: Media Display -->
    <aside class="lg:col-span-7 m-auto items-center w-full overflow-hidden">
        <!-- CSS Snap Scroll -->
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
            <div class="h-96 bg-blue-500"></div>
            <div class="h-96 bg-red-500"></div>
            <div class="h-96 bg-green-500"></div>
        </main>

        {{-- footer --}}
        <footer class="mt-auto sticky border-t bottom-0 z-10 bg-white">
            <div class="flex gap-4 items-center my-2">

                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </span>

                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                    </svg>
                </span>

                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send w-5 h-5" viewBox="0 0 16 16">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z" />
                    </svg>
                </span>

                <span class="ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>
                </span>

            </div>

            {{---likes and views----}}
            <p class="font-bold text-sm">104,474 likes</p>

            {{---name and comment----}}
            <div class="flex text-sm gap-2 font-medium">
                <p> <strong class="font-bold">{{ $post->user->name }}</strong>
                    {{ $post->description }}
                </p>
            </div>

            {{---view post modal----}}
            <button onclick="Livewire.dispatch('openModal', { component: 'post.view.modal', arguments: { postId: {{ $post->id }} } })" class="text-state-500/90 text-sm font-medium">
                View all 456 comments
            </button>

            {{----leave a comment-----}}
            <form x-data="{inputText:''}" class="grid grid-cols-12 item-center w-full">
                @csrf

                <input x-model="inputText" type="text" placeholder="Leave a comment" class="border-0 col-span-10 placeholder:text-sm outline-none focus:outline-none px-0 rounded-lg hover:ring-0 focus:ring-0">
                
                <div class="col-span-1 flex justify-center items-right ml-auto">
                    <button type="button" @click="showEmojiPicker = !showEmojiPicker" class="text-gray-500 text-lg">
                        😀
                    </button>
                </div>
                
                <div class="col-span-1 ml-auto flex justify-end text-right">
                    <button x-cloak x-show="inputText.length>0" class="text-sm font-semibold flex justify-end text-blue-500">
                        Post
                    </button>
                </div>

                <span class="col-span-1 ml-auto">

                </span>
            </form>

        </footer>
    </aside>
</div>
