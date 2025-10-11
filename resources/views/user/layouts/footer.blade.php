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
                                <h5 itemprop="headline">Lokasi Peta</h5>
                                {{-- <p itemprop="description">Aplikasi Sistem Informasi Masjid Jami' Al Furqaan untuk memudahkan umat dalam
                                    mengakses info, layanan masjid, dan kegiatan keagamaan masjid.
                                </p> --}}
                                <div class="loc-mp brd-rd5">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.89729286637038!2d107.0455407205455!3d-6.216604666744997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698f001e4d2dc1%3A0xa847812afa0acd4c!2smasjid%20al%20furqaan!5e0!3m2!1sid!2sid!4v1759559260896!5m2!1sid!2sid" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                <span><i class="fas fa-map-marker-alt theme-clr"></i>Lokasi Masjid Jami' Al Furqaan</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-lg-4">
                            <div class="widget">
                                <h5 itemprop="headline">Artikel Terbaru</h5>
                                <div class="rcnt-wrp">
                                    @forelse ($latestArticles as $artikel)
                                        <div class="rcnt-bx">
                                            <a class="brd-rd5" href="{{ url('/artikel/' . $artikel->slug) }}" title="{{ $artikel->judul }}" itemprop="url">
                                                @if ($artikel->photo)
                                                    <img src="{{ asset('public/artikel/' . $artikel->photo) }}" alt="{{ $artikel->judul }}" width="75" height="75" itemprop="image">
                                                @else
                                                    <img src="{{ asset('assets/images/resources/rcnt-img1.jpg') }}" alt="default image" itemprop="image">
                                                @endif
                                            </a>
                                            <div class="rcnt-inf">
                                                <h6 itemprop="headline"><a href="{{ url('/artikel/' . $artikel->slug) }}" title="{{ $artikel->judul }}" itemprop="url">{{ $artikel->judul }}</a></h6>
                                                <span class="theme-clr"><i class="far fa-calendar-alt"></i>{{ $artikel->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="rcnt-bx">
                                            <p>Tidak ada artikel terbaru.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-lg-4">
                            <div class="widget">
                                <h5 itemprop="headline">Info Kontak</h5>
                                <ul class="cnt-inf">
                                    <li><i class="far fa-envelope theme-clr"></i><a href="#" title=""
                                            itemprop="url">dkmalfurqaan2020@mail.com</a></li>
                                    <li><i class="fas fa-phone theme-clr"></i><span>+62 812-8265-1499</span></li>
                                    <li><i class="fas fa-map-marker-alt theme-clr"></i>Taman Alamanda Blok C, Desa Karangsatria, Kecamatan Tambun Utara,
                                        Kabupaten Bekasi, Jawa Barat 17530.</li>
                                </ul>
                                <div class="scl1">
                                    <a href="https://www.facebook.com/masjid.al.furqaan.alamanda" target="_blank" title="Facebook" itemprop="url" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.instagram.com/masjid.alfurqaan.alamanda/" title="Instagram" itemprop="url" target="_blank"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="https://www.youtube.com/channel/UCnzWSR4rL885qubKfJ9exLg/featured" title="Youtube" itemprop="url" target="_blank"><i
                                            class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-4 col-sm-6 col-lg-4">
                            <div class="widget">
                                <h5 itemprop="headline">Rekening Donasi an Masjid Jami Al Furqaan</h5>
                                <img src="{{ asset('qris.png') }}" width="200px" alt="">
                                <p itemprop="description"><strong>Rekening Muamalat:</strong> 369 001 3830</p>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="cpy-rgt text-center">
                    <p itemprop="description"><a href="#" title="" itemprop="url"
                            target="_blank">Bidang Humas dan Teknologi Informasi</a> &copy; {{ now()->format('Y') }}
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
