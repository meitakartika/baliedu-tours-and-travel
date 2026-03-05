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
                    {{ __('layout.footer_description') }}
                </p>
            </div>

            <!-- Column 2 -->
            <div class="lg:ml-10">
                <h4 class="font-semibold mt-2 mb-6">{{ __('layout.tour_packages_footer') }}</h4>
                <ul class="space-y-3 text-sm text-white/90">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('tours.category', $category->id) }}" class="hover:opacity-80">
                                {{ app()->getLocale() === 'id' ? $category->name_id : $category->name_en }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Column 3 -->
            <div>
                <h4 class="font-semibold mt-2 mb-6">{{ __('layout.contact_info') }}</h4>
                <ul class="space-y-4 text-sm text-white/90">
                    @if ($baliOffice)
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot mt-1"></i>
                            <span>
                                {!! nl2br(e(app()->getLocale() === 'id' ? $baliOffice->value_id : $baliOffice->value_en)) !!}
                            </span>
                        </li>
                    @endif

                    @if ($adminPhone)
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-phone"></i>
                            {{ app()->getLocale() === 'id' ? $adminPhone->value_id : $adminPhone->value_en }}
                        </li>
                    @endif

                    @if ($adminEmail)
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope"></i>
                            {{ app()->getLocale() === 'id' ? $adminEmail->value_id : $adminEmail->value_en }}
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Column 4 -->
            <div class="lg:ml-10">
                <h4 class="font-semibold mt-2 mb-6">{{ __('layout.follow_us') }}</h4>

                <div class="grid grid-cols-3 gap-3 text-lg max-w-[120px]">
                    @foreach ($socialMedias as $sm)
                        @php
                            $iconClass = '';
                            $isImage = false;

                            switch (strtolower($sm->label)) {
                                case 'facebook':
                                    $iconClass = 'fa-brands fa-facebook-f';
                                    break;
                                case 'instagram':
                                    $iconClass = 'fa-brands fa-instagram';
                                    break;
                                case 'twitter':
                                case 'x':
                                    $iconClass = 'fa-brands fa-twitter';
                                    break;
                                case 'youtube':
                                    $iconClass = 'fa-brands fa-youtube';
                                    break;
                                case 'tripadvisor':
                                    $isImage = true;
                                    break;
                                case 'flickr':
                                    $iconClass = 'fa-brands fa-flickr';
                                    break;
                            }
                        @endphp

                        @if ($isImage)
                            <a href="{{ app()->getLocale() === 'id' ? $sm->value_id : $sm->value_en }}" target="_blank"
                                class="hover:opacity-80 flex items-center">
                                <img src="{{ asset('images/icons/tripadvisor.svg') }}" alt="{{ $sm->label }}"
                                    class="w-5 h-5 object-contain">
                            </a>
                        @else
                            <a href="{{ app()->getLocale() === 'id' ? $sm->value_id : $sm->value_en }}" target="_blank"
                                class="hover:opacity-80">
                                <i class="{{ $iconClass }}"></i>
                            </a>
                        @endif
                    @endforeach

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
