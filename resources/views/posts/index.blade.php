<x-layout>
    <x-slot:content>

        @include('posts._header');

        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

            @if ($posts->count() > 0)
                <x-post-featured-card :post="$posts->first()"/>

                @if ($posts->count() > 1)
                    <div class="lg:grid lg:grid-cols-6">
                        @foreach ($posts->skip(1) as $post)
                            <x-post-card
                                :post="$post"
                                class="col-span-{{ ($loop->iteration == 1 || $loop->iteration == 2) ? 3 : 2 }}"/>
                        @endforeach
                    </div>
                @endif
                {{$posts->links()}}
            @else
                <p class="text-center"> There are no posts that match your criteria.</p>
            @endif

        </main>
    </x-slot:content>
</x-layout>
