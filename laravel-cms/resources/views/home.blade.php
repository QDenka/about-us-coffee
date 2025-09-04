@php
function safeGetTranslation($model, $field, $locale) {
    if (!$model) return '';
    $translation = $model->getTranslation($field, $locale);
    if (is_array($translation)) {
        // Handle nested structure like {"vi":{"vi":"value"}}
        if (isset($translation[$locale]) && is_array($translation[$locale])) {
            $result = $translation[$locale][$locale] ?? '';
        } else {
            // Handle simple structure like {"vi":"value"}
            $result = $translation[$locale] ?? '';
        }
    } else {
        $result = $translation ?? '';
    }
    
    // Convert different line break formats to actual line breaks
    $result = str_replace(['\\n', '\n'], "\n", $result);
    $result = str_replace(['\r\n', '\\r\\n'], "\n", $result);
    
    return $result;
}

function shouldShowSection($sectionKey, $visibleSections) {
    return in_array($sectionKey, $visibleSections ?? []);
}

function getSectionOrder($sectionKey, $sectionOrder) {
    return $sectionOrder[$sectionKey] ?? 999;
}
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ safeGetTranslation($seo, 'meta_title', app()->getLocale()) ?: 'ABOUT US Coffee & Eatery' }}</title>
    <meta name="description" content="{{ safeGetTranslation($seo, 'meta_description', app()->getLocale()) }}">
    <meta name="keywords" content="{{ safeGetTranslation($seo, 'meta_keywords', app()->getLocale()) }}">
    <meta property="og:title" content="{{ safeGetTranslation($seo, 'og_title', app()->getLocale()) }}">
    <meta property="og:description" content="{{ safeGetTranslation($seo, 'og_description', app()->getLocale()) }}">
    <meta property="og:type" content="business.business">
    <meta property="og:url" content="{{ url('/') }}">
    @if($seo?->og_image)
    <meta property="og:image" content="{{ asset($seo->og_image) }}">
    @endif
    <meta name="robots" content="index, follow">
    <meta name="author" content="ABOUT US Coffee & Eatery">
    <link rel="canonical" href="{{ url('/') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe.min.css">
    <script type="module">
        import PhotoSwipeLightbox
            from 'https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe-lightbox.esm.min.js';

        window.PhotoSwipeLightbox = PhotoSwipeLightbox;
    </script>

    @vite(['resources/css/style.css', 'resources/js/app.js', 'resources/js/script.js'])
</head>
<body>

<div class="loader" id="loader">
    <div class="loader-container">
        <div class="coffee-cup">
            <div class="steam">
                <div class="steam-particle"></div>
                <div class="steam-particle"></div>
                <div class="steam-particle"></div>
            </div>
            <div class="cup">
                <div class="cup-handle"></div>
                <div class="coffee-fill"></div>
            </div>
        </div>
        <div class="loader-text">Brewing...</div>
    </div>
</div>

<!-- Custom cursor removed -->

<!-- Navigation -->
<nav id="navbar">
    <div class="nav-content">
        <ul id="navMenu">
            <li><a href="#story">{{ app()->getLocale() == 'vi' ? 'Câu Chuyện' : 'Story' }}</a></li>
            <li><a href="#menu">{{ app()->getLocale() == 'vi' ? 'Thực Đơn' : 'Menu' }}</a></li>
            <li><a href="#workspace">{{ app()->getLocale() == 'vi' ? 'Không Gian' : 'Workspace' }}</a></li>
            <li><a href="#journey">{{ app()->getLocale() == 'vi' ? 'Quy Trình' : 'Journey' }}</a></li>
            <li><a href="#contact">{{ app()->getLocale() == 'vi' ? 'Liên Hệ' : 'Contact' }}</a></li>
        </ul>
        <div class="language-switcher">
            <a href="{{ route('lang.switch', 'vi') }}" class="{{ app()->getLocale() == 'vi' ? 'active' : '' }}">VI</a>
            <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
@if(shouldShowSection('hero', $visibleSections ?? []))
<section class="hero" id="home" @if($heroSettings?->background_image) style="    background: linear-gradient(135deg, rgba(245, 242, 237, 0.95), rgba(184, 181, 176, 0.95)), url({{ asset('storage/' . $heroSettings?->background_image) }}) center center / cover no-repeat;" @endif>
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
@endif

