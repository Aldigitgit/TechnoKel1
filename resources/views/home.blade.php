@extends('layouts.home.app')

@section('content')
    <div class="all-content">
        @if (session('status') == 'success')
            <div class="alert alert-success">
                <p>Login berhasil</p>
            </div>
        @endif

        {{-- HERO --}}
        <section class="hero" id="home">
            <div class="hero-bg-text">DUHA PAO</div>
            <div class="hero-inner">
                <div class="hero-text">
                    <div class="hero-badge"><span>🏪 Pangkalan Kerinci, Pelalawan</span></div>
                    <h1>Bakpao & Dimsum<br><em>Lezat</em> Setiap Hari</h1>
                    <p>Dikukus & digoreng segar setiap pagi. Aneka pilihan rasa dari resep terbaik Duha Pao sejak 2005.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('pesan.create') }}" class="btn-primary">pesan Sekarang</a>
                        <a href="#product-cards" class="btn-secondary">Lihat Menu</a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item"><span class="stat-num">2005</span><span class="stat-label">Berdiri
                                Sejak</span></div>
                        <div class="stat-item"><span class="stat-num">16+</span><span class="stat-label">Varian Menu</span>
                        </div>
                        <div class="stat-item"><span class="stat-num">⭐ 4.8</span><span class="stat-label">Rating</span>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <img src="https://img.sanishtech.com/u/930967ffad3897f66be8d0148e54887e.jpeg" alt="Bakpao Hero"
                        class="hero-img">
                </div>
            </div>
        </section>

        {{-- TOP CARDS --}}
        <div class="top-images">
            <div class="container">
                <div class="img-grid">
                    <div class="img-card" data-label="Bakpao Kukus">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAXB5UDlXiK95KlmgvrblIR2d72ikfZLfCIA&s"
                            alt="Bakpao Kukus">
                    </div>
                    <div class="img-card" data-label="Dimsum Goreng">
                        <img src="https://png.pngtree.com/background/20210716/original/pngtree-fried-dimsum-and-sauce-picture-image_1355078.jpg"
                            alt="Dimsum Goreng">
                    </div>
                    <div class="img-card" data-label="Risol Mayo">
                        <img src="https://png.pngtree.com/thumb_back/fh260/background/20240808/pngtree-risol-mayo-or-risoles-mayonaise-image_16125404.jpg"
                            alt="Risol Mayo">
                    </div>
                </div>
            </div>
        </div>

        {{-- PRODUCT CARDS --}}
        <section id="product-cards">
            <div class="container">
                <div class="section-header">
                    <span class="eyebrow">Menu Pilihan</span>
                    <h2>Bakpao & Dimsum Kami</h2>
                </div>
                <div class="filter-tabs">
                    <button class="filter-tab active" onclick="filterMenu('semua', this)">Semua</button>
                    <button class="filter-tab" onclick="filterMenu('bakpao-manis', this)">Bakpao Manis</button>
                    <button class="filter-tab" onclick="filterMenu('bakpao-gurih', this)">Bakpao Gurih</button>
                    <button class="filter-tab" onclick="filterMenu('risol-mayo', this)">Risol Mayo</button>
                    <button class="filter-tab" onclick="filterMenu('dimsum', this)">Dimsum</button>
                </div>

                <div class="product-grid" id="product-grid">
                    {{-- Bakpao Manis --}}
                    <div class="product-card" data-cat="bakpao-manis">
                        <div class="card-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrjycUtWo6SM9kNkLMmIKiN9fyz6hMJQXwug&s"
                                alt="Bakpao Coklat Lumer">
                            <span class="card-badge badge-terlaris">Terlaris</span>
                        </div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Bakpao Coklat Lumer</div>
                            <div class="card-desc">Isi coklat lumer lembut, kulit putih empuk</div>
                            <div class="card-footer"><span class="card-price">Rp 5.000</span><button class="btn-add"
                                    onclick="pesanWA('Bakpao Coklat Lumer')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="bakpao-manis">
                        <div class="card-img"><img
                                src="https://thewoksoflife.com/wp-content/uploads/2021/01/steamed-red-bean-buns-3.jpg"
                                alt="Bakpao Kacang Merah"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★☆</div>
                            <div class="card-name">Bakpao Kacang Merah</div>
                            <div class="card-desc">Isi kacang merah manis, gurih alami</div>
                            <div class="card-footer"><span class="card-price">Rp 5.000</span><button class="btn-add"
                                    onclick="pesanWA('Bakpao Kacang Merah')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="bakpao-manis">
                        <div class="card-img"><img
                                src="https://cdn.grid.id/crop/0x0:0x0/700x465/smart/filters:format(webp):quality(100)/photo/sasefoto/original/18015-bakpao-isi-kacang-keju.jpg"
                                alt="Bakpao Keju"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Bakpao Keju</div>
                            <div class="card-desc">Isi keju leleh yang creamy dan gurih</div>
                            <div class="card-footer"><span class="card-price">Rp 6.000</span><button class="btn-add"
                                    onclick="pesanWA('Bakpao Keju')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="bakpao-manis">
                        <div class="card-img"><img src="https://i.ytimg.com/vi/fXXhSTF9l1I/maxresdefault.jpg"
                                alt="Bakpao Durian"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Bakpao Durian</div>
                            <div class="card-desc">Isi durian lumer manis dan legit</div>
                            <div class="card-footer"><span class="card-price">Rp 5.000</span><button class="btn-add"
                                    onclick="pesanWA('Bakpao Durian')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="bakpao-manis">
                        <div class="card-img"><img
                                src="https://img-global.cpcdn.com/steps/5a85cf5f5af4c7f8/400x400cq80/photo.jpg"
                                alt="Bakpao Kelapa Gula Merah"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★☆</div>
                            <div class="card-name">Bakpao Kelapa Gula Merah</div>
                            <div class="card-desc">Isi kelapa parut gula merah tradisional</div>
                            <div class="card-footer"><span class="card-price">Rp 5.000</span><button class="btn-add"
                                    onclick="pesanWA('Bakpao Kelapa Gula Merah')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="bakpao-manis">
                        <div class="card-img"><img
                                src="https://img-global.cpcdn.com/recipes/4f39ae445776b865/680x781cq80/bakpao-coklat-keju-adonan-roti-goreng-kremes-foto-resep-utama.jpg"
                                alt="Bakpao Coklat Keju"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Bakpao Coklat Keju</div>
                            <div class="card-desc">Perpaduan coklat lumer dan keju gurih</div>
                            <div class="card-footer"><span class="card-price">Rp 6.000</span><button class="btn-add"
                                    onclick="pesanWA('Bakpao Coklat Keju')">+</button></div>
                        </div>
                    </div>

                    {{-- Bakpao Gurih --}}
                    <div class="product-card" data-cat="bakpao-gurih">
                        <div class="card-img"><img
                                src="https://cdn.yummy.co.id/content-images/images/20220718/Z6imi8oerjllzhkSlg2zEApgFMxF4Tgx-31363538313431313732d41d8cd98f00b204e9800998ecf8427e.jpg?x-oss-process=image/resize,w_388,h_388,m_fixed,x-oss-process=image/format,webp"
                                alt="Bakpao Ayam Suwir"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Bakpao Ayam Suwir</div>
                            <div class="card-desc">Isi ayam suwir berbumbu rempah lezat</div>
                            <div class="card-footer"><span class="card-price">Rp 6.000</span><button class="btn-add"
                                    onclick="pesanWA('Bakpao Ayam Suwir')">+</button></div>
                        </div>
                    </div>

                    {{-- Risol Mayo --}}
                    <div class="product-card" data-cat="risol-mayo">
                        <div class="card-img"><img src="https://aslimasako.com/storage/post/new-title-22012024-065737.jpg"
                                alt="Sosis Mayo"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Sosis Mayo</div>
                            <div class="card-desc">Isi sosis dan mayo gurih</div>
                            <div class="card-footer"><span class="card-price">Rp 2.000</span><button class="btn-add"
                                    onclick="pesanWA('Sosis Mayo')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="risol-mayo">
                        <div class="card-img"><img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7ga4SS1VDMA2H2IecwgmTuKP3OSBS-Znunw&s"
                                alt="Beef Mayo"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Beef Mayo</div>
                            <div class="card-desc">Isi daging sapi dan mayo spesial</div>
                            <div class="card-footer"><span class="card-price">Rp 2.000</span><button class="btn-add"
                                    onclick="pesanWA('Beef Mayo')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="risol-mayo">
                        <div class="card-img"><img
                                src="https://img-global.cpcdn.com/recipes/01ee4d34c9c6ec0d/400x400cq80/photo.jpg"
                                alt="Telor Mayo"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★☆</div>
                            <div class="card-name">Telor Mayo</div>
                            <div class="card-desc">Isi telur rebus dan saus mayo</div>
                            <div class="card-footer"><span class="card-price">Rp 2.000</span><button class="btn-add"
                                    onclick="pesanWA('Telor Mayo')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="risol-mayo">
                        <div class="card-img"><img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRui1Oxa6nfzyG7gFXUuRFRZmmCzUw9ydaCMA&s"
                                alt="Ayam Suwir Mayo"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Ayam Suwir Mayo</div>
                            <div class="card-desc">Isi ayam suwir gurih dan mayo</div>
                            <div class="card-footer"><span class="card-price">Rp 2.000</span><button class="btn-add"
                                    onclick="pesanWA('Ayam Suwir Mayo')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="risol-mayo">
                        <div class="card-img">
                            <img src="https://www.dapurkobe.co.id/wp-content/uploads/risol-mayo.jpg" alt="Risol Combo Mayo">
                            <span class="card-badge badge-terlaris">Spesial</span>
                        </div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Risol Combo Mayo</div>
                            <div class="card-desc">Campuran isi spesial ekstra mayo</div>
                            <div class="card-footer"><span class="card-price">Rp 3.000</span><button class="btn-add"
                                    onclick="pesanWA('Risol Combo Mayo')">+</button></div>
                        </div>
                    </div>

                    {{-- Dimsum --}}
                    <div class="product-card" data-cat="dimsum">
                        <div class="card-img"><img
                                src="https://i.ytimg.com/vi/Gp5A6RBdjnU/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAwnP7f1leZW2Tm_M2EV9F5KQWZqw"
                                alt="Dimsum Ayam"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Dimsum Ayam</div>
                            <div class="card-desc">Isi ayam lezat dengan kulit lembut</div>
                            <div class="card-footer"><span class="card-price">Rp 6.000</span><button class="btn-add"
                                    onclick="pesanWA('Dimsum Ayam')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="dimsum">
                        <div class="card-img"><img
                                src="https://awsimages.detik.net.id/community/media/visual/2021/08/10/resep-lumpia-udang-gulung_43.jpeg?w=600&q=90"
                                alt="Dimsum Udang"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Dimsum Udang</div>
                            <div class="card-desc">Isi udang segar berkualitas</div>
                            <div class="card-footer"><span class="card-price">Rp 6.000</span><button class="btn-add"
                                    onclick="pesanWA('Dimsum Udang')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="dimsum">
                        <div class="card-img"><img
                                src="https://telusurdapur.id/wp-content/uploads/2025/11/telusur-dapur-resep-dimsum-goreng-keju-lumer-a-dapur-wira-ria-sushanty.webp"
                                alt="Dimsum Keju"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Dimsum Keju</div>
                            <div class="card-desc">Isi ayam dengan lelehan keju</div>
                            <div class="card-footer"><span class="card-price">Rp 6.000</span><button class="btn-add"
                                    onclick="pesanWA('Dimsum Keju')">+</button></div>
                        </div>
                    </div>
                    <div class="product-card" data-cat="dimsum">
                        <div class="card-img"><img
                                src="https://cnc-magazine.oramiland.com/parenting/original_images/resep_dimsum_goreng_keju_lumer.png"
                                alt="Dimsum Mix"></div>
                        <div class="card-body">
                            <div class="card-stars">★★★★★</div>
                            <div class="card-name">Dimsum Mix</div>
                            <div class="card-desc">Campuran aneka rasa dimsum lezat</div>
                            <div class="card-footer"><span class="card-price">Rp 6.000</span><button class="btn-add"
                                    onclick="pesanWA('Dimsum Mix')">+</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- BANNER --}}
        <div class="banner-section">
            <div class="container">
                <div class="banner-inner">
                    <div class="banner-text">
                        <h2>Segar Dikukus & Digoreng Setiap Hari</h2>
                        <p>pesan sekarang untuk sarapan atau camilan keluarga. Tersedia juga untuk acara dan pesanan dalam
                            jumlah besar.</p>
                        <a href="{{ route('pesan.create') }}" class="btn-primary">pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- GALLERY --}}
        <section id="gallary">
            <div class="container">
                <div class="section-header">
                    <span class="eyebrow">Galeri Kami</span>
                    <h2>Lezat dari Dapur Duha Pao</h2>
                </div>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="https://img.pikbest.com/backgrounds/20260330/delicious-steamed-bao-buns-on-a-black-plate-fresh-cuisine-light-wood-background_17907641.jpg!f305cw"
                            alt="Bakpao Kukus">
                        <div class="gallery-overlay"><span>Bakpao Kukus Segar</span></div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrjycUtWo6SM9kNkLMmIKiN9fyz6hMJQXwug&s"
                            alt="Bakpao Coklat">
                        <div class="gallery-overlay"><span>Bakpao Coklat</span></div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://i.ytimg.com/vi/Gp5A6RBdjnU/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAwnP7f1leZW2Tm_M2EV9F5KQWZqw"
                            alt="Dimsum Goreng">
                        <div class="gallery-overlay"><span>Dimsum Goreng</span></div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://cdn.grid.id/crop/0x0:0x0/700x465/smart/filters:format(webp):quality(100)/photo/sasefoto/original/18015-bakpao-isi-kacang-keju.jpg"
                            alt="Bakpao Keju">
                        <div class="gallery-overlay"><span>Bakpao Keju</span></div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://aslimasako.com/storage/post/new-title-22012024-065737.jpg" alt="Risol Mayo">
                        <div class="gallery-overlay"><span>Risol Mayo</span></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ABOUT --}}
        <section id="about">
            <div class="container">
                <div class="about-inner">
                    <div class="about-img">
                        <img src="https://img.sanishtech.com/u/930967ffad3897f66be8d0148e54887e.jpeg"
                            alt="Tentang Duha Pao">
                    </div>
                    <div class="about-text">
                        <h2>Tentang Duha Pao</h2>
                        <p>Duha Dapur adalah UMKM kuliner yang awalnya memproduksi bolu kemojo, namun mengalami penjualan
                            rendah dan kerugian. Pemilik kemudian beralih ke bakpao dan dimsum goreng, meski sempat
                            menghadapi berbagai kegagalan produksi hingga menemukan resep yang tepat. Ciri khas Duha Dapur
                            adalah harga tetap Rp5.000,00 per porsi bakpao goreng, meskipun biaya produksi meningkat.
                            Strategi ini dilakukan agar produk tetap terjangkau dan menjaga loyalitas pelanggan.
                            Keberhasilan Duha Dapur didukung oleh konsistensi rasa, harga yang stabil, serta kerja sama
                            dengan instansi seperti Eka Hospital dan RS Prima. Walau teknologi yang digunakan masih
                            sederhana melalui WhatsApp, pendekatan personal membantu menjaga hubungan baik dengan pelanggan.
                        </p>
                        <div class="about-highlights">
                            <div class="highlight"><span class="num">2005</span><span class="lbl">Berdiri</span></div>
                            <div class="highlight"><span class="num">2017</span><span class="lbl">Buka Toko</span></div>
                            <div class="highlight"><span class="num">16+</span><span class="lbl">Varian</span></div>
                            <div class="highlight"><span class="num">⭐ 4.8</span><span class="lbl">Rating</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CONTACT --}}
        <section id="contact">
            <div class="container">
                <div class="section-header">
                    <span class="eyebrow">Hubungi Kami</span>
                    <h2>pesan Sekarang</h2>
                </div>
                <div class="contact-cards">
                    <div class="contact-card"><span class="icon">📍</span>
                        <h4>Lokasi</h4>
                        <p>Jl.Srikandi, Pekanbaru</p>
                    </div>
                    <div class="contact-card"><span class="icon">🕐</span>
                        <h4>Jam Buka</h4>
                        <p>Setiap Hari<br>07.00 – 20.00 WIB</p>
                    </div>
                    <div class="contact-card"><span class="icon">📦</span>
                        <h4>pesanan Besar</h4>
                        <p>Tersedia untuk acara, arisan, dan pesanan massal</p>
                    </div>
                </div>
                <div class="contact-cta">
                    <a href="https://wa.me/6282286441258" target="_blank" class="btn-whatsapp">💬 Chat via WhatsApp</a>
                </div>
            </div>
        </section>
    </div>

    {{-- CSS (sama seperti sebelumnya, tanpa perubahan) --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --brown-dark: #4A1E0C;
            --brown: #6B3A2A;
            --brown-mid: #8B4A30;
            --gold: #D4882E;
            --gold-light: #E8A040;
            --cream: #FFF8F0;
            --cream-mid: #FFF2E5;
            --cream-dark: #FFE5CC;
            --muted: #9A7060;
            --text: #2C1A10;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Nunito', 'Segoe UI', sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        .all-content {
            background: var(--cream);
        }

        .alert-success {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 1000;
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .hero {
            min-height: 88vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            background: radial-gradient(ellipse at 70% 40%, #FFD4A820 0%, transparent 55%),
                radial-gradient(ellipse at 20% 80%, #D4882E15 0%, transparent 50%),
                var(--cream);
            position: relative;
            overflow: hidden;
        }

        .hero-bg-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Playfair Display', serif;
            font-size: clamp(100px, 20vw, 220px);
            font-weight: 900;
            color: rgba(212, 136, 46, 0.06);
            white-space: nowrap;
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1100px;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 4rem;
            position: relative;
            z-index: 1;
        }

        .hero-text {
            flex: 1;
        }

        .hero-badge {
            display: inline-block;
            background: var(--cream-dark);
            color: var(--brown-mid);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 50px;
            border: 1px solid rgba(212, 136, 46, 0.3);
            margin-bottom: 1.2rem;
        }

        .hero-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(38px, 6vw, 64px);
            font-weight: 900;
            line-height: 1.1;
            color: var(--brown-dark);
            margin-bottom: 1rem;
        }

        .hero-text h1 em {
            color: var(--gold);
            font-style: normal;
        }

        .hero-text p {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.7;
            max-width: 420px;
            margin-bottom: 2rem;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: var(--gold);
            color: #fff;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background: var(--brown-mid);
        }

        .btn-secondary {
            background: transparent;
            color: var(--brown);
            padding: 14px 28px;
            border-radius: 50px;
            border: 2px solid var(--brown);
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            background: var(--brown);
            color: #fff;
        }

        .hero-visual {
            flex: 0 0 auto;
            text-align: center;
        }

        .hero-img {
            max-width: 280px;
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-top: 2.5rem;
        }

        .stat-item {
            text-align: left;
        }

        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--brown-dark);
            display: block;
        }

        .stat-label {
            font-size: 12px;
            color: var(--muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .top-images {
            background: var(--brown-dark);
            padding: 4rem 2rem;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .img-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .img-card {
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, var(--brown-mid), var(--brown-dark));
            position: relative;
        }

        .img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .img-card::after {
            content: attr(data-label);
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(74, 30, 12, 0.85));
            color: #FFD4A8;
            font-size: 13px;
            font-weight: 700;
            padding: 1.5rem 1rem 0.8rem;
            text-align: center;
        }

        section {
            padding: 5rem 2rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header .eyebrow {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.5rem;
            display: block;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            color: var(--brown-dark);
        }

        .filter-tabs {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }

        .filter-tab {
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            border: 2px solid rgba(107, 58, 42, 0.2);
            background: transparent;
            color: var(--muted);
            cursor: pointer;
        }

        .filter-tab:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .filter-tab.active {
            background: var(--gold);
            color: #fff;
            border-color: var(--gold);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(212, 136, 46, 0.15);
        }

        .product-card.hidden {
            display: none;
        }

        .card-img {
            position: relative;
            overflow: hidden;
            height: 160px;
            background: #f3e9dc;
        }

        .card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .card-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 10px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 50px;
            text-transform: uppercase;
            background: #E8F5E9;
            color: #2E7D32;
            border: 1px solid #4CAF50;
        }

        .card-body {
            padding: 1rem 1.1rem 1.2rem;
        }

        .card-stars {
            color: var(--gold);
            font-size: 11px;
            margin-bottom: 4px;
        }

        .card-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--brown-dark);
            margin-bottom: 4px;
        }

        .card-desc {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-price {
            font-size: 16px;
            font-weight: 800;
            color: var(--gold);
        }

        .btn-add {
            background: var(--gold);
            color: #fff;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-add:hover {
            background: var(--brown-mid);
        }

        .banner-section {
            background: var(--brown-dark);
            padding: 4rem 2rem;
        }

        .banner-inner {
            max-width: 1100px;
            margin: 0 auto;
            background: linear-gradient(135deg, var(--brown-mid), var(--brown-dark));
            border-radius: 24px;
            padding: 3rem;
            border: 1px solid rgba(212, 136, 46, 0.3);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .banner-inner::before {
            content: '🥟';
            position: absolute;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 120px;
            opacity: 0.15;
        }

        .banner-text h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(24px, 3vw, 36px);
            font-weight: 700;
            color: #FFD4A8;
            margin-bottom: 0.8rem;
        }

        .banner-text p {
            font-size: 15px;
            color: rgba(255, 212, 168, 0.7);
            margin-bottom: 1.5rem;
        }

        #gallary {
            background: var(--cream-mid);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .gallery-item {
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 1;
        }

        .gallery-item:first-child {
            grid-column: span 2;
            aspect-ratio: 2/1;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent 40%, rgba(74, 30, 12, 0.8));
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay span {
            color: #FFD4A8;
            font-size: 13px;
            font-weight: 700;
        }

        #about {
            background: #fff;
        }

        .about-inner {
            display: flex;
            gap: 4rem;
            align-items: center;
        }

        .about-img {
            flex: 0 0 320px;
            border-radius: 24px;
            overflow: hidden;
        }

        .about-img img {
            width: 100%;
            height: auto;
            display: block;
        }

        .about-text {
            flex: 1;
        }

        .about-text h2 {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            color: var(--brown-dark);
            margin-bottom: 1rem;
        }

        .about-text p {
            font-size: 15px;
            color: var(--muted);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .about-highlights {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .highlight {
            background: var(--cream);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            border: 1px solid rgba(212, 136, 46, 0.2);
            text-align: center;
            min-width: 100px;
        }

        .highlight .num {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            color: var(--gold);
            font-weight: 700;
            display: block;
        }

        .highlight .lbl {
            font-size: 11px;
            color: var(--muted);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        #contact {
            background: var(--brown-dark);
        }

        #contact .section-header .eyebrow {
            color: #FFD4A8;
        }

        #contact .section-header h2 {
            color: #FFD4A8;
        }

        .contact-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 2.5rem;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(212, 136, 46, 0.25);
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
        }

        .contact-card .icon {
            font-size: 36px;
            display: block;
            margin-bottom: 0.75rem;
        }

        .contact-card h4 {
            color: #FFD4A8;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .contact-card p {
            color: rgba(255, 212, 168, 0.65);
            font-size: 13px;
            line-height: 1.5;
        }

        .contact-cta {
            text-align: center;
        }

        .btn-whatsapp {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #25D366;
            color: #fff;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
        }

        .btn-whatsapp:hover {
            background: #1DA851;
        }

        @media (max-width: 768px) {
            .hero-inner {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .hero-text p {
                max-width: 100%;
            }

            .hero-buttons,
            .hero-stats {
                justify-content: center;
            }

            .img-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-item:first-child {
                grid-column: span 2;
            }

            .about-inner {
                flex-direction: column;
            }

            .about-img {
                flex: none;
                width: 100%;
            }

            .banner-inner::before {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .contact-cards {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .stat-item {
                text-align: center;
            }
        }
    </style>

    <script>
        function filterMenu(cat, el) {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
            document.querySelectorAll('.product-card').forEach(card => {
                if (cat === 'semua' || card.dataset.cat === cat) card.classList.remove('hidden');
                else card.classList.add('hidden');
            });
        }
        function pesanWA(nama) {
            var msg = encodeURIComponent("Halo Duha Pao, saya ingin memesan: " + nama);
            window.open('https://wa.me/6281234567890?text=' + msg, '_blank');
        }
        setTimeout(() => { let alert = document.querySelector('.alert-success'); if (alert) alert.style.display = 'none'; }, 3000);
    </script>
@endsection