<section class="nala-section nala-about" id="artikel">
    <div class="container">
        <div class="nala-section__header text-center mx-auto">
            <p class="nala-eyebrow nala-eyebrow--dark">Artikel</p>
            <h2 class="nala-section__title">Cerita, edukasi, dan kabar dari Nala Coffee.</h2>
        </div>
        <div class="row g-4 mt-3">
            @forelse ($articles as $article)
                <div class="col-md-4"><article class="nala-about__point h-100">
                    @if ($article->thumbnail)
                        <img class="nala-gallery__image mb-3" src="{{ str_starts_with($article->thumbnail, 'cms/') ? asset('storage/'.$article->thumbnail) : asset($article->thumbnail) }}" alt="{{ $article->title }}">
                    @endif
                    <p class="nala-eyebrow nala-eyebrow--dark">{{ $article->category }}</p>
                    <h3 class="h5">{{ $article->title }}</h3>
                    <p>{{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
                </article></div>
            @empty
                <p class="text-center text-muted">Belum ada artikel.</p>
            @endforelse
        </div>
    </div>
</section>
