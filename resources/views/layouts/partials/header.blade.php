<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center list-unstyled mb-0">
        <!-- Lead -->        
        <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-primary badge-number">4</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header">
                    {{ __('header.lead_title') }}
                    <a href="{{ route('emploes_lead') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">{{ __('header.lead_all') }}</span></a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <!-- Yangi hodim -->
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>{{ __('header.lead_emploes') }}</h4>
                        <p>Elshod Musurmonov (Tarbiyachi)</p>
                        <p>2026-01-15 15:41:27</p>
                    </div>
                </li>
                <!-- Yangi bola -->
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-info"></i>
                    <div>
                        <h4>{{ __('header.lead_child') }}</h4>
                        <p>Elshod Musurmonov</p>
                        <p>2026-01-15 15:41:27</p>
                    </div>
                </li>
                <!-- Leadlar mavjud emas -->
                <li class="notification-item">
                    <i class="bi bi-empty text-info"></i>
                    <div>
                        <h6>{{ __('header.lead_no') }}</h6>
                    </div>
                </li>
            </ul>
        </li>

        <!-- Tyg'ilgan kunlar -->        
        <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-cake2"></i>
                <span class="badge bg-primary badge-number">4</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header">
                    {{ __('header.birthday_title') }}
                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">{{ __('header.birthday_all') }}</span></a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <!-- Yangi hodim -->
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>{{ __('header.birthday_emploes') }}</h4>
                        <p>Elshod Musurmonov (Tarbiyachi)</p>
                        <p>Bugun tug'ilgan kuni</p>
                    </div>
                </li>
                <!-- Yangi bola -->
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-info"></i>
                    <div>
                        <h4>{{ __('header.birthday_child') }}</h4>
                        <p>Elshod Musurmonov</p>
                        <p>4 kun qoldi</p>
                    </div>
                </li>
                <!-- Tug'ilgan kunlar mavjud emas -->
                <li class="notification-item">
                    <i class="bi bi-empty text-info"></i>
                    <div>
                        <h6>{{ __('header.birthday_no') }}</h6>
                    </div>
                </li>
            </ul>
        </li>
        
        <!-- Til yangilash -->
        <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-icon d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-translate text-primary"></i>
                <span class="ps-1 small">{{ strtoupper(app()->getLocale()) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('changeLang', 'uz') }}">
                        <span class="{{ app()->getLocale() == 'uz' ? 'fw-bold text-primary' : '' }}">O'zbekcha</span>
                        @if(app()->getLocale() == 'uz') <i class="bi bi-check ms-auto text-success"></i> @endif
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('changeLang', 'ru') }}">
                        <span class="{{ app()->getLocale() == 'ru' ? 'fw-bold text-primary' : '' }}">Русский</span>
                        @if(app()->getLocale() == 'ru') <i class="bi bi-check ms-auto text-success"></i> @endif
                    </a>
                </li>
            </ul>
        </li>
        <!-- Profil -->
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
                        <span>{{ __('header.my_profile') }}</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>{{ __('header.sign_out') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li> 

    </ul>
</nav>