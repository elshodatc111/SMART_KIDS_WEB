<style>
    /* Bog'cha CRM uchun maxsus ranglar va effektlar */
    :root {
        --bogcha-primary: #6c5ce7; /* Siyohrang - ijodkorlik */
        --bogcha-success: #00b894; /* Yashil - o'sish */
        --bogcha-warning: #fab1a0; /* Shaftoli - iliqlik */
        --bogcha-info: #0984e3;    /* Moviy - bilim */
        --bogcha-bg: #f8f9fa;
    }

    .header-nav .nav-icon {
        font-size: 24px;
        color: #555;
        margin-right: 20px;
        transition: 0.3s;
    }

    .header-nav .nav-icon:hover {
        color: var(--bogcha-primary);
        transform: translateY(-2px);
    }

    /* Bildirishnoma nishonlari (Badges) */
    .header-nav .badge-number {
        font-size: 10px;
        font-weight: 700;
        padding: 4px 6px;
        border: 2px solid #fff;
    }

    /* Dropdown umumiy ko'rinishi */
    .dropdown-menu {
        border-radius: 15px !important;
        padding: 10px 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
    }

    .dropdown-header {
        background-color: var(--bogcha-bg);
        border-radius: 15px 15px 0 0;
        color: #444;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }

    /* Bildirishnomalar dizayni */
    .notifications .notification-item {
        padding: 12px 20px;
        border-bottom: 1px solid #f1f1f1;
    }

    .notifications .notification-item i {
        background: #f1f3f9;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .notifications .notification-item h4 {
        font-size: 14px;
        margin-bottom: 3px;
        color: #333;
    }

    /* Tug'ilgan kunlar uchun maxsus animatsiya */
    .bg-cake-soft { background-color: #fff3f0; color: #e17055; }
    .bg-brief-soft { background-color: #eef2ff; color: #4834d4; }

    /* Profil qismi */
    .nav-profile {
        background: #f1f3f9;
        padding: 5px 15px !important;
        border-radius: 50px;
        transition: 0.3s;
    }

    .nav-profile:hover {
        background: #e2e6f0;
    }

    .nav-profile i.bi-person-circle {
        color: var(--bogcha-primary);
    }
</style>

<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center list-unstyled mb-0">

        <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-chat-left-heart"></i> <span class="badge bg-primary badge-number">4</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications shadow border-0">
                <li class="dropdown-header p-3">
                    <i class="bi bi-info-circle me-1"></i> Yangi arizalar (4 ta)
                </li>
                <li><hr class="dropdown-divider m-0"></li>
                
                <li class="notification-item">
                    <i class="bi bi-person-plus text-primary"></i>
                    <div>
                        <h4><a href="#" class="text-dark text-decoration-none">Elshod Musurmonov</a></h4>
                        <p class="text-muted small">Tarbiyachilikka ariza qoldirdi</p>
                        <small class="text-secondary" style="font-size: 10px;">bugun, 15:45</small>
                    </div>
                </li>

                <li class="notification-item">
                    <i class="bi bi-envelope-paper text-warning"></i>
                    <div>
                        <h4><a href="#" class="text-dark text-decoration-none">Ota-onalar xabari</a></h4>
                        <p class="text-muted small">2-guruh bo'yicha taklif</p>
                    </div>
                </li>
                
                <li class="text-center p-2">
                    <a href="#" class="small text-primary fw-bold text-decoration-none">Barchasini ko'rish</a>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown px-3">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-stars"></i> <span class="badge bg-danger badge-number">3</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications shadow border-0" style="min-width: 250px;">
                <li class="dropdown-header text-center p-3">
                    <i class="bi bi-gift me-1"></i> Bayramlar yaqin
                </li>
                <li><hr class="dropdown-divider m-0"></li>
                
                <li class="notification-item">
                    <i class="bi bi-cake2 text-danger"></i>
                    <div>
                        <h4 class="mb-0">Jasur Jumaboyev</h4>
                        <p class="text-danger fw-bold" style="font-size: 11px;">Ertaga (5 yosh)</p>
                        <span class="badge bg-cake-soft p-1" style="font-size: 9px;">"Quyoshcha" guruhi</span>
                    </div>
                </li>

                <li class="notification-item">
                    <i class="bi bi-balloon-heart text-info"></i>
                    <div>
                        <h4 class="mb-0">Olima Sodiqova</h4>
                        <p class="text-info fw-bold" style="font-size: 11px;">4 kundan keyin</p>
                        <span class="badge bg-brief-soft p-1" style="font-size: 9px;">Enaga</span>
                    </div>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle fs-4"></i>
                <span class="d-none d-md-block dropdown-toggle ps-2 fw-bold text-dark">
                    {{ Str::upper(Auth::user()->type ?? 'Admin') }}
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile shadow mt-3 border-0">
                <li class="dropdown-header text-center p-3">
                    <h6 class="mb-0 text-dark">{{ Auth::user()->name ?? 'Ism topilmadi' }}</h6>
                    <small class="text-primary">{{ Auth::user()->phone ?? '+998 90 123 45 67' }}</small>
                </li>
                <li><hr class="dropdown-divider m-0"></li>
                
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" href="/profile">
                        <i class="bi bi-person-vcard me-2 text-primary"></i>
                        <span>Mening profilim</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>Tizimdan chiqish</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li> 
    </ul>
</nav>