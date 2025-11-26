@extends('layouts.app')

@section('title', 'Home - ESEM')

@push('styles')
<style>
    /* Enhanced Search Section */
    .search-section {
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        padding: 40px 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .search-wrapper {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
    }

    .search-container {
        background: white;
        border-radius: 50px;
        padding: 8px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s;
    }

    .search-container:hover {
        box-shadow: 0 12px 40px rgba(0,0,0,0.2);
        transform: translateY(-2px);
    }

    .search-container:focus-within {
        box-shadow: 0 12px 40px rgba(20, 184, 166, 0.3);
        transform: translateY(-2px);
    }

    .search-icon-left {
        padding-left: 20px;
        color: #14b8a6;
        font-size: 20px;
    }

    .search-input {
        flex: 1;
        border: none;
        outline: none;
        padding: 12px 10px;
        font-size: 16px;
        color: #1f2937;
        background: transparent;
    }

    .search-input::placeholder {
        color: #9ca3af;
    }

    .search-btn {
        background: #14b8a6;
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 40px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-btn:hover {
        background: #0d9488;
        transform: scale(1.05);
    }

    .search-btn:active {
        transform: scale(0.98);
    }

    /* Hero Banner */
    .hero-banner {
        position: relative;
        padding: 80px 0;
        text-align: center;
        color: white;
        overflow: hidden;
        min-height: 400px;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('/image/seminar-background.png');
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
        position: relative;
        padding-bottom: 10px;
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: #14b8a6;
        border-radius: 2px;
    }

    .view-all {
        color: #14b8a6;
        text-decoration: none;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 20px;
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .view-all:hover {
        background: #ecfdf5;
        border-color: #14b8a6;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }

    .event-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.4s;
        position: relative;
    }

    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }

    .event-card img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        background: #f3f4f6;
        transition: transform 0.4s;
    }

    .event-card:hover img {
        transform: scale(1.05);
    }

    .card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    }

    .card-btn {
        width: 100%;
        padding: 12px;
        background: #14b8a6;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
    }

    .card-btn:hover {
        background: #0d9488;
        transform: scale(1.03);
    }

    .card-btn.disabled {
        background: #6b7280;
        cursor: not-allowed;
    }

    /* Enhanced Recent Events Section */
    .recent-events {
        padding: 60px 0;
        background: #f9fafb;
    }

    .filter-controls {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-dropdown {
        position: relative;
    }

    .filter-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: white;
        border: 2px solid #14b8a6;
        border-radius: 12px;
        cursor: pointer;
        font-size: 14px;
        color: #14b8a6;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .filter-btn:hover {
        background: #ecfdf5;
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.15);
        transform: translateY(-2px);
    }

    .filter-btn .emoji {
        font-size: 16px;
        transition: transform 0.3s;
    }

    .filter-btn.active .emoji {
        transform: rotate(180deg);
    }

    .filter-menu {
        display: none;
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        min-width: 220px;
        z-index: 100;
        overflow: hidden;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .filter-menu.active {
        display: block;
    }

    .filter-menu label {
        display: flex;
        align-items: center;
        padding: 12px 18px;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
        color: #1f2937;
    }

    .filter-menu label:hover {
        background: #f3f4f6;
        padding-left: 22px;
    }

    .filter-menu input[type="checkbox"] {
        margin-right: 12px;
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #14b8a6;
    }

    .filter-tags {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-tag {
        background: #14b8a6;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .filter-tag .remove {
        cursor: pointer;
        font-weight: bold;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .filter-tag .remove:hover {
        opacity: 1;
    }

    .search-filter {
        flex: 1;
        max-width: 450px;
        position: relative;
    }

    .search-filter-input {
        width: 100%;
        padding: 12px 45px 12px 45px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .search-filter-input:focus {
        border-color: #14b8a6;
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.15);
    }

    .search-filter .icon-left {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #9ca3af;
    }

    .search-filter .icon-right {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        color: #9ca3af;
        cursor: pointer;
        transition: all 0.2s;
    }

    .search-filter .icon-right:hover {
        color: #14b8a6;
        transform: translateY(-50%) scale(1.2);
    }

    .events-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .event-item {
        background: white;
        border-radius: 16px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .event-item:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        border-color: #14b8a6;
        transform: translateX(5px);
    }

    .event-item.disabled {
        background: #f3f4f6;
        opacity: 0.6;
    }

    .event-thumb {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        object-fit: cover;
        background: #f3f4f6;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .event-item.disabled .event-thumb {
        filter: grayscale(100%);
    }

    .event-info {
        flex: 1;
    }

    .event-info h3 {
        font-size: 22px;
        color: #14b8a6;
        margin-bottom: 5px;
        font-weight: 700;
    }

    .event-time {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .event-title {
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .event-location {
        color: #6b7280;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .event-actions {
        display: flex;
        gap: 12px;
    }

    .btn-view {
        padding: 12px 28px;
        border: 2px solid #14b8a6;
        background: white;
        color: #14b8a6;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
    }

    .btn-view:hover {
        background: #ecfdf5;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
    }

    .btn-book {
        padding: 12px 28px;
        background: #14b8a6;
        border: none;
        color: white;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
    }

    .btn-book:hover {
        background: #0d9488;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
    }

    .btn-book.disabled {
        background: #d1d5db;
        cursor: not-allowed;
    }

    .hidden {
        display: none !important;
    }

    /* Smooth Animations */
    .event-item {
        animation: fadeInUp 0.5s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .search-container {
            flex-direction: column;
            border-radius: 20px;
            padding: 15px;
        }

        .search-btn {
            width: 100%;
            justify-content: center;
        }

        .hero-banner h1 {
            font-size: 32px;
        }

        .cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .event-item {
            flex-direction: column;
            text-align: center;
        }

        .event-thumb {
            width: 100%;
            height: 200px;
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
    <!-- Enhanced Search Section -->
    <div class="search-section">
        <div class="container">
            <div class="search-wrapper">
                <div class="search-container">
                    <span class="search-icon-left">🔍</span>
                    <input type="text" class="search-input" id="mainSearch" placeholder="Search for events, seminars, workshops...">
                    <button class="search-btn">
                        <span>Search</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Hero Banner -->
    <section class="hero-banner">
        <div class="container hero-content">
            <h1>Get more benefit now!<br>with Seminar !!</h1>
        </div>
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
                    <img src="/image/image1.png" alt="Sharing Session" onerror="this.src='https://via.placeholder.com/400x320/14b8a6/ffffff?text=Sharing+Session'">
                    <div class="card-overlay">
                        <button class="card-btn">Register Now</button>
                    </div>
                </div>
                <div class="event-card">
                    <img src="/image/image2.png" alt="Tech Fair" onerror="this.src='https://via.placeholder.com/400x320/14b8a6/ffffff?text=Tech+Fair'">
                    <div class="card-overlay">
                        <button class="card-btn">Register Now</button>
                    </div>
                </div>
                <div class="event-card">
                    <img src="/image/image3.png" alt="AI Forum" onerror="this.src='https://via.placeholder.com/400x320/6b7280/ffffff?text=AI+Forum'">
                    <div class="card-overlay">
                        <button class="card-btn disabled">Coming Soon</button>
                    </div>
                </div>
                <div class="event-card">
                    <img src="/image/image4.png" alt="Champions" onerror="this.src='https://via.placeholder.com/400x320/6b7280/ffffff?text=Champions'">
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
            </div>
            
            <div class="filter-controls">
                <div class="search-filter">
                    <span class="icon-left">🔍</span>
                    <input type="text" class="search-filter-input" id="eventSearch" placeholder="Search events...">
                    <span class="icon-right" id="clearSearch">✕</span>
                </div>
                
                <div class="filter-dropdown">
                    <button class="filter-btn" id="filterBtn">
                        <span class="emoji">🔽</span>
                        <span>Filter Events</span>
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

                <div class="filter-tags" id="filterTags"></div>
            </div>

           <div class="events-list" id="eventsList">

    <div class="event-item" 
         data-type="seminar" 
         data-city="malang" 
         data-title="Seminar About Musical - Sunday"
         data-speaker="A.R. Rahman"
         data-price="Rp 50.000"
         data-description="Seminar ini akan membahas sejarah, perkembangan, dan teknik dasar pementasan musikal Broadway dan lokal. Cocok untuk calon artis, seniman, dan penggemar teater. Pembahasan meliputi: Seni Vokal Musikal, Koreografi Panggung, dan Penyutradaraan Kreatif.">
        <img src="/image/image1.png" alt="Event" class="event-thumb" onerror="this.src='https://via.placeholder.com/120x120/14b8a6/ffffff?text=Event'">
        <div class="event-info">
            <h3>Aug 13</h3>
            <p class="event-time">🕐 Sun • 10:00am</p>
            <p class="event-title">Seminar About Musical - Sunday</p>
            <p class="event-location">📍 Sawojajar, Kota Malang</p>
        </div>
        <div class="event-actions">
            <button class="btn-view">View Details</button>
            <button class="btn-book">Book Now</button>
        </div>
    </div>

    <div class="event-item" 
         data-type="seminar" 
         data-city="surabaya" 
         data-title="Personality Seminar"
         data-speaker="Dr. Maya Sari, M.Psi"
         data-price="Gratis"
         data-description="Workshop intensif 4 jam untuk mengasah keterampilan komunikasi non-verbal dan membangun kepercayaan diri (self-confidence) di lingkungan profesional. Dapatkan tips praktis untuk wawancara kerja, negosiasi, dan presentasi publik yang efektif.">
        <img src="/image/image2.png" alt="Event" class="event-thumb" onerror="this.src='https://via.placeholder.com/120x120/14b8a6/ffffff?text=Event'">
        <div class="event-info">
            <h3>Aug 13</h3>
            <p class="event-time">🕐 Sun • 11:00am</p>
            <p class="event-title">Personality Seminar</p>
            <p class="event-location">📍 Ayani, Kota Surabaya</p>
        </div>
        <div class="event-actions">
            <button class="btn-view">View Details</button>
            <button class="btn-book">Book Now</button>
        </div>
    </div>

    <div class="event-item" 
         data-type="seminar" 
         data-city="malang" 
         data-title="Seminar Kerohanian"
         data-speaker="Ustadz Hanan Attaki"
         data-price="Donasi Sukarela"
         data-description="Sebuah sesi tausiyah yang menenangkan hati, membahas pentingnya keseimbangan spiritual di tengah kesibukan duniawi. Tema kali ini: 'Mencari Ketenangan di Tengah Badai Kehidupan'. Terbuka untuk umum.">
        <img src="/image/image3.png" alt="Event" class="event-thumb" onerror="this.src='https://via.placeholder.com/120x120/14b8a6/ffffff?text=Event'">
        <div class="event-info">
            <h3>Aug 13</h3>
            <p class="event-time">🕐 Sun • 11:00am</p>
            <p class="event-title">Seminar Kerohanian</p>
            <p class="event-location">📍 Sukun, Kota Malang</p>
        </div>
        <div class="event-actions">
            <button class="btn-view">View Details</button>
            <button class="btn-book">Book Now</button>
        </div>
    </div>

    <div class="event-item disabled" 
         data-type="seminar" 
         data-city="surabaya" 
         data-title="Seminar Confident"
         data-speaker="Joko Susilo"
         data-price="Rp 75.000"
         data-description="Sesi pelatihan mengenai cara memaksimalkan potensi diri dan tampil percaya diri dalam setiap situasi, baik personal maupun profesional. **Event sudah penuh.**">
        <img src="/image/image4.png" alt="Event" class="event-thumb" onerror="this.src='https://via.placeholder.com/120x120/6b7280/ffffff?text=Event'">
        <div class="event-info">
            <h3>Aug 13</h3>
            <p class="event-time">🕐 Sun • 10:00am</p>
            <p class="event-title">Seminar Confident</p>
            <p class="event-location">📍 Ayani, Kota Surabaya</p>
        </div>
        <div class="event-actions">
            <button class="btn-book disabled">Show More</button>
        </div>
    </div>
</div>
        
    </section>
@endsection

@push('scripts')
<script>
    // Inisialisasi Elemen
    const searchInput = document.getElementById('eventSearch');
    const mainSearch = document.getElementById('mainSearch');
    const clearSearch = document.getElementById('clearSearch');
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    const eventItems = document.querySelectorAll('.event-item'); // Digunakan untuk fungsi filter
    const filterTags = document.getElementById('filterTags');
    const eventItemsList = document.getElementById('eventsList');
    
    // Elemen Modal
    const eventModal = document.getElementById('eventModal');
    const closeBtn = eventModal ? eventModal.querySelector('.close-btn') : null;
    
    // --- 1. Logika Toggle Dropdown Filter (Sudah Ada) ---
    const filterBtn = document.getElementById('filterBtn');
    const filterMenu = document.getElementById('filterMenu');

    if (filterBtn && filterMenu) {
        filterBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            filterMenu.classList.toggle('active');
            filterBtn.classList.toggle('active');
        });

        document.addEventListener('click', () => {
            filterMenu.classList.remove('active');
            filterBtn.classList.remove('active');
        });

        filterMenu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }

    // --- 2. Logika Search dan Filter Tags (Sudah Ada) ---

    // Clear search button
    if (clearSearch && searchInput) {
        clearSearch.addEventListener('click', () => {
            searchInput.value = '';
            filterEvents();
        });

        searchInput.addEventListener('input', () => {
            clearSearch.style.display = searchInput.value ? 'block' : 'none';
            // Panggil filterEvents saat input berubah
            filterEvents(); 
        });
    }

    // Sync main search with filter search
    if (mainSearch && searchInput) {
        mainSearch.addEventListener('input', () => {
            searchInput.value = mainSearch.value;
            filterEvents();
        });
    }

    function updateFilterTags() {
        if (!filterTags) return;
        
        filterTags.innerHTML = '';
        
        filterCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const tag = document.createElement('div');
                tag.className = 'filter-tag';
                tag.innerHTML = `
                    ${checkbox.value}
                    <span class="remove" data-value="${checkbox.value}">✕</span>
                `;
                filterTags.appendChild(tag);
            }
        });

        // Add click handlers to remove tags
        document.querySelectorAll('.filter-tag .remove').forEach(btn => {
            btn.addEventListener('click', () => {
                const value = btn.dataset.value;
                const checkbox = Array.from(filterCheckboxes).find(cb => cb.value === value);
                if (checkbox) {
                    checkbox.checked = false;
                    updateFilterTags();
                    filterEvents();
                }
            });
        });
    }

    // Listener untuk filter checkboxes
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            updateFilterTags();
            filterEvents();
        });
    });

    // --- 3. Fungsi Filter Events (Diisi) ---

    function filterEvents() {
        if (!searchInput) return;

        const searchTerm = searchInput.value.toLowerCase();
        const selectedFilters = {
            type: [],
            city: []
        };

        // Ambil filter yang dipilih
        filterCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                if (checkbox.value === 'seminar' || checkbox.value === 'workshop') {
                    selectedFilters.type.push(checkbox.value);
                } else {
                    selectedFilters.city.push(checkbox.value);
                }
            }
        });
        
        // Iterasi melalui semua event item dan terapkan filter
        eventItems.forEach(item => {
            const itemType = item.dataset.type;
            const itemCity = item.dataset.city;
            const itemTitle = item.dataset.title.toLowerCase();

            // 1. Cek Pencarian
            const matchesSearch = itemTitle.includes(searchTerm);

            // 2. Cek Filter Tipe
            const matchesType = selectedFilters.type.length === 0 || selectedFilters.type.includes(itemType);

            // 3. Cek Filter Kota
            const matchesCity = selectedFilters.city.length === 0 || selectedFilters.city.includes(itemCity);

            // Tampilkan/Sembunyikan Item
            if (matchesSearch && matchesType && matchesCity) {
                item.style.display = ''; // Tampilkan
            } else {
                item.style.display = 'none'; // Sembunyikan
            }
        });
    }

    // --- 4. Logika Pop-up (Modal) - Diperbarui dengan Detail Tambahan ---
    
    /**
     * Opens the modal and populates it with event data, including description, speaker, and price.
     * @param {HTMLElement} eventItem - The individual .event-item element.
     */
    function showEventDetails(eventItem) {
        // Ambil data dari event item's children dan data-attributes
        const title = eventItem.querySelector('.event-title').textContent.trim();
        const date = eventItem.querySelector('.event-info h3').textContent.trim();
        const time = eventItem.querySelector('.event-time').textContent.replace('🕐', '').trim();
        const location = eventItem.querySelector('.event-location').textContent.replace('📍', '').trim();
        const type = eventItem.dataset.type;
        
        // Ambil Data Tambahan dari data-* attributes yang baru
        const description = eventItem.dataset.description || "Deskripsi event ini belum tersedia.";
        const speaker = eventItem.dataset.speaker || "N/A";
        const price = eventItem.dataset.price || "N/A";
        
        // Populate modal
        document.getElementById('modalEventTitle').textContent = title;
        document.getElementById('modalEventDate').textContent = date;
        document.getElementById('modalEventTime').textContent = time;
        document.getElementById('modalEventLocation').textContent = location;
        document.getElementById('modalEventType').textContent = type.charAt(0).toUpperCase() + type.slice(1);
        
        // Isi Data Tambahan ke Elemen Modal
        // Pastikan Anda telah menambahkan elemen HTML dengan ID berikut di modal Anda!
        const speakerElement = document.getElementById('modalEventSpeaker');
        const priceElement = document.getElementById('modalEventPrice');
        const descriptionElement = document.getElementById('modalEventDescription');

        if (speakerElement) speakerElement.textContent = speaker; 
        if (priceElement) priceElement.textContent = price;
        if (descriptionElement) descriptionElement.textContent = description;

        // Set the Book Now button link
        const bookNowLink = document.getElementById('modalBookNowLink');
        bookNowLink.href = `/book-event?title=${encodeURIComponent(title)}&city=${eventItem.dataset.city}`;

        // Show modal
        eventModal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling background
    }

    /**
     * Closes the modal.
     */
    function hideEventDetails() {
        if (!eventModal) return;
        eventModal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    }

    // Listener Modal: Buka Modal (pada tombol 'View Details')
    if (eventItemsList) {
        eventItemsList.addEventListener('click', (e) => {
            const button = e.target.closest('.btn-view');
            if (button) {
                const eventItem = button.closest('.event-item');
                if (eventItem) {
                    showEventDetails(eventItem);
                }
            }
        });
    }

    // Listener Modal: Tutup Modal (tombol 'x')
    if (closeBtn) {
        closeBtn.addEventListener('click', hideEventDetails);
    }

    // Listener Modal: Tutup Modal (klik di luar konten)
    if (eventModal) {
        eventModal.addEventListener('click', (e) => {
            if (e.target === eventModal) {
                hideEventDetails();
            }
        });
    }

    // Listener Modal: Tutup Modal (tombol ESC)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && eventModal && eventModal.classList.contains('active')) {
            hideEventDetails();
        }
    });

    // Panggil filterEvents saat halaman dimuat pertama kali untuk inisialisasi
    // filterEvents();

</script>
@endpush