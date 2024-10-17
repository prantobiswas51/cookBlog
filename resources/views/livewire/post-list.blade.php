<div class=" px-3 lg:px-7 py-6">

    <div class="flex justify-between items-center  ">
        <div id="filter-selector" class="flex items-center space-x-4 font-light ">
            <button class="text-gray-900 dark:text-gray-200 py-4">Latest</button>
            <button class="text-gray-900 py-4 border-b border-gray-200 dark:text-gray-50">Oldest</button>
        </div>
    </div>

    <div class="py-4">
        @foreach ($this->$posts as $post)
            <x-posts.post-item :post="$post"/>
        @endforeach
    </div>

    <div class="my-3">
        {{ $this->posts->links() }}
    </div>

</div>
