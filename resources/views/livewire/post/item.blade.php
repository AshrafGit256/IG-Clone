<div class="max-w-lg mx-auto">
    <!-- Header -->
    <header class="flex items-center gap-3">
        <x-avatar src="https://randomuser.me/api/portraits/men/{{ rand(1, 99) }}.jpg" class="h-14 w-14" />
        <div class="grid grid-cols-7 w-full gap-2">
            <div class="col-span-5">
                <h5 class="font-semibold truncate text-sm">{{ $post->user->name }}</h5>
            </div>
            <div class="col-span-2 flex justify-end">
                <button class="text-gray-500 ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="my-2">
            <!-- Swiper container -->
            <div class="swiper h-[500px] border bg-white" x-init="
                new Swiper($el, {
                    modules: [Navigation, Pagination],
                    loop: true,
                    pagination: { el: '.swiper-pagination', clickable: true },
                    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                });
            ">

                <ul x-cloak class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($post->media as $file)
                    <li class="swiper-slide">
                        @switch($file->mime)

                        @case('video')
                        <x-video source="{{$file->url}}" />
                        @break

                        @case('image')
                        <img src="{{$file->url}}" alt="" class="h-[500px] w-full object-scale-down" />
                        @break


                        @endswitch
                    </li>
                    @endforeach

                </ul>
                <!-- Pagination and Navigation -->
                <div class="swiper-pagination"></div>


                @if(count($post->media)>1)

                {{---Prev----}}
                <div class="swiper-button-prev absolute top-1/2 z-10 p-2">
                    <div class="bg-white/95 border p-1 rounded-full text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.8" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </div>
                </div>

                {{---Next----}}
                <div class="swiper-button-next absolute right-0 top-1/2 z-10 p-2">
                    <div class="bg-white/95 border p-1 rounded-full text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.8" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>

                @endif

            </div>
        </div>
    </main>

    {{-- footer --}}
    <footer>
        {{---- Actions -----}}
        <div class="flex gap-4 items-center my-2">

            {{--- heart ---}}
            @if ($post->isLikedBy(auth()->user()))

            <button wire:click='togglePostLike()'>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-rose-500">
                    <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                </svg>
            </button>

            @else

            <button wire:click='togglePostLike()'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>

            @endif


            @if ($post->allow_commenting)

            {{----comment-----}}
            <button onclick="Livewire.dispatch('openModal', { component: 'post.view.modal', arguments: { postId: {{ $post->id }} } })">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                </svg>
            </button>

            @endif

            {{--- forward ---}}
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send w-5 h-5" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z" />
                </svg>
            </span>

            {{--- Bookmark/favourites ---}}
            <span class="ml-auto">

                @if ($post -> hasBeenFavoritedBy(auth()->user()))

                <button wire:click="toggleFavorite()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                    </svg>
                </button>

                @else

                <button wire:click="toggleFavorite()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>
                </button>
                @endif

            </span>

        </div>

        {{---likes and views----}}
        @if ($post->totalLikers>0 && !$post->hide_like_view)
        <p class="font-bold text-sm">{{$post->totalLikers}} {{$post->totalLikers>1? 'likes':'like'}}</p>
        @endif

        {{---name and comment----}}
        <div class="flex text-sm gap-2 font-medium">
            <p> <strong class="font-bold">{{ $post->user->name }}</strong>
                {{ $post->description }}
            </p>
        </div>

        @if ($post->allow_commenting)

        {{---view post modal----}}
        <button onclick="Livewire.dispatch('openModal', { component: 'post.view.modal', arguments: { postId: {{ $post->id }} } })" class="text-state-500/90 text-sm font-medium">
            View all {{$post->comments->count()}} comments
        </button>

        @auth
        {{---- show comments from auth------}}
        <ul class="my-2">
            @foreach($post->comments()->where('user_id',auth()->id())->get() as $comment)
            <li class="grid grid-cols-12 text-sm items-center">
                <span class="font-bold col-span-3 mb-auto">{{auth()->user()->name}}</span>
                <span class="col-span-8">{{$comment->body}}</span>
                <button class="col-span-1 mb-auto flex justify-end pr-px">
                    {{---- heart -----}}
                    @if ($comment->isLikedBy(auth()->user()))

                    <span wire:click='toggleCommentLike({{$comment->id}})'>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-rose-500">
                            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                        </svg>
                    </span>

                    @else

                    <span wire:click='toggleCommentLike({{$comment->id}})'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </span>

                    @endif
                </button>
            </li>
            @endforeach
        </ul>
        @endauth

        {{----leave a comment-----}}
        <form
            wire:key='{{time()}}'
            @submit.prevent="$wire.addComment()"
            x-data="{body:@entangle('body')}" class="grid grid-cols-12 item-center w-full">
            @csrf

            <input x-model="body" type="text" placeholder="Leave a comment" class="border-0 col-span-10 placeholder:text-sm outline-none focus:outline-none px-0 rounded-lg hover:ring-0 focus:ring-0">

            <div class="col-span-1 ml-auto flex justify-end text-right">
                <button type="submit" x-cloak x-show="body.length>0" class="text-sm font-semibold flex justify-end text-blue-500">
                    Post
                </button>
            </div>

            <div class="col-span-1 flex justify-center items-right ml-auto">
                <button type="button" @click="showEmojiPicker = !showEmojiPicker" class="text-gray-500 text-lg">
                    😀
                </button>
            </div>



            <span class="col-span-1 ml-auto">

            </span>
        </form>

        @endif

    </footer>
</div>