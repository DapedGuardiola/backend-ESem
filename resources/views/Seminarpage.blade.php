@extends('layouts.app')

@section('title', 'Seminars - ESEM')

@push('styles')
<style>
    .seminar-page {
        background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #f0f9ff 100%);
        min-height: 100vh;
    }

    /* Hero Section */
    .seminar-hero {
        position: relative;
        padding: 100px 0 80px;
        text-align: center;
        overflow: hidden;
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
    }

    .seminar-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('/image/seminar-background.png') center/cover;
        opacity: 0.1;
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
        animation: fadeInUp 0.8s ease;
    }

    .hero-content h1 {
        font-size: 48px;
        color: white;
        margin-bottom: 20px;
        font-weight: 900;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        letter-spacing: -0.5px;
    }

    .hero-content p {
        font-size: 20px;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .stats-row {
        display: flex;
        justify-content: center;
        gap: 60px;
        margin-top: 50px;
    }

    .stat-item {
        text-align: center;
        animation: fadeInUp 1s ease;
    }

    .stat-number {
        font-size: 48px;
        font-weight: 900;
        color: white;
        display: block;
        margin-bottom: 8px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    }

    .stat-label {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
    }

    /* Filters Section */
    .filters-section {
        padding: 40px 0 30px;
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .filters-container {
        display: flex;
        gap: 20px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        min-width: 300px;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 14px 50px 14px 50px;
        border: 2px solid #e5e7eb;
        border-radius: 14px;
        font-size: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .search-input:focus {
        border-color: #14b8a6;
        outline: none;
        box-shadow: 0 4px 16px rgba(20, 184, 166, 0.15);
    }

    .search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #9ca3af;
    }

    .clear-search {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #9ca3af;
        cursor: pointer;
        display: none;
        transition: all 0.2s;
    }

    .clear-search:hover {
        color: #14b8a6;
        transform: translateY(-50%) scale(1.2);
    }

    .filter-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 12px 24px;
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        color: #6b7280;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-btn:hover {
        border-color: #14b8a6;
        color: #14b8a6;
        background: #f0fdfa;
        transform: translateY(-2px);
    }

    .filter-btn.active {
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        color: white;
        border-color: #14b8a6;
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
    }

    .filter-btn .emoji {
        font-size: 18px;
    }

    /* Seminars Grid */
    .seminars-section {
        padding: 60px 0;
    }

    .section-title {
        font-size: 32px;
        color: #1f2937;
        margin-bottom: 15px;
        font-weight: 700;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #14b8a6, #0d9488);
        border-radius: 2px;
    }

    .section-subtitle {
        color: #6b7280;
        font-size: 16px;
        margin-bottom: 40px;
    }

    .seminars-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .seminar-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 2px solid transparent;
        animation: fadeInUp 0.6s ease;
    }

    .seminar-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(20, 184, 166, 0.15);
        border-color: #14b8a6;
    }

    .seminar-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.4s ease;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    }

    .seminar-card:hover .seminar-image {
        transform: scale(1.08);
    }

    .seminar-content {
        padding: 25px;
    }

    .seminar-badge {
        display: inline-block;
        padding: 6px 14px;
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        color: #14b8a6;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 15px;
        border: 1px solid #a7f3d0;
    }

    .seminar-date {
        font-size: 28px;
        font-weight: 900;
        color: #14b8a6;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .seminar-title {
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 12px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .seminar-meta {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
    }

    .meta-row {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6b7280;
        font-size: 14px;
    }

    .meta-icon {
        font-size: 16px;
        flex-shrink: 0;
    }

    .seminar-price {
        font-size: 24px;
        font-weight: 900;
        color: #14b8a6;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .price-label {
        font-size: 14px;
        color: #6b7280;
        font-weight: 500;
    }

    .seminar-actions {
        display: flex;
        gap: 12px;
    }

    .btn-detail {
        flex: 1;
        padding: 12px;
        background: white;
        border: 2px solid #14b8a6;
        color: #14b8a6;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-detail:hover {
        background: #f0fdfa;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
    }

    .btn-register {
        flex: 1;
        padding: 12px;
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        border: none;
        color: white;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(20, 184, 166, 0.4);
    }

    .btn-register.disabled,
    .btn-detail.disabled {
        background: #e5e7eb;
        color: #9ca3af;
        border-color: #e5e7eb;
        cursor: not-allowed;
        box-shadow: none;
    }

    .btn-register.disabled:hover,
    .btn-detail.disabled:hover {
        transform: none;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        animation: fadeIn 0.6s ease;
    }

    .empty-state-icon {
        font-size: 80px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 24px;
        color: #1f2937;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 16px;
    }

    /* Loading State */
    .loading-skeleton {
        animation: pulse 1.5s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Category Tags */
    .category-filters {
        display: flex;
        gap: 10px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .category-tag {
        padding: 8px 18px;
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .category-tag:hover {
        border-color: #14b8a6;
        color: #14b8a6;
        background: #f0fdfa;
    }

    .category-tag.active {
        background: #14b8a6;
        color: white;
        border-color: #14b8a6;
    }

    /* Responsive */
    @media (max-width: 968px) {
        .seminars-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        
        .stats-row {
            gap: 40px;
        }
    }

    @media (max-width: 768px) {
        .seminar-hero {
            padding: 60px 0 50px;
        }

        .hero-content h1 {
            font-size: 32px;
        }

        .hero-content p {
            font-size: 16px;
        }

        .stats-row {
            flex-direction: column;
            gap: 30px;
        }

        .filters-container {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            min-width: 100%;
        }

        .filter-group {
            justify-content: center;
        }

        .seminars-grid {
            grid-template-columns: 1fr;
        }

        .seminar-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="seminar-page">
    <!-- Hero Section -->
    <section class="seminar-hero">
        <div class="container">
            <div class="hero-content">
                <h1>🎓 Discover Amazing Seminars</h1>
                <p>Expand your knowledge with industry experts and thought leaders from various fields</p>
                
                <div class="stats-row">
                    <div class="stat-item">
                        <span class="stat-number">{{ $totalSeminars ?? 50 }}+</span>
                        <span class="stat-label">Active Seminars</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $totalParticipants ?? 1200 }}+</span>
                        <span class="stat-label">Participants</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $totalSpeakers ?? 80 }}+</span>
                        <span class="stat-label">Expert Speakers</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="filters-section">
        <div class="container">
            <div class="filters-container">
                <div class="search-box">
                    <span class="search-icon">🔍</span>
                    <input type="text" class="search-input" id="seminarSearch" placeholder="Search seminars by title, speaker, or topic...">
                    <span class="clear-search" id="clearSeminarSearch">✕</span>
                </div>
                
                <div class="filter-group">
                    <button class="filter-btn active" data-filter="all">
                        <span class="emoji">📚</span>
                        <span>All Seminars</span>
                    </button>
                    <button class="filter-btn" data-filter="upcoming">
                        <span class="emoji">🔜</span>
                        <span>Upcoming</span>
                    </button>
                    <button class="filter-btn" data-filter="register-open">
                        <span class="emoji">✅</span>
                        <span>Open Registration</span>
                    </button>
                    <button class="filter-btn" data-filter="free">
                        <span class="emoji">🆓</span>
                        <span>Free</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Seminars Grid -->
    <section class="seminars-section">
        <div class="container">
            <h2 class="section-title">Available Seminars</h2>
            <p class="section-subtitle">Browse through our collection of seminars and find the perfect one for you</p>

            <div class="seminars-grid" id="seminarsGrid">
                @forelse($seminars ?? [] as $seminar)
                    <div class="seminar-card" 
                         data-title="{{ strtolower($seminar->event_name) }}" 
                         data-speaker="{{ strtolower($seminar->eventDetail->event_speaker ?? '') }}"
                         data-status="{{ $seminar->registration_status }}"
                         data-price="{{ $seminar->eventDetail->cost ?? 0 }}">
                        
                        <img src="{{ asset('image/event' . (($loop->index % 4) + 1) . '.png') }}" 
                             alt="{{ $seminar->event_name }}" 
                             class="seminar-image"
                             onerror="this.src='https://via.placeholder.com/400x220/14b8a6/ffffff?text=Seminar'">
                        
                        <div class="seminar-content">
                            <span class="seminar-badge">
                                {{ $seminar->eventDetail->paid_status ? '💳 Paid Event' : '🆓 Free Event' }}
                            </span>
                            
                            <div class="seminar-date">
                                📅 {{ \Carbon\Carbon::parse($seminar->eventDetail->date)->format('M d, Y') }}
                            </div>
                            
                            <h3 class="seminar-title">{{ $seminar->event_name }}</h3>
                            
                            <div class="seminar-meta">
                                <div class="meta-row">
                                    <span class="meta-icon">🕐</span>
                                    <span>{{ \Carbon\Carbon::parse($seminar->eventDetail->date)->format('l, h:i A') }}</span>
                                </div>
                                <div class="meta-row">
                                    <span class="meta-icon">📍</span>
                                    <span>{{ $seminar->eventDetail->event_address }}</span>
                                </div>
                                <div class="meta-row">
                                    <span class="meta-icon">🎤</span>
                                    <span>{{ $seminar->eventDetail->event_speaker }}</span>
                                </div>
                            </div>
                            
                            <div class="seminar-price">
                                @if($seminar->eventDetail->paid_status)
                                    <span class="price-label">Price:</span>
                                    Rp {{ number_format($seminar->eventDetail->cost, 0, ',', '.') }}
                                @else
                                    <span style="color: #10b981; font-size: 20px;">🎉 FREE</span>
                                @endif
                            </div>
                            
                            <div class="seminar-actions">
                                <button class="btn-detail show-detail" 
                                        data-title="{{ $seminar->event_name }}"
                                        data-date="{{ \Carbon\Carbon::parse($seminar->eventDetail->date)->format('M d, Y') }}"
                                        data-time="{{ \Carbon\Carbon::parse($seminar->eventDetail->date)->format('l, h:i A') }}"
                                        data-location="{{ $seminar->eventDetail->event_address }}"
                                        data-speaker="{{ $seminar->eventDetail->event_speaker }}"
                                        data-price="{{ $seminar->eventDetail->paid_status ? 'Rp ' . number_format($seminar->eventDetail->cost, 0, ',', '.') : 'FREE' }}"
                                        data-description="{{ $seminar->eventDetail->event_description }}">
                                    View Details
                                </button>
                                
                                @if($seminar->registration_status == 'open')
                                    <a href="{{ route('event.booking', ['eventId' => $seminar->event_id]) }}" class="btn-register">
                                        Register Now
                                    </a>
                                @elseif($seminar->registration_status == 'coming_soon')
                                    <button class="btn-register disabled">
                                        Coming Soon
                                    </button>
                                @else
                                    <button class="btn-register disabled">
                                        Registration Closed
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <h3>No Seminars Found</h3>
                        <p>Check back later for upcoming events</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('seminarSearch');
    const clearSearch = document.getElementById('clearSeminarSearch');
    const seminarCards = document.querySelectorAll('.seminar-card');
    const filterBtns = document.querySelectorAll('.filter-btn');
    
    let currentFilter = 'all';
    
    // Search input handler
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        clearSearch.style.display = searchTerm ? 'block' : 'none';
        filterSeminars();
    });
    
    // Clear search
    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        filterSeminars();
    });
    
    // Filter buttons
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentFilter = this.dataset.filter;
            filterSeminars();
        });
    });
    
    // Filter seminars function
    function filterSeminars() {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;
        
        seminarCards.forEach(card => {
            const title = card.dataset.title || '';
            const speaker = card.dataset.speaker || '';
            const status = card.dataset.status || '';
            const price = parseInt(card.dataset.price) || 0;
            
            // Search filter
            const matchesSearch = title.includes(searchTerm) || speaker.includes(searchTerm);
            
            // Category filter
            let matchesFilter = true;
            if (currentFilter === 'upcoming') {
                matchesFilter = status === 'open' || status === 'coming_soon';
            } else if (currentFilter === 'register-open') {
                matchesFilter = status === 'open';
            } else if (currentFilter === 'free') {
                matchesFilter = price === 0;
            }
            
            // Show/hide card
            if (matchesSearch && matchesFilter) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Show empty state if no results
        const seminarsGrid = document.getElementById('seminarsGrid');
        const existingEmptyState = seminarsGrid.querySelector('.empty-state');
        
        if (visibleCount === 0 && !existingEmptyState) {
            const emptyState = document.createElement('div');
            emptyState.className = 'empty-state';
            emptyState.innerHTML = `
                <div class="empty-state-icon">🔍</div>
                <h3>No Seminars Found</h3>
                <p>Try adjusting your search or filters</p>
            `;
            seminarsGrid.appendChild(emptyState);
        } else if (visibleCount > 0 && existingEmptyState) {
            existingEmptyState.remove();
        }
    }
    
    // Show detail modal (reuse existing modal from layout)
    const detailBtns = document.querySelectorAll('.show-detail');
    const modal = document.getElementById('eventModal');
    
    if (modal) {
        detailBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('modalEventTitle').textContent = this.dataset.title;
                document.getElementById('modalEventDate').textContent = this.dataset.date;
                document.getElementById('modalEventTime').textContent = this.dataset.time;
                document.getElementById('modalEventLocation').textContent = this.dataset.location;
                document.getElementById('modalEventType').textContent = 'Seminar';
                document.getElementById('modalEventSpeaker').textContent = this.dataset.speaker;
                document.getElementById('modalEventPrice').textContent = this.dataset.price;
                document.getElementById('modalEventDescription').textContent = this.dataset.description;
                
                // Update book now link
                const bookLink = this.parentElement.querySelector('.btn-register');
                if (bookLink && !bookLink.classList.contains('disabled')) {
                    document.getElementById('modalBookNowLink').href = bookLink.href;
                    document.getElementById('modalBookNowLink').style.display = 'inline-block';
                } else {
                    document.getElementById('modalBookNowLink').style.display = 'none';
                }
                
                modal.classList.add('active');
            });
        });
        
        // Close modal
        const closeBtn = modal.querySelector('.close-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                modal.classList.remove('active');
            });
        }
        
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    }
});
</script>
@endpush