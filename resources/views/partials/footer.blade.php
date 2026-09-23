<footer class="nala-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <a class="nala-footer__brand" href="#home"><span>N</span>{{ $settings['website_name'] ?? 'Nala Coffee' }}</a>
                <p>Kopi dari Ijen, dirawat dengan niat baik.<br>Company profile dummy untuk latihan Laravel.</p>
            </div>
            <div class="col-6 col-lg-3">
                <h2>Eksplor</h2>
                <a href="#cerita">Cerita</a>
                <a href="#kopi">Kopi</a>
                <a href="#proses">Proses</a>
                <a href="#petani">Petani</a>
            </div>
            <div class="col-6 col-lg-4">
                <h2>Temui kami</h2>
                <a href="{{ $settings['instagram'] ?? 'https://example.com/nala-coffee-instagram' }}" target="_blank" rel="noopener noreferrer">Instagram</a>
                <a href="{{ $settings['tiktok'] ?? 'https://example.com/nala-coffee-tiktok' }}" target="_blank" rel="noopener noreferrer">TikTok</a>
                <a href="{{ $settings['shopee_url'] ?? 'https://example.com/nala-coffee-shopee' }}" target="_blank" rel="noopener noreferrer">Shopee <span>↗</span></a>
            </div>
        </div>
        <div class="nala-footer__bottom">
            <span>&copy; {{ date('Y') }} Nala Coffee Dummy. All rights reserved.</span>
            <span>Not an official Nala Coffee website.</span>
        </div>
    </div>
</footer>
