<div class="grid grid-cols-12 gap-3 h-full w-full overflow-hidden">

    <!-- Left Section: Media Display -->
    <aside class="lg:col-span-7 m-auto items-center w-full overflow-hidden">
        <!-- CSS Snap Scroll -->
        <div class="relative flex overflow-x-auto snap-x snap-mandatory gap-2 px-2 w-[500px] h-96">
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
        <!-- Add your content here for comments, details, or post information -->
    </aside>
</div>