<!-- Story Section -->
@if(shouldShowSection('story', $visibleSections ?? []))
<section class="story" id="story">
    <h2 class="section-title">{{ app()->getLocale() == 'vi' ? 'CÂU CHUYỆN CỦA CHÚNG TÔI' : 'OUR STORY' }}</h2>
    <div class="story-grid">
        @foreach($stories ?? [] as $story)
        <div class="story-card">
            @if($story->image)
            <div class="story-image">
                <img src="{{ asset('storage/' . $story->image) }}" alt="{{ safeGetTranslation($story, 'title', app()->getLocale()) }}" loading="lazy">
            </div>
            @endif
            <div class="story-content">
                <h3>{{ safeGetTranslation($story, 'title', app()->getLocale()) }}</h3>
                <p>{{ safeGetTranslation($story, 'description', app()->getLocale()) }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Menu Section with Tabs -->
@if(shouldShowSection('menu', $visibleSections ?? []))
<section class="menu" id="menu">
    <h2 class="section-title">{{ app()->getLocale() == 'vi' ? 'THỰC ĐƠN & ĐỒ ĂN' : 'MENU & EATERY' }}</h2>

    <div class="menu-tabs">
        <button class="tab-button active" data-menu="coffee">{{ app()->getLocale() == 'vi' ? 'CÀ PHÊ ĐẶC BIỆT' : 'COFFEE LOVER' }}</button>
        <button class="tab-button" data-menu="vietnamese">{{ app()->getLocale() == 'vi' ? 'CÀ PHÊ VIỆT NAM' : 'VIETNAMESE ROBUSTA' }}</button>
        <button class="tab-button" data-menu="handbrew">{{ app()->getLocale() == 'vi' ? 'PHA CHẢY' : 'HAND BREW' }}</button>
        <button class="tab-button" data-menu="food">{{ app()->getLocale() == 'vi' ? 'ĐỒ ĂN' : 'FOOD' }}</button>
        <button class="tab-button" data-menu="noncoffee">{{ app()->getLocale() == 'vi' ? 'ĐỒ UỐNG KHÁC' : 'NON-COFFEE' }}</button>
    </div>

    <!-- Coffee Lover Menu -->
    <div class="menu-grid" id="coffee-menu">
        @foreach($coffeeMenu ?? [] as $item)
        <div class="menu-card">
            @if($item->image)
            <div class="menu-image">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ safeGetTranslation($item, 'name', app()->getLocale()) }}" loading="lazy">
            </div>
            @endif
            <h3>{{ safeGetTranslation($item, 'name', app()->getLocale()) }}</h3>
            <div class="menu-price">{{ number_format($item->price / 1000) }}K</div>
            <p class="menu-description">{{ safeGetTranslation($item, 'description', app()->getLocale()) }}</p>
        </div>
        @endforeach
    </div>

    <!-- Vietnamese Menu -->
    <div class="menu-grid hidden" id="vietnamese-menu">
        @foreach($vietnameseMenu ?? [] as $item)
        <div class="menu-card">
            @if($item->image)
            <div class="menu-image">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ safeGetTranslation($item, 'name', app()->getLocale()) }}" loading="lazy">
            </div>
            @endif
            <h3>{{ safeGetTranslation($item, 'name', app()->getLocale()) }}</h3>
            <div class="menu-price">{{ number_format($item->price / 1000) }}K</div>
            <p class="menu-description">{{ safeGetTranslation($item, 'description', app()->getLocale()) }}</p>
        </div>
        @endforeach
    </div>

    <!-- Hand Brew Menu -->
    <div class="menu-grid hidden" id="handbrew-menu">
        @foreach($handbrewMenu ?? [] as $item)
        <div class="menu-card">
            @if($item->image)
            <div class="menu-image">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ safeGetTranslation($item, 'name', app()->getLocale()) }}" loading="lazy">
            </div>
            @endif
            <h3>{{ safeGetTranslation($item, 'name', app()->getLocale()) }}</h3>
            <div class="menu-price">{{ number_format($item->price / 1000) }}K</div>
            <p class="menu-description">{{ safeGetTranslation($item, 'description', app()->getLocale()) }}</p>
        </div>
        @endforeach
    </div>

    <!-- Food Menu -->
    <div class="menu-grid hidden" id="food-menu">
        @foreach($foodMenu ?? [] as $item)
        <div class="menu-card">
            @if($item->image)
            <div class="menu-image">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ safeGetTranslation($item, 'name', app()->getLocale()) }}" loading="lazy">
            </div>
            @endif
            <h3>{{ safeGetTranslation($item, 'name', app()->getLocale()) }}</h3>
            <div class="menu-price">{{ number_format($item->price / 1000) }}K</div>
            <p class="menu-description">{{ safeGetTranslation($item, 'description', app()->getLocale()) }}</p>
        </div>
        @endforeach
    </div>

    <!-- Non-Coffee Menu -->
    <div class="menu-grid hidden" id="noncoffee-menu">
        @foreach($nonCoffeeMenu ?? [] as $item)
        <div class="menu-card">
            @if($item->image)
            <div class="menu-image">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ safeGetTranslation($item, 'name', app()->getLocale()) }}" loading="lazy">
            </div>
            @endif
            <h3>{{ safeGetTranslation($item, 'name', app()->getLocale()) }}</h3>
            <div class="menu-price">{{ number_format($item->price / 1000) }}K</div>
            <p class="menu-description">{{ safeGetTranslation($item, 'description', app()->getLocale()) }}</p>
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Workspace Section -->
@if(shouldShowSection('workspace', $visibleSections ?? []))
<section class="workspace" id="workspace">
    <h2 class="section-title">{{ safeGetTranslation($workspace, 'title', app()->getLocale()) ?? (app()->getLocale() == 'vi' ? 'KHÔNG GIAN LÀM VIỆC' : 'WORKSPACE') }}</h2>
    <div class="workspace-content">
        <div class="workspace-text">
            <h3>{{ safeGetTranslation($workspace, 'title', app()->getLocale()) ?? (app()->getLocale() == 'vi' ? 'TẦNG 2 CHỖ NGỒI' : 'SECOND FLOOR SEATING') }}</h3>
            <p>{{ safeGetTranslation($workspace, 'description_1', app()->getLocale()) ?? (app()->getLocale() == 'vi' ? 'Khu vực ngồi đơn giản ở tầng hai. Bàn ghế miễn phí cho bất cứ ai muốn có không gian yên tĩnh hơn để thưởng thức cà phê.' : 'Simple seating area on the second floor. Free tables and chairs for anyone who wants a quieter space to enjoy their coffee.') }}</p>
            @if(safeGetTranslation($workspace, 'description_2', app()->getLocale()))
            <p>{{ safeGetTranslation($workspace, 'description_2', app()->getLocale()) }}</p>
            @endif
            @if(safeGetTranslation($workspace, 'description_3', app()->getLocale()))
            <p>{{ safeGetTranslation($workspace, 'description_3', app()->getLocale()) }}</p>
            @endif
            <div class="workspace-features">
                @if($workspace?->features && is_array(safeGetTranslation($workspace, 'features', app()->getLocale())))
                    @foreach(safeGetTranslation($workspace, 'features', app()->getLocale()) as $feature)
                        <span class="feature-tag">{{ $feature }}</span>
                    @endforeach
                @else
                    <span class="feature-tag">{{ app()->getLocale() == 'vi' ? 'Chỗ ngồi miễn phí' : 'Free Seating' }}</span>
                    <span class="feature-tag">{{ app()->getLocale() == 'vi' ? 'Ánh sáng tự nhiên' : 'Natural Light' }}</span>
                    <span class="feature-tag">{{ app()->getLocale() == 'vi' ? 'Không gian yên tĩnh' : 'Quiet Space' }}</span>
                    <span class="feature-tag">{{ app()->getLocale() == 'vi' ? 'WiFi nhanh' : 'Fast WiFi' }}</span>
                @endif
            </div>
        </div>
        <div class="workspace-visual">
            <div class="floor-diagram">
                <h3>{{ app()->getLocale() == 'vi' ? 'SƠ ĐỒ TẦNG' : 'FLOOR PLAN' }}</h3>
                <div class="floor-level">
                    @if($workspace?->ground_floor_image)
                        <a href="{{ asset('storage/' . $workspace->ground_floor_image) }}" 
                           class="floor-image-link"
                           data-pswp-width="1200" 
                           data-pswp-height="800">
                            <div class="floor-image">
                                <img src="{{ asset('storage/' . $workspace->ground_floor_image) }}" alt="Ground Floor">
                            </div>
                        </a>
                    @endif
                    <h4>{{ safeGetTranslation($workspace, 'ground_floor_title', app()->getLocale()) ?? (app()->getLocale() == 'vi' ? 'TẦNG TRỆT' : 'GROUND FLOOR') }}</h4>
                    <p>{{ safeGetTranslation($workspace, 'ground_floor_description', app()->getLocale()) ?? (app()->getLocale() == 'vi' ? 'Quầy cà phê • Quán ăn' : 'Coffee Bar • Eatery') }}</p>
                </div>
                <div class="floor-level">
                    <div class="speed-sticker">{{ $workspace?->wifi_speed ?? '300mbps' }}</div>
                    @if($workspace?->second_floor_image)
                        <a href="{{ asset('storage/' . $workspace->second_floor_image) }}" 
                           class="floor-image-link"
                           data-pswp-width="1200" 
                           data-pswp-height="800">
                            <div class="floor-image">
                                <img src="{{ asset('storage/' . $workspace->second_floor_image) }}" alt="Second Floor">
                            </div>
                        </a>
                    @endif
                    <h4>{{ safeGetTranslation($workspace, 'second_floor_title', app()->getLocale()) ?? (app()->getLocale() == 'vi' ? 'TẦNG HAI' : 'SECOND FLOOR') }}</h4>
                    <p>{{ safeGetTranslation($workspace, 'second_floor_description', app()->getLocale()) ?? (app()->getLocale() == 'vi' ? 'Bàn lớn • Khu vực yên tĩnh' : 'Large Tables • Quiet Area') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Journey Section -->
@if(shouldShowSection('journey', $visibleSections ?? []))
<section class="journey" id="journey">
    <h2 class="section-title">{{ app()->getLocale() == 'vi' ? 'HÀNH TRÌNH CÀ PHÊ' : 'BEAN TO CUP JOURNEY' }}</h2>
    <div class="journey-container">
        <div class="journey-path">
            @foreach($journeySteps ?? [] as $step)
            <div class="journey-step">
                <div class="journey-number">{{ $step->step_number }}</div>
                @if($step->icon)
                <div class="journey-icon">{{ $step->icon }}</div>
                @endif
                <h3>{{ safeGetTranslation($step, 'title', app()->getLocale()) }}</h3>
                <p>{{ safeGetTranslation($step, 'description', app()->getLocale()) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Events & Community Section -->
@if(shouldShowSection('events', $visibleSections ?? []) && (($events ?? collect())->count() > 0 || ($featuredEvents ?? collect())->count() > 0))
<section class="events-community">
    <h2 class="section-title">{{ app()->getLocale() == 'vi' ? 'SỰ KIỆN & CỘNG ĐỒNG' : 'EVENTS & COMMUNITY' }}</h2>

    <div class="events-grid">
        @foreach($featuredEvents ?? [] as $event)
        <div class="event-card upcoming">
            <div class="event-date">
                <span class="day">{{ $event->date->format('d') }}</span>
                <span class="month">{{ $event->date->format('M') }}</span>
            </div>
            <div class="event-content">
                <h3>{{ safeGetTranslation($event, 'title', app()->getLocale()) }}</h3>
                @if($event->time)
                <p class="event-time">{{ $event->date->format('l') }}, {{ $event->time }}</p>
                @endif
                <p class="event-description">{{ safeGetTranslation($event, 'description', app()->getLocale()) }}</p>
                @if(safeGetTranslation($event, 'location', app()->getLocale()))
                <p class="event-location">{{ safeGetTranslation($event, 'location', app()->getLocale()) }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="community-highlights">
        <h3>{{ app()->getLocale() == 'vi' ? 'THAM GIA CỘNG ĐỒNG' : 'JOIN OUR COMMUNITY' }}</h3>
        <div class="community-stats">
            <div class="stat-item">
                <span class="stat-number">500+</span>
                <span class="stat-label">{{ app()->getLocale() == 'vi' ? 'Tín Đồ Cà Phê' : 'Coffee Lovers' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">24</span>
                <span class="stat-label">{{ app()->getLocale() == 'vi' ? 'Sự Kiện Trong Năm' : 'Events This Year' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" id="ecoCounter">24847</span>
                <span class="stat-label">{{ app()->getLocale() == 'vi' ? 'Ly Cà Phê Đã Phục Vụ' : 'Cups Served' }}</span>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Owner & Masterclasses Section -->
@if(shouldShowSection('team', $visibleSections ?? []) && ($teamMembers ?? collect())->count() > 0)
<section class="owner-section">
    <h2 class="section-title">{{ app()->getLocale() == 'vi' ? 'GẶP GỠ MASTER' : 'MEET THE MASTER' }}</h2>
    @foreach($teamMembers ?? [] as $member)
    <div class="owner-content">
        <div class="owner-info">
            @if($member->image)
            <div class="owner-image">
                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" loading="lazy">
            </div>
            @endif
            <div class="owner-bio">
                <h3>{{ $member->name }}</h3>
                <p class="owner-title">{!! nl2br(e(safeGetTranslation($member, 'title', app()->getLocale()))) !!}</p>
                <p class="owner-description">{!! nl2br(e(safeGetTranslation($member, 'bio', app()->getLocale()))) !!}</p>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endif

<!-- Photo Gallery Section -->
@if(shouldShowSection('gallery', $visibleSections ?? []))
<section class="spaces-gallery">
    <h2 class="section-title">{{ app()->getLocale() == 'vi' ? 'PHÒNG TRƯNG BÀY' : 'GALLERY' }}</h2>

    <!-- PhotoSwipe Gallery -->
    <div id="photo-gallery" class="photo-gallery-grid">
        @if($galleryImages->count() > 0)
            @foreach($galleryImages ?? [] as $image)
            <a href="{{ asset('storage/' . $image->image_path) }}"
               data-pswp-width="1200"
               data-pswp-height="800">
                <img src="{{ $image->thumbnail_path ? asset('storage/' . $image->thumbnail_path) : asset('storage/' . $image->image_path) }}"
                     alt="{{ safeGetTranslation($image, 'alt_text', app()->getLocale()) }}"
                     class="gallery-thumbnail"
                     loading="lazy"/>
            </a>
            @endforeach
        @else
            <!-- Fallback to default gallery images -->
            <a href="{{ asset('gallery/2025-02-25.webp') }}">
                <img src="{{ asset('gallery/2025-02-25.webp') }}" alt="About Us Coffee" class="gallery-thumbnail"/>
            </a>
            <a href="{{ asset('gallery/2025-01-02.webp') }}">
                <img src="{{ asset('gallery/2025-01-02.webp') }}" alt="About Us Coffee" class="gallery-thumbnail"/>
            </a>
            <a href="{{ asset('gallery/2025-01-02 (1).webp') }}">
                <img src="{{ asset('gallery/2025-01-02 (1).webp') }}" alt="About Us Coffee" class="gallery-thumbnail"/>
            </a>
            <a href="{{ asset('gallery/2025-01-08.webp') }}">
                <img src="{{ asset('gallery/2025-01-08.webp') }}" alt="About Us Coffee" class="gallery-thumbnail"/>
            </a>
        @endif
    </div>
</section>
@endif

<!-- Contact Section -->
@if(shouldShowSection('contact', $visibleSections ?? []))
<section class="contact" id="contact">
    <h2 class="section-title">{{ app()->getLocale() == 'vi' ? 'LIÊN HỆ' : 'CONTACT US' }}</h2>
    <div class="contact-grid">
        <div class="contact-form-section">
            <form class="contact-form" id="contactForm" action="{{ route('contact.store') }}" method="POST">
                @csrf
                
                <!-- Honeypot field (hidden) -->
                <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                
                <div class="form-group">
                    <label for="name">{{ app()->getLocale() == 'vi' ? 'TÊN' : 'NAME' }}</label>
                    <input type="text" id="name" name="name" required minlength="2" maxlength="255">
                    <div class="error-message" id="name-error"></div>
                </div>
                <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="email" id="email" name="email" required maxlength="255">
                    <div class="error-message" id="email-error"></div>
                </div>
                <div class="form-group">
                    <label for="message">{{ app()->getLocale() == 'vi' ? 'TIN NHẮN' : 'MESSAGE' }}</label>
                    <textarea id="message" name="message" rows="5" required minlength="10" maxlength="2000"></textarea>
                    <div class="char-counter"><span id="messageLength">0</span>/2000</div>
                    <div class="error-message" id="message-error"></div>
                </div>
                <button type="submit" class="submit-btn" id="submitBtn">
                    <span class="btn-text">{{ app()->getLocale() == 'vi' ? 'GỬI TIN NHẮN' : 'SEND MESSAGE' }}</span>
                    <span class="btn-loading" style="display: none;">{{ app()->getLocale() == 'vi' ? 'Đang gửi...' : 'Sending...' }}</span>
                </button>
                <div class="form-message" id="formMessage" style="display: none;"></div>
            </form>
        </div>

        <div class="contact-map-section">
            <div class="location-info-card">
                <div class="address-icon">📍</div>
                <div class="address-text">
                    <p><strong>About Us Coffee</strong></p>
                    @if($footer)
                    <p>{{ safeGetTranslation($footer, 'address', app()->getLocale()) }}</p>
                    @else
                    <p>09 An Thượng 11, Bắc Mỹ Phú</p>
                    <p>Ngũ Hành Sơn, Đà Nẵng</p>
                    @endif
                </div>
            </div>
            <div class="location-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.336822322012!2d108.2426867!3d16.048002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142174bb33975dd%3A0x59d84445eb111dcc!2sAbout%20Us%20Coffee!5e0!3m2!1sru!2s!4v1756888718966!5m2!1sru!2s"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Footer -->
@if(shouldShowSection('footer', $visibleSections ?? []))
<footer>
    <div class="footer-content">
        <div class="footer-grid">
            <div class="footer-column">
                <h4>{{ app()->getLocale() == 'vi' ? 'ĐỊA CHỈ' : 'LOCATION' }}</h4>
                @if($footer)
                <p>{{ safeGetTranslation($footer, 'address', app()->getLocale()) }}</p>
                <p style="margin-top: 20px;">
                    <strong>{{ app()->getLocale() == 'vi' ? 'Gọi:' : 'Call:' }}</strong> {{ $footer->contact_phone }}<br>
                    <strong>Email:</strong> {{ $footer->contact_email }}<br>
                    <strong>{{ app()->getLocale() == 'vi' ? 'Hàng ngày:' : 'Every day:' }}</strong> {{ safeGetTranslation($footer, 'opening_hours', app()->getLocale()) }}
                </p>
                @else
                <p>09 An Thượng 11</p>
                <p>Bắc Mỹ Phú, Ngũ Hành Sơn</p>
                <p>Đà Nẵng 550000, Vietnam</p>
                <p style="margin-top: 20px;">
                    <strong>{{ app()->getLocale() == 'vi' ? 'Gọi:' : 'Call:' }}</strong> 0866 095 557<br>
                    <strong>Email:</strong> dothanhsang1908@gmail.com<br>
                    <strong>{{ app()->getLocale() == 'vi' ? 'Hàng ngày:' : 'Every day:' }}</strong> 7:30 AM - 9:30 PM
                </p>
                @endif
            </div>
            <div class="footer-column">
                <h4>{{ app()->getLocale() == 'vi' ? 'KẾT NỐI' : 'CONNECT' }}</h4>
                @if($footer && ($footer->social_instagram || $footer->social_facebook))
                @if($footer->social_instagram)<a href="{{ $footer->social_instagram }}">Instagram</a>@endif
                @if($footer->social_facebook)<a href="{{ $footer->social_facebook }}">Facebook</a>@endif
                @else
                <a href="https://www.instagram.com/about_us.coffee/">Instagram</a>
                <a href="https://web.facebook.com/profile.php?id=61569478955284">Facebook</a>
                @endif
            </div>
            <div class="footer-column">
                <h4>{{ app()->getLocale() == 'vi' ? 'TRIẾT LÝ' : 'PHILOSOPHY' }}</h4>
                <p>"{{ app()->getLocale() == 'vi' ? 'Tách cà phê tiếp theo của bạn, Tách cà phê tuyệt vời nhất của bạn.' : 'Your next cup, Your best cup.' }}"</p>
                <p style="margin-top: 20px;">{{ app()->getLocale() == 'vi' ? 'Chúng tôi tin vào văn hóa cà phê chất lượng, hạt cà phê đặc biệt từ nhiều nguồn gốc đa dạng, và tạo ra không gian thoải mái cho mọi người thưởng thức cà phê tuyệt vời.' : 'We believe in quality coffee culture, exceptional beans from diverse origins, and creating comfortable spaces for everyone to enjoy great coffee.' }}</p>
            </div>
        </div>
        <div class="footer-bottom">
            @if($footer)
            <p>{{ safeGetTranslation($footer, 'copyright_text', app()->getLocale()) }}</p>
            @else
            <p>&copy; 2025 ABOUT US Coffee & Eatery | {{ app()->getLocale() == 'vi' ? 'Cà phê chuyên nghiệp & Văn hóa cà phê hiện đại tại Đà Nẵng' : 'Specialty Coffee & Modern Cafe Culture in Da Nang' }}</p>
            @endif
        </div>
    </div>
</footer>
@endif

</body>
</html>
