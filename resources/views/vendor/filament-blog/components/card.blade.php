@props(['post'])
<a href="{{ route('filamentblog.post.show', ['post' => $post->slug]) }}">
    <div class="group/blog-item flex flex-col gap-y-5">
        <div class="h-[250px] w-full rounded-xl bg-zinc-300 overflow-hidden">
            <img class="flex h-full w-full items-center justify-center object-cover object-top"
                 src="{{ asset($post->featurePhoto) }}" alt="{{ $post->photo_alt_text }}">
        </div>
        <div class="flex flex-col justify-between space-y-3 px-2">
            <h2 title="{{ $post->title }}"
                class="group-hover/blog-item:text-primary-700 mb-3 line-clamp-2 text-xl font-semibold hover:text-blue-600">
                {{ $post->title }}
            </h2>
            <p class="mb-3 line-clamp-3">
                {{ Str::limit($post->sub_title, 100) }}
            </p>
            <article class="leading-6 text-left">
                {!! tiptap_converter()->asHTML(Str::limit($post->body, 100), toc: true, maxDepth: 3) !!}
            </article>
            <div class="flex items-center gap-4">
                <img class="h-14 w-14 overflow-hidden rounded-full border-4 border-white bg-zinc-300 object-cover text-[0] ring-1 ring-slate-300" src="{{ asset($post->user->avatar_url) }}" alt="{{ $post->user->name() }}">

                <div>
                    <span title="{{ $post->user->name() }}"
                          class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap text-sm font-semibold">{{ $post->user->name() }}</span>
                    <span class="block whitespace-nowrap text-sm font-semibold text-zinc-600">
                        {{ $post->formattedPublishedDate() }}</span>
                </div>
            </div>
        </div>
    </div>
</a>