<footer>
    <div class="gap" style="padding-bottom: 220px">
        <img class = "vector-bg-footer" src="{{ asset('assets-landing/images/bg-vector.png') }}" alt="vector-bg"
            itemprop="image">
        <div class="container">
            <div class="footer-data brd-rd20 overlap-220">
                <div class="footer-data-inr">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-lg-4">
                            <div class="widget">
                                <h5 itemprop="headline">Tentang Kami</h5>
                                <p itemprop="description">Aplikasi Masjid Agung Sultan hadir untuk memudahkan umat dalam
                                    mengakses info, layanan masjid, dan kegiatan keagamaan setiap hari.
                                </p>
                                <div class="loc-mp brd-rd5">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.366767239663!2d119.49635211011523!3d-5.204917679738017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee33c061a2f93%3A0x5520dae652991f7a!2sMasjid%20Agung%20Sultan%20Alauddin!5e0!3m2!1sid!2sid!4v1748535526912!5m2!1sid!2sid"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                {{-- <span><i class="fas fa-map-marker-alt theme-clr"></i>Lokasi Masjid Agung Sultan
                                    Alauddin</span> --}}
                            </div>
                        </div>
                        {{-- <div class="col-md-4 col-sm-6 col-lg-4">
                            <div class="widget">
                                <h5 itemprop="headline">Latest Blogs</h5>
                                <div class="rcnt-wrp">
                                    <div class="rcnt-bx">
                                        <a class="brd-rd5" href="blog-detail.html" title="" itemprop="url"><img
                                                src="assets/images/resources/rcnt-img1.jpg" alt="rcnt-img1.jpg"
                                                itemprop="image"></a>
                                        <div class="rcnt-inf">
                                            <h6 itemprop="headline"><a href="blog-detail.html" title=""
                                                    itemprop="url">Help Poor People</a></h6>
                                            <span class="theme-clr"><i class="far fa-calendar-alt"></i>Sept
                                                09, 2023</span>
                                        </div>
                                    </div>
                                    <div class="rcnt-bx">
                                        <a class="brd-rd5" href="blog-detail.html" title="" itemprop="url"><img
                                                src="assets/images/resources/rcnt-img2.jpg" alt="rcnt-img2.jpg"
                                                itemprop="image"></a>
                                        <div class="rcnt-inf">
                                            <h6 itemprop="headline"><a href="blog-detail.html" title=""
                                                    itemprop="url">Learn Modern Islam</a></h6>
                                            <span class="theme-clr"><i class="far fa-calendar-alt"></i>Sept
                                                05, 2023</span>
                                        </div>
                                    </div>
                                    <div class="rcnt-bx">
                                        <a class="brd-rd5" href="blog-detail.html" title="" itemprop="url"><img
                                                src="assets/images/resources/rcnt-img2.jpg" alt="rcnt-img2.jpg"
                                                itemprop="image"></a>
                                        <div class="rcnt-inf">
                                            <h6 itemprop="headline"><a href="blog-detail.html" title=""
                                                    itemprop="url">Learn Modern Islam</a></h6>
                                            <span class="theme-clr"><i class="far fa-calendar-alt"></i>Sept
                                                05, 2023</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-4 col-sm-6 col-lg-4">
                            <div class="widget">
                                <h5 itemprop="headline">Info Kontak</h5>
                                <ul class="cnt-inf">
                                    <li><i class="far fa-envelope theme-clr"></i><a href="#" title=""
                                            itemprop="url">bismillah@mail.com</a></li>
                                    <li><i class="fas fa-phone theme-clr"></i><span>+62 812-2997-7345</span></li>
                                    <li><i class="fas fa-map-marker-alt theme-clr"></i>Romangolong, Kec. Somba Opu</li>
                                </ul>
                                {{-- <div class="scl1">
                                    <a href="#" title="Twitter" itemprop="url" target="_blank"><i
                                            class="fab fa-twitter"></i></a>
                                    <a href="#" title="Facebook" itemprop="url" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="#" title="Linkedin" itemprop="url" target="_blank"><i
                                            class="fab fa-linkedin-in"></i></a>
                                    <a href="#" title="Google Plus" itemprop="url" target="_blank"><i
                                            class="fab fa-google-plus-g"></i></a>
                                    <a href="#" title="Instagram" itemprop="url" target="_blank"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="#" title="Youtube" itemprop="url" target="_blank"><i
                                            class="fab fa-youtube"></i></a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-lg-4">
                            <div class="widget">
                                <h5 itemprop="headline">Sedekah Tidak Akan Membuatmu Miskin</h5>
                                <img src="{{ asset('qris.png') }}" width="200px" alt="">
                                <p itemprop="description"><strong>Rekening BSI:</strong> 1717 1515 49</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cpy-rgt text-center">
                    <p itemprop="description"><a href="#" title="" itemprop="url"
                            target="_blank">SAPURATACREATIVE</a> &copy; {{ now()->format('Y') }} / ALL RIGHTS RESERVED
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
{{-- <section>
    <div class="gap theme-bg bottom-spac50 top-spac270">
        <div class="container">
            <div class="newsletter-wrp">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-lg-4">
                        <h4 itemprop="headline">Subscribe, Untuk Info Terbaru</h4>
                    </div>
                    <div class="col-md-8 col-sm-12 col-lg-8">
                        <form class="newsletter brd-rd30">
                            <input type="email" placeholder="Enter your email address">
                            <button type="submit" class="green-bg theme-btn">DAFTAR SEKARANG</button>
                        </form>
                    </div>
                </div>
            </div><!-- Newsletter Wrap -->
        </div>
    </div>
</section> --}}
