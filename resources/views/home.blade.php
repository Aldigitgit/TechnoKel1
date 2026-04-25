@extends('layouts.home.app')

@section('content')
    <div class="all-content">
        <!-- navbar -->

        <!-- navbar end -->



        <!-- home section -->
        @if (session('status') == 'success')
            {{-- <?php
            print_r(session()->all());
            ?> --}}
            <div class="alert alert-success">
                <p>login berhasil</p>
            </div>
        @endif
        <div class="home" id="home">
            <div class="content" data-aos="zoom-out-right">
                <h3>Delicious
                    <br>Cakes Bakery
                </h3>
                <h2>Mels'Cake</h2>

                <a href="{{ route('Pesan.create') }}" class="btn">Order Now</a>
            </div>
            <div class="img" data-aos="zoom-out-left">
                <img src="{{ asset('Assets/image/background.png') }}" alt="">
            </div>
        </div>
        <!-- home section end -->

        <!-- top cards -->
        <div class="container" id="box" data-aos="fade-up" data-aos-duration="1500">
            <div class="row">
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <img src="{{ asset('Assets/image/brownies1.jpeg') }}" style="height: 209px; width:100%; ">
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <img src="{{ asset('Assets/image/gulung1.jpeg') }}" style="height: 209px; width:100%; ">
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <img src="{{ asset('Assets/image/kue1.jpeg') }}" style="height: 209px; width:100%; ">
                    </div>
                </div>
            </div>
        </div>
        <!-- top cards end -->

        <!-- banner -->
        <div class="banner" data-aos="fade-up" data-aos-duration="1500">
            <div class="content">
                <h3>Delicious Cake</h3>
                <div id="btnorder"><button onclick="window.location.href='{{ route('Pesan.create') }}'">Order Now</button></div>
            </div>
            <div class="img">
                <img src="{{ asset('Assets/image/banner-background.png') }}" alt="">
            </div>
        </div>
        <!-- banner end -->

        <!-- product cards -->
        <section id="product-cards" data-aos="fade-up" data-aos-duration="1500">
            <div class="container">
                <h1>Brownies</h1>
                <div class="row" style="margin-top:50px;">
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/brownies1.jpeg') }}" style="height: 150px; width:100%; " alt="">
                            <div class="card-body">
                                <h3>Brownies Coklat</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <p>Brownies dengan lapisan coklat</p>
                                <h6>Rp45.000</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/brownies2.jpeg') }}" style="height: 155px; width:100%; " alt="">
                            <div class="card-body">
                                <h4 style="color: #ffff; text-shadow: 1px 1px 1px black;">Brownies Kacang</h4>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <p>Brownies dengan lapisan tiramisu dan coklat</p>
                                <h6>Rp 50.000</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/brownies3.jpeg') }}" style="height: 160px; width:100%; " alt="">
                            <div class="card-body">
                                <h4 style="color: white;text-shadow: 1px 1px 1px black;">Brownies Pandan</h4>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <p>Brownies dengan lapisan pandan dan coklat</p>
                                <h6>Rp 45.000</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/brownies4.jpeg') }}" style="height: 160px; width:100%; " alt="">
                            <div class="card-body">
                                <h4 style="color: #ffff; text-shadow: 1px 1px 1px black;">Brownies Keju</h4>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                </div>
                                <p>Brownies dengan keju tabur diatasnya </p>
                                <h6>Rp 50.000 </h6>
                            </div>
                        </div>
                    </div>
                </div>




                <h1>Bolu Gulung</h1>
                <div class="row" style="margin-top:50px;" data-aos="fade-up" data-aos-duration="1500">
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/gulung1.jpeg') }}" style="height: 160px; width:100%; " alt="">
                            <div class="card-body">
                                <h3>Bolu Gulung Coklat</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <p>Bolu gulung dengan selai isi coklat</p>
                                <h6>Rp 50.000</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/gulung2.jpeg') }}" style="height: 160px; width:100%; " alt="">
                            <div class="card-body">
                                <h3>Bolu Gulung BlueBerry</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <p>Bolu gulung dengan selai isi blueberry</p>
                                <h6>Rp 50.000</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/gulung3.jpeg') }}" style="height: 160px; width:100%; " alt="">
                            <div class="card-body">
                                <h3>Bolu Gulung Strawberry</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <p>Bolu gulung dengan selai isi strawberry</p>
                                <h6>Rp 50.000 </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/gulung4.jpeg') }}" style="height: 160px; width:100%; " alt="">
                            <div class="card-body">
                                <h3>Bolu Gulung Coffee</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                </div>
                                <p>Bolu gulung dengan selai isi mocca</p>
                                <h6>Rp 50.000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="product-cards" data-aos="fade-up" data-aos-duration="1500">
            <div class="container">
                <h1>BIRTHDAY CAKE</h1>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/kue1.jpeg') }}" style="height: 160px; width:100%; ">
                            <div class="card-body">
                                <h3>Birthday cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                </div>
                                <p>Birthday cake dengan lelehan coklat </p>
                                <h6>Rp 90.000</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/kue2.jpeg') }}" style="height: 160px; width:100%; " alt="">
                            <div class="card-body">
                                <h3>Birthday cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                </div>
                                <p>Birthday cake dengan tema little pony </p>
                                <h6>Rp 180.000</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/kue3.jpeg') }}" style="height: 160px; width:100%; " alt="">
                            <div class="card-body">
                                <h3>Birthday cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                </div>
                                <p>Birthday cake dengan lelehan coklat hitam </p>
                                <h6>Rp 100.000 </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="{{ asset('Assets/image/kue4.jpeg') }}" style="height: 140px; width:100%; " alt="">
                            <div class="card-body">
                                <h4 style="color: #ffff; text-shadow: 1px 1px 1px black;">Birthday cake Fruit</h4>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                </div>
                                <p>Birthday cake dengan topping buah di atasnya </p>
                                <h6>Rp 200.000 </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- product cards end-->


        <!-- gallary -->
        <section id="gallary" data-aos="fade-up" data-aos-duration="1500">
            <div class="container">
                <h1>OUR GALLARY</h1>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Birtday cake</h3>
                            </div>
                            <img src="{{ asset('Assets/image/kue1.jpeg') }}" style="height:240px; width:100%; " alt="">
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Birthday cake</h3>
                            </div>
                            <img src="{{ asset('Assets/image/kue2.jpeg') }}" style="height:240px; width:100%; "alt="">
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Birthday cake fruit</h3>
                            </div>
                            <img src="{{ asset('Assets/image/kue4.jpeg') }}" style="height:240px; width:100%; " alt="">
                        </div>
                    </div>
                </div>


                <div class="row" style="margin-top: 30px;" data-aos="fade-up" data-aos-duration="1500">
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Bolu gulung coklat</h3>
                            </div>
                            <img src="{{ asset('Assets/image/gulung1.jpeg') }}" style="height:240px; width:100%; " alt="">
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Bolu gulung blueberry</h3>
                            </div>
                            <img src="{{ asset('Assets/image/gulung2.jpeg') }}" style="height:240px; width:100%; " alt="">
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Bolu gulung mocca</h3>
                            </div>
                            <img src="{{ asset('Assets/image/gulung4.jpeg') }}" style="height:240px; width:100%; " alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- gallary -->



        <!-- about -->
        <div class="container" id="about" data-aos="fade-up" data-aos-duration="1500">
            <h1>ABOUT US</h1>
            <div class="row">
                <div class="col-md-6 py-3 py-md-0">
                    <div class="card">
                        <img src="{{ asset('Assets/image/about.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 py-3 py-md-0">
                    <p>Mels Cake merupakan sebuah usaha mikro, kecil, dan menengah (UMKM) yang bergerak di bidang pembuatan kue, berlokasi di Pangkalan Kerinci, Kabupaten Pelalawan. Didirikan pada tahun 2005, Mels Cake bermula dari kegiatan hobi pemiliknya yang membuat kue di rumah untuk mengisi waktu luang. Seiring berjalannya waktu, usaha ini berkembang menjadi kegiatan usaha yang ditekuni secara serius.

                        Pada tahun 2017, Mels Cake membuka toko kue untuk melayani pelanggan secara langsung. Kehadiran toko ini disambut dengan antusiasme yang tinggi dari masyarakat sekitar. Meskipun pada awalnya dijalankan dengan modal yang terbatas, Mels Cake terus berkembang melalui inovasi produk dan peningkatan layanan kepada pelanggan. Hingga kini, Mels Cake tetap berkomitmen untuk memberikan produk berkualitas dan layanan terbaik bagi para pelanggan setiap harinya.</p>
                </div>
            </div>
        </div>
        <!-- about -->


        <!-- contact  -->
        <div class="container" id="contact" data-aos="fade-up" data-aos-duration="1500">
            <h1>CONTACT US</h1>
            {{-- <div class="row">
                <div class="col-md-4 py-1 py-md-0">
                    <div class="form-group">
                        <input type="text" class="form-control" id="usr" placeholder="Name">
                    </div>
                </div>
                <div class="col-md-4 py-1 py-md-0">
                    <div class="form-group">
                        <input type="email" class="form-control" id="eml" placeholder="Email">
                    </div>
                </div>
                <div class="col-md-4 py-1 py-md-0">
                    <div class="form-group">
                        <input type="number" class="form-control" id="phn" placeholder="Phone">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <textarea class="form-control" rows="5" id="comment" placeholder="Message"></textarea>
            </div> --}}
            <div id="messagebtn"><button onclick="window.open('https://wa.me/6281234567890', '_blank')">WhatsApp</button></div>
        </div>
        <!-- contact end -->


        <!-- footer -->

    </div>
@endsection
