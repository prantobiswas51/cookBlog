<div class=" px-3 lg:px-7 py-6">

    <div class="flex justify-between items-center  ">
        <div class="text-gray-500">

            @if ($search)
                Results for <span class="text-gray-100">{{$search}}</span>
            @endif

            @if ($this->activeCategory)
                Results for <span class="text-gray-100">
                    <x-badge
                        :textColor="$this->activeCategory->text_color"
                        :bgColor="$this->activeCategory->bg_color"> {{ $this->activeCategory->title }} </x-badge>
                </span>
            @endif

            @if ($this->activeCategory || $search)
                <button wire:click='clearFilters()' class="text-gray-300 border rounded-full px-2 py-1"> Clear Filter X </button>
            @endif

        </div>
        <div id="filter-selector" class="flex items-center space-x-4 font-light ">
            <button wire:click="setSort('desc')" class="{{ $sort === 'desc' ? 'text-gray-900 dark:text-gray-200 border-b' : 'text-gray-500 ' }}  py-4">Latest</button>
            <button wire:click="setSort('asc')" class="{{ $sort === 'asc' ? 'text-gray-900 dark:text-gray-200 border-b' : 'text-gray-500 ' }} py-4">Oldest</button>
        </div>
    </div>

    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-posts.post-item :post="$post"/>
        @endforeach
    </div>

    <div class="my-3">
        {{ $this->posts->links() }}
    </div>

</div>
