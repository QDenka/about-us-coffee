<!-- Story Section -->
<section class="story" id="story">
    <h2 class="section-title">{{ app()->getLocale() == 'vi' ? 'CÂU CHUYỆN CỦA CHÚNG TÔI' : 'OUR STORY' }}</h2>
    <div class="story-grid">
        @foreach($stories ?? [] as $story)
        <div class="story-card">
            @if($story->image)
            <div class="story-image">
                <img src="{{ asset('storage/' . $story->image) }}" alt="{{ safeGetTranslation($story, 'title', app()->getLocale()) }} - Our Coffee Story at ABOUT US Coffee Da Nang" loading="lazy">
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