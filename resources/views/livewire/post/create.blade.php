<div class="bg-white lg:h-[500px] flex flex-col border gap-y-4 px-5">

    {{-- Header --}}
    <header class="w-full py-2 border-b">
        <div class="flex justify-between">

            <button wire:click="$dispatch('closeModal')" class="font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-lg font-bold">
                Create new post
            </div>

            <button @disabled(count($media)==0) wire:loading.attr='disable' wire:click='submit' class="flex items-center text-blue-500 font-bold">
                Share
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                </svg>
            </button>

        </div>

    </header>

    {{---main----}}
    <main class="grid grid-cols-12 gap-3 h-full w-full overflow-hidden">

        {{--media--}}
        <aside class="lg:col-span-7 m-auto items-center w-full overflow-scroll-hidden">

            @if (count($media)==0)
            {{--trigger button---}}
            <label for="customFileInput" class="{{--hidden---}} m-auto max-w-fit flex-col flex gap-3 cursor-pointer">

                <input wire:model.live='media' type="file" multiple accept=".jpg,.webp,.png,.jpeg" id="customFileInput" type="text" class="sr-only">

                <span class="m-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="size-24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </span>

                <span class="bg-blue-500 text-white text-sm rounded-lg p-2 px-4">
                    Upload files from the computer
                </span>

            </label>

            @else
            {{---Show when file count is > 0----}}
            <div class="flex overflow-x-scroll w-[500px] h-96 snap-x snap-mandatory gap-2 px-2">


                @foreach ($media as $key=> $file)
                <div class="w-full h-full shrink-0 snap-always snap-center">

                    @if (strpos($file->getMimeType(), 'image')!==false)
                    <img src="{{$file->temporaryUrl()}}" alt="" class="w-full h-full object-contain">

                    @elseif (strpos($file->getMimeType(), 'video')!==false)
                    <x-video :source="$file->temporaryUrl()" />
                    @endif

                </div>
                @endforeach


            </div>
            @endif

        </aside>

        {{--details--}}
        <aside class="lg:col-span-5 h-full border-l p-3 flex gap-4 flex-col overflow-hidden overflow-y-scroll-hidden">

            {{--Author---}}
            <div class="flex items-center gap-2">
                <x-avatar class="w-9 h-9" />
                <h5 class="font-bold">{{fake()->name('male')}}</h5>
            </div>

            {{--Description---}}
            <div>
                <textarea wire:model="description" placeholder="Add a Caption" class="border-0 focus:border-0 px-0 w-full rounded-lg bg-white h-32 focus:outline-none focus:ring-0"
                    name="" id="" cols="30" rows="10"></textarea>
            </div>

            {{--location---}}
            <div class="w-full items-center">
                <input wire:model="location" type="text" placeholder="Add a Location"
                    class="border-0 focus:border-0 px-0 w-full rounded-lg bg-white focus:outline-none focus:ring-0">
            </div>
            

            {{--Advanced Settings---}}
            <div class="">
                <h6 class="text-gray-500 font-medium text-base">Advanced Settings</h6>

                <ul>
                    <li>
                        <div class="flex items-center gap-3 justify-between">

                            <span>Hide like and view counts on this post</span>

                            <label class="inline-flex items-center mb-5 cursor-pointer">
                                <input wire:model="hide_like_view" type="checkbox" value="" class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>

                        </div>
                    </li>

                    <li>
                        <div class="flex items-center gap-3 justify-between">

                            <span>Turn off commenting</span>

                            <label class="inline-flex items-center mb-5 cursor-pointer">
                                <input wire:model="allow_commenting" type="checkbox" value="" class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>

                        </div>
                    </li>
                </ul>
            </div>

        </aside>

    </main>

</div>