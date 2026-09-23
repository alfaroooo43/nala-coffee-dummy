<section class="nala-section nala-partnership" id="mitra" data-reveal>
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5">
                <p class="nala-eyebrow nala-eyebrow--dark">Kemitraan</p>
                <h2 class="nala-section__title">Mari tumbuh<br><em>bersama Nala.</em></h2>
                <p class="nala-section__text">Punya kedai, kantor, atau ruang yang ingin menyajikan kopi dengan cerita? Ceritakan sedikit tentang kebutuhanmu.</p>
                <div class="nala-partnership__contact"><span>WhatsApp</span><strong>{{ $settings['whatsapp'] ?? '+62 812-0000-0000' }}</strong><span>Email</span><strong>{{ $settings['email'] ?? 'halo@example.test' }}</strong></div>
            </div>
            <div class="col-lg-7">
                <form class="nala-partnership__form" data-partnership-form data-whatsapp="{{ $settings['whatsapp'] ?? '+62 812-0000-0000' }}">
                    <div class="row g-3">
                        <div class="col-md-6"><label for="partner-name">Nama Lengkap</label><input id="partner-name" name="name" required placeholder="Nama kamu"></div>
                        <div class="col-md-6"><label for="partner-city">Kota</label><input id="partner-city" name="city" required placeholder="Domisili"></div>
                        <div class="col-md-6"><label for="partner-type">Jenis Mitra</label><select id="partner-type" name="type"><option>Kedai kopi</option><option>Perkantoran</option><option>Reseller</option><option>Lainnya</option></select></div>
                        <div class="col-md-6"><label for="partner-product">Pilih Produk</label><select id="partner-product" name="product">@foreach ($products as $product)<option>{{ $product->name }}</option>@endforeach<option>Belum menentukan</option></select></div>
                        <div class="col-12"><label for="partner-message">Kebutuhan / Pesan</label><textarea id="partner-message" name="message" rows="3" placeholder="Ceritakan sedikit tentang kebutuhanmu"></textarea></div>
                        <div class="col-12"><button class="btn nala-btn nala-btn--gold" type="submit">Kirim via WhatsApp <span>↗</span></button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
