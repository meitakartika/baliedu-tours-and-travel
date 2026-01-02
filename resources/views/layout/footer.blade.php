<!-- ================= FOOTER ================= -->
<footer class="relative text-white"
    style="background-image: url('/images/footer-bg.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <!-- Ornament kanan -->
    <img src="/images/footer-ornament.png" alt="Ornament"
        class="absolute right-0 bottom-0 h-[30%] md:h-[80%] max-w-none opacity-20 lg:opacity-80 pointer-events-none z-0">

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-6 py-10 lg:py-14 z-10">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">

            <!-- Column 1 -->
            <div>
                <img src="/images/logo-footer.png" alt="Baliedu" class="h-10 mb-6">

                <p class="text-sm leading-relaxed text-white/90">
                    Baliedu Tours and Travel offers authentic and meaningful Bali travel
                    experiences, inviting travelers to explore the island's culture,
                    nature, and local life up close.
                </p>
            </div>

            <!-- Column 2 -->
            <div class="lg:ml-10">
                <h4 class="font-semibold mt-2 mb-6">Tour Packages</h4>
                <ul class="space-y-3 text-sm text-white/90">
                    <li><a href="#" class="hover:opacity-80">Special Packages</a></li>
                    <li><a href="#" class="hover:opacity-80">Bali Trips</a></li>
                    <li><a href="#" class="hover:opacity-80">Homestay</a></li>
                    <li><a href="#" class="hover:opacity-80">Volunteer</a></li>
                </ul>
            </div>

            <!-- Column 3 -->
            <div>
                <h4 class="font-semibold mt-2 mb-6">Contact Info</h4>
                <ul class="space-y-4 text-sm text-white/90">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot mt-1"></i>
                        <span>
                            Jl. Pasekan Gg. Batubara 26,<br>
                            Batubulan, Sukawati, Gianyar – Bali
                        </span>
                    </li>

                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-phone"></i>
                        +62 813 5318 7669
                    </li>

                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope"></i>
                        baliedutours@gmail.com
                    </li>
                </ul>
            </div>

            <!-- Column 4 -->
            <div class="lg:ml-10">
                <h4 class="font-semibold mt-2 mb-6">Follow Us</h4>

                <div class="grid grid-cols-3 gap-3 text-lg max-w-[120px]">
                    <a href="#" class="hover:opacity-80">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="#" class="hover:opacity-80">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="#" class="hover:opacity-80">
                        <i class="fa-brands fa-twitter"></i>
                    </a>

                    <a href="#" class="hover:opacity-80">
                        <i class="fa-brands fa-youtube"></i>
                    </a>

                    <a href="#" class="hover:opacity-80 flex items-center">
                        <img src="{{ asset('images/icons/tripadvisor.svg') }}" alt="TripAdvisor"
                            class="w-4 h-4 object-contain">
                    </a>

                    <a href="#" class="hover:opacity-80">
                        <i class="fa-brands fa-flickr"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="mt-10">
            <div class="border-t border-white/50 w-[85%]"></div>

            <div class="pt-4 text-sm mt-2 text-white/80">
                © 2026 Baliedu Tours & Travel
            </div>
        </div>
</footer>
