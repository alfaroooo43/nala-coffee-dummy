<section class="nala-section nala-process" id="proses" data-reveal>
    <div class="container">
        <div class="nala-section__header">
            <p class="nala-eyebrow nala-eyebrow--dark">Proses Kami</p>
            <h2 class="nala-section__title">Pelan-pelan, <em>supaya tepat.</em></h2>
        </div>

        <div class="row g-3 g-lg-4 mt-3">
            @foreach ([['Petik Pilih', 'Buah kopi matang dipilih satu per satu sebagai awal kualitas rasa.'], ['Proses Bersih', 'Pascapanen dilakukan dengan teliti untuk menjaga karakter biji.'], ['Sortasi', 'Setiap biji dipilah agar hanya rasa terbaik yang ikut melangkah.'], ['Kemas & Kirim', 'Disiapkan segar untuk sampai di rumah dan meja kamu.']] as $index => $step)
                <div class="col-sm-6 col-lg-3">
                    <div class="nala-process-card h-100">
                        <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $step[0] }}</h3>
                        <p>{{ $step[1] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
