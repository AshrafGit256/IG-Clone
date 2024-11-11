<div class="max-w-lg mx-auto">
    {{-- Header --}}

    <header class="flex items-center gap-3">
        <x-avatar  src="https://randomuser.me/api/portraits/men/{{ rand(1, 99) }}.jpg" class="h-14 w-14"/>

        <div class="grid grid-cols-7 w-full gap-2">
            <div class="col-span-5">
                <h5 class="font-semibold truncate text-sm">{{fake()->name('male')}}</h5>
            </div>

            <div class="col-span-2 flex text-right justify-end">
                <button class="text-gray-500 ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    {{-- main --}}
    <main>
        <div class="my-2">
            <x-video />
        </div>
    </main>

    {{-- footer --}}
    <footer>
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
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
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
            <p> <strong class="font-bold">{{fake()->name('male')}}</strong>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores maiores odit similique repellat, officia recusandae, rerum illo, alias nostrum obcaecati laboriosam dolorem praesentium? Distinctio officia praesentium quas dolor iure vero!
            </p>
        </div>

        {{---view post modal----}}
        <button  class="text-state-500/90 text-sm font-medium">
            View all 456 comments
        </button>

        {{----leave a comment-----}}
        <form x-data="{inputText:''}" class="grid grid-cols-12 item-center w-full">
            @csrf

            <input x-model="inputText" type="text" placeholder="Leave a comment" class="border-0 col-span-10 placeholder:text-sm outline-none focus:outline-none px-0 rounded-lg hover:ring-0 focus:ring-0">
            <div class="col-span-1 ml-auto flex justify-end text-right">
                <button x-cloak x-show="inputText.length>0" class="text-sm font-semibold flex justify-end text-blue-500">
                    Post
                </button>
            </div>

            <span class="col-span-1 ml-auto">

            </span>
        </form>

    </footer>
</div>