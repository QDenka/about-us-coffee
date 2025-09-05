<!-- Hero Section -->
<section class="hero" id="home" @if($heroSettings?->background_image) style="background: linear-gradient(135deg, rgba(245, 242, 237, 0.95), rgba(184, 181, 176, 0.95)), url({{ asset('storage/' . $heroSettings?->background_image) }}) center center / cover no-repeat;" @endif>
    <!-- Floating Coffee Beans SVG -->
    <svg class="coffee-bean-svg" style="top: 10%; left: 5%; width: 70px; height: 45px;" viewBox="0 0 60 40">
        <ellipse cx="30" cy="20" rx="28" ry="18" fill="#D4A574" stroke="#1A1A1A" stroke-width="3"/>
        <path d="M30 5 Q30 20 30 35" stroke="#3D2817" stroke-width="2" fill="none" opacity="0.5"/>
    </svg>

    <svg class="coffee-bean-svg" style="top: 60%; right: 8%; width: 55px; height: 38px; animation-delay: 3s;"
         viewBox="0 0 60 40">
        <ellipse cx="30" cy="20" rx="28" ry="18" fill="#8B6F47" stroke="#1A1A1A" stroke-width="3"/>
        <path d="M30 5 Q30 20 30 35" stroke="#3D2817" stroke-width="2" fill="none" opacity="0.5"/>
    </svg>

    <svg class="coffee-bean-svg" style="bottom: 15%; left: 12%; width: 50px; height: 35px; animation-delay: 6s;"
         viewBox="0 0 60 40">
        <ellipse cx="30" cy="20" rx="28" ry="18" fill="#A67C52" stroke="#1A1A1A" stroke-width="3"/>
        <path d="M30 5 Q30 20 30 35" stroke="#3D2817" stroke-width="2" fill="none" opacity="0.5"/>
    </svg>

    <div class="hero-content">
        <div class="hero-main">
            <h1 class="hero-title">
                @if(safeGetTranslation($heroSettings, 'title', app()->getLocale()))
                    @php
                        $titleParts = explode(' ', safeGetTranslation($heroSettings, 'title', app()->getLocale()));
                    @endphp
                    @if(count($titleParts) >= 2)
                        <span class="about">{{ $titleParts[0] }}</span>
                        <span class="us">{{ $titleParts[1] }}</span>
                    @else
                        <span class="about">{{ safeGetTranslation($heroSettings, 'title', app()->getLocale()) }}</span>
                    @endif
                @else
                    <span class="about">ABOUT</span>
                    <span class="us">US</span>
                @endif
            </h1>
            <p class="hero-subtitle">{{ $heroSettings?->subtitle ?? 'Your next cup, Your best cup.' }}</p>
            <div class="hero-actions">
                <a href="#menu" class="cta-button">{{ app()->getLocale() == 'vi' ? 'XEM THỰC ĐƠN' : 'EXPLORE MENU' }}</a>
                <a href="#contact" class="cta-button-outline">{{ app()->getLocale() == 'vi' ? 'LIÊN HỆ' : 'CONTACT US' }}</a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="coffee-visual">
                <div class="phin-container">
                    <div class="phin-filter">
                        <div class="phin-lid"></div>
                        <div class="phin-handle"></div>
                    </div>
                    <div class="coffee-drips">
                        <div class="drip"></div>
                        <div class="drip"></div>
                        <div class="drip"></div>
                    </div>
                    <div class="coffee-glass">
                        <div class="condensed-milk"></div>
                        <div class="coffee-liquid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>