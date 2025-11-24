@extends('layouts.app')

@section('title', 'Home - ESEM')

@push('styles')
<style>
    /* Search Section */
    .search-section {
        background: white;
        padding: 20px 0;
        border-bottom: 1px solid #e5e5e5;
    }

    .search-wrapper {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
    }

    .search-input:focus {
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        cursor: pointer;
    }

    /* Hero Banner dengan Background Image */
    .hero-banner {
        position: relative;
        padding: 80px 0;
        text-align: center;
        color: white;
        overflow: hidden;
        min-height: 400px;
        display: flex;
        align-items: center;
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;

        background-image: url('{{ asset('image/seminar-background.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: brightness(0.7);
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-banner h1 {
        font-size: 48px;
        margin-bottom: 30px;
        line-height: 1.2;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        font-weight: 900;
    }

    .cta-btn {
        background: white;
        color: #14b8a6;
        border: none;
        padding: 15px 40px;
        border-radius: 30px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .cta-btn:hover {
        background: #f0f0f0;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
    }

    /* Navigation Arrow */
    .hero-arrow {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.3);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        z-index: 3;
        border: none;
        color: white;
        font-size: 24px;
        font-weight: bold;
    }

    .hero-arrow:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    /* Menu Options */
    .menu-options {
        padding: 60px 0;
        background: white;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .section-header h2 {
        font-size: 32px;
        color: #1f2937;
    }

    .view-all {
        color: #14b8a6;
        text-decoration: none;
        font-weight: 500;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }

    .event-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        position: relative;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .event-card img {
        width: 100%;
        height: 320px;
        object-fit: cover;
    }

    .card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    }

    .card-btn {
        width: 100%;
        padding: 10px;
        background: #14b8a6;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .card-btn:hover {
        background: #0d9488;
    }

    .card-btn.disabled {
        background: #6b7280;
        cursor: not-allowed;
    }

    /* Recent Events */
    .recent-events {
        padding: 60px 0;
        background: #f9fafb;
    }

    .filter-controls {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        align-items: center;
    }

    .filter-dropdown {
        position: relative;
    }

    .filter-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: white;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        color: #14b8a6;
        font-weight: 500;
    }

    .filter-btn:hover {
        background: #f9fafb;
    }

    .filter-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 5px;
        background: white;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        min-width: 200px;
        z-index: 100;
    }

    .filter-menu.active {
        display: block;
    }

    .filter-menu label {
        display: block;
        padding: 10px 15px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .filter-menu label:hover {
        background: #f3f4f6;
    }

    .filter-menu input[type="checkbox"] {
        margin-right: 8px;
    }

    .search-filter {
        flex: 1;
        max-width: 400px;
    }

    .search-filter input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
    }

    .search-filter input:focus {
        border-color: #14b8a6;
    }

    .events-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .event-item {
        background: white;
        border-radius: 12px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s;
    }

    .event-item:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }

    .event-item.disabled {
        background: #f3f4f6;
        opacity: 0.6;
    }

    .event-thumb {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        object-fit: cover;
    }

    .event-item.disabled .event-thumb {
        filter: grayscale(100%);
    }

    .event-info {
        flex: 1;
    }

    .event-info h3 {
        font-size: 20px;
        color: #14b8a6;
        margin-bottom: 5px;
    }

    .event-time {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .event-title {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 3px;
    }

    .event-location {
        color: #6b7280;
        font-size: 14px;
    }

    .event-actions {
        display: flex;
        gap: 12px;
    }

    .btn-view {
        padding: 10px 24px;
        border: 2px solid #14b8a6;
        background: white;
        color: #14b8a6;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-view:hover {
        background: #ecfdf5;
    }

    .btn-book {
        padding: 10px 24px;
        background: #14b8a6;
        border: none;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-book:hover {
        background: #0d9488;
    }

    .btn-book.disabled {
        background: #d1d5db;
        cursor: not-allowed;
    }

    .hidden {
        display: none !important;
    }

    @media (max-width: 768px) {
        .hero-banner h1 {
            font-size: 32px;
        }

        .cta-btn {
            padding: 12px 30px;
            font-size: 16px;
        }

        .hero-arrow {
            width: 40px;
            height: 40px;
            right: 15px;
            font-size: 20px;
        }

        .cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .event-item {
            flex-direction: column;
            text-align: center;
        }

        .event-actions {
            flex-direction: column;
            width: 100%;
        }

        .filter-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .search-filter {
            max-width: 100%;
        }
    }
</style>
@endpush

@section('content')
    <!-- Search Section -->
    <div class="search-section">
        <div class="container">
            <div class="search-filter">
                <input type="text" id="eventSearch" placeholder="Search events...">
                <span class="search-icon">🔍</span>
            </div>
        </div>
    </div>
    <!-- Hero Banner -->
    <section class="hero-banner">
        <div class="container hero-content">
            <h1>Get more benefit now!<br>with Seminar !!</h1>
        </div>
        <!-- <button class="hero-arrow">›</button> -->
    </section>

    <!-- Menu Options -->
    <section class="menu-options">
        <div class="container">
            <div class="section-header">
                <h2>Menu Options</h2>
                <a href="#" class="view-all">View All</a>
            </div>
            <div class="cards-grid">
                <div class="event-card">
                    <img src="/image/image1.png" alt="Sharing Session">
                    <div class="card-overlay">
                        <button class="card-btn">Register Now</button>
                    </div>
                </div>
                <div class="event-card">
                    <img src="/image/image2.png" alt="Tech Fair">
                    <div class="card-overlay">
                        <button class="card-btn">Register Now</button>
                    </div>
                </div>
                <div class="event-card">
                    <img src="/image/image3.png" alt="AI Forum">
                    <div class="card-overlay">
                        <button class="card-btn disabled">Coming Soon</button>
                    </div>
                </div>
                <div class="event-card">
                    <img src="/image/image4.png" alt="Champions">
                    <div class="card-overlay">
                        <button class="card-btn disabled">Coming Soon</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Events -->
    <section class="recent-events">
        <div class="container">
            <div class="section-header">
                <h2>We Recent Events</h2>
                <div class="filter-controls">
                    <div class="search-filter">
                        <input type="text" id="eventSearch" placeholder="Search events...">
                    </div>
                    <div class="filter-dropdown">
                        <button class="filter-btn" id="filterBtn">
                            <span>🔽</span>
                            <span>Filter</span>
                        </button>
                        <div class="filter-menu" id="filterMenu">
                            <label>
                                <input type="checkbox" value="seminar" class="filter-checkbox"> Seminar
                            </label>
                            <label>
                                <input type="checkbox" value="workshop" class="filter-checkbox"> Workshop
                            </label>
                            <label>
                                <input type="checkbox" value="malang" class="filter-checkbox"> Kota Malang
                            </label>
                            <label>
                                <input type="checkbox" value="surabaya" class="filter-checkbox"> Kota Surabaya
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="events-list" id="eventsList">
                <div class="event-item" data-type="seminar" data-city="malang" data-title="Seminar About Musical - Sunday">
                    <img src="/image/image1.png" alt="Event" class="event-thumb">
                    <div class="event-info">
                        <h3>Aug 13</h3>
                        <p class="event-time">Sun • 10:00am</p>
                        <p class="event-title">Seminar About Musical - Sunday</p>
                        <p class="event-location">Sawojajar, Kota Malang</p>
                    </div>
                    <div class="event-actions">
                        <button class="btn-view">View Details</button>
                        <button class="btn-book">Book Now</button>
                    </div>
                </div>

                <div class="event-item" data-type="seminar" data-city="surabaya" data-title="Personality Seminar">
                    <img src="/image/image2.png" alt="Event" class="event-thumb">
                    <div class="event-info">
                        <h3>Aug 13</h3>
                        <p class="event-time">Sun • 11:00am</p>
                        <p class="event-title">Personality Seminar</p>
                        <p class="event-location">Ayani, Kota Surabaya</p>
                    </div>
                    <div class="event-actions">
                        <button class="btn-view">View Details</button>
                        <button class="btn-book">Book Now</button>
                    </div>
                </div>

                <div class="event-item" data-type="seminar" data-city="malang" data-title="Seminar Kerohanian">
                    <img src="/image/image3.png" alt="Event" class="event-thumb">
                    <div class="event-info">
                        <h3>Aug 13</h3>
                        <p class="event-time">Sun • 11:00am</p>
                        <p class="event-title">Seminar Kerohanian</p>
                        <p class="event-location">Sukun, Kota Malang</p>
                    </div>
                    <div class="event-actions">
                        <button class="btn-view">View Details</button>
                        <button class="btn-book">Book Now</button>
                    </div>
                </div>

                <div class="event-item disabled" data-type="seminar" data-city="surabaya" data-title="Seminar Confident">
                    <img src="/image/image4.png" alt="Event" class="event-thumb">
                    <div class="event-info">
                        <h3>Aug 13</h3>
                        <p class="event-time">Sun • 10:00am</p>
                        <p class="event-title">Seminar Confident</p>
                        <p class="event-location">Ayani, Kota Surabaya</p>
                    </div>
                    <div class="event-actions">
                        <button class="btn-book disabled">Show More</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Filter dropdown toggle
    const filterBtn = document.getElementById('filterBtn');
    const filterMenu = document.getElementById('filterMenu');

    filterBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        filterMenu.classList.toggle('active');
    });

    document.addEventListener('click', () => {
        filterMenu.classList.remove('active');
    });

    filterMenu.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // Filter and search functionality
    const searchInput = document.getElementById('eventSearch');
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    const eventItems = document.querySelectorAll('.event-item');

    function filterEvents() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedFilters = {
            type: [],
            city: []
        };

        filterCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                if (checkbox.value === 'seminar' || checkbox.value === 'workshop') {
                    selectedFilters.type.push(checkbox.value);
                } else {
                    selectedFilters.city.push(checkbox.value);
                }
            }
        });

        eventItems.forEach(item => {
            const title = item.dataset.title.toLowerCase();
            const type = item.dataset.type;
            const city = item.dataset.city;

            const matchesSearch = title.includes(searchTerm);
            const matchesType = selectedFilters.type.length === 0 || selectedFilters.type.includes(type);
            const matchesCity = selectedFilters.city.length === 0 || selectedFilters.city.includes(city);

            if (matchesSearch && matchesType && matchesCity) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    }

    searchInput.addEventListener('input', filterEvents);
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterEvents);
    });
</script>
@endpush