<section class="nala-section nala-gallery" id="galeri" data-reveal>
    <div class="container">
        <div class="nala-section__header text-center mx-auto">
            <p class="nala-eyebrow nala-eyebrow--dark">Di Sekitar Nala</p>
            <h2 class="nala-section__title">Yang tumbuh<br><em>di sekitar kami.</em></h2>
        </div>

        <div class="row g-3 mt-3">
            @foreach ($galleryImages as $image)
                <div class="col-6 col-lg-4">
                    @php($imagePath = is_array($image) ? $image['image'] : $image->image)
                    <img src="{{ str_starts_with($imagePath, 'cms/') ? asset('storage/'.$imagePath) : asset($imagePath) }}" alt="{{ is_array($image) ? $image['title'] : ($image->title ?? 'Galeri Nala Coffee') }}" class="nala-gallery__image">
                </div>
            @endforeach
        </div>
    </div>
</section>
