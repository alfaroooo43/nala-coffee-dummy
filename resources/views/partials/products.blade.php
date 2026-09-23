<section class="nala-section nala-products" id="kopi" data-reveal>
    <div class="container">
        <div class="nala-section__header nala-section__header--split">
            <div><p class="nala-eyebrow nala-eyebrow--dark">Kopi Nala</p><h2 class="nala-section__title">Dari Ijen,<br><em>untuk harian.</em></h2></div>
            <p class="nala-section__text">Profil rasa yang jujur, dirawat dalam batch kecil. Pilih cerita yang ingin kamu bawa pulang.</p>
        </div>

        <div class="nala-product-list">
            @forelse ($products as $product)
                @php
                    $productImage = $product->image
                        ? (str_starts_with($product->image, 'cms/') ? asset('storage/'.$product->image) : asset($product->image))
                        : asset('images/products/house-blend.png');
                    $scores = [
                        ['label' => 'Body', 'value' => (int) ($product->body_score ?? 70)],
                        ['label' => 'Acidity', 'value' => (int) ($product->acidity_score ?? 55)],
                        ['label' => 'Fruity', 'value' => (int) ($product->fruity_score ?? 64)],
                    ];
                @endphp
                <article class="nala-product-card">
                    <div class="nala-product-card__image-wrap"><img src="{{ $productImage }}" alt="Foto {{ $product->name }}" class="nala-product-card__image"><span class="nala-product-card__index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div>
                    <div class="nala-product-card__body">
                        <p class="nala-product-card__category">{{ $product->category?->name ?? 'SPECIALTY COFFEE' }}</p>
                        <h3>{{ $product->name }}</h3>
                        <p class="nala-product-card__origin">IJEN JAVA, BONDOWOSO <span>·</span> 1.200–1.400 MDPL</p>
                        <p class="nala-product-card__description">{{ $product->description ?: 'Karakter kopi yang bersih, seimbang, dan nyaman dinikmati kapan saja.' }}</p>
                        <div class="nala-product-card__traits"><span>100% ARABIKA</span><span>MEDIUM ROAST</span><span>{{ $product->weight_options ?: '100G · 200G · 500G' }}</span></div>
                        <div class="nala-product-card__scores">
                            @foreach ($scores as $score)
                                <div class="nala-score"><div><span>{{ $score['label'] }}</span><strong>{{ $score['value'] }}</strong></div><span class="nala-score__track"><span style="width: {{ min(100, max(0, $score['value'])) }}%"></span></span></div>
                            @endforeach
                        </div>
                        <div class="nala-product-card__footer"><strong>Rp{{ number_format((int) $product->price, 0, ',', '.') }}</strong>
                            @if ($product->shopee_url)<a class="nala-btn nala-btn--gold" href="{{ route('products.shopee', $product->slug) }}" target="_blank" rel="noopener noreferrer" aria-label="Beli {{ $product->name }} di Shopee">Beli kopi <span>↗</span></a>@endif
                        </div>
                    </div>
                </article>
            @empty
                <p class="nala-section__text">Belum ada produk yang ditampilkan.</p>
            @endforelse
        </div>
    </div>
</section>
