@props(['post'])

<article class=" border-gray-100 pb-10">
    <div class="article-body border p-2 rounded-md  grid grid-cols-12 gap-3 mt-5 items-start">
        <div class="article-thumbnail col-span-4 flex items-center">
            <a href="{{ route('posts.show', $post->slug) }}">
                <img class="mw-100 mx-auto rounded-xl" src="{{ $post->getThumbnailUrl() }}" alt="thumbnail">
            </a>
        </div>

        <div class="col-span-8">
            <div class="article-meta flex py-1 text-sm items-center">
                <img class="w-7 h-7 rounded-full mr-3" src="{{$post->author->profile_photo_url}}" alt="avatar">
                <span class="mr-1 text-xs dark:text-gray-400">{{ $post->author->name }}  </span>
                <span class=" text-xs dark:text-gray-400">{{ $post->published_at->diffForHumans() }}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                <a href="{{ route('posts.show', $post->slug) }}">
                    {{$post->title}}
                </a>
            </h2>

            <p class="mt-2 text-base text-gray-700 font-light">
                {{$post->getExcerpt()}}
            </p>
            <div class="article-actions-bar mt-6 flex items-center justify-between">

                <div class="">
                    @foreach ($post->categories as $category)
                        <x-badge :textColor="$category->text_color" :bgColor="$category->bg_color"> {{$category->title}} </x-badge>
                    @endforeach
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-gray-500 text-sm">{{$post->readTime()}} Min(s) Read</span>
                </div>

                <div>
                    <livewire:like-button :key="$post->id" :$post />
                </div>
            </div>
        </div>
    </div>

</article>
