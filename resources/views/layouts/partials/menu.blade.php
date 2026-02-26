<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['home']) ? '' : 'collapsed' }}" href="{{ route('home') }}">
    <i class="bi bi-house-heart"></i>
    <span>{{ __('menu.dashboard') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link  {{ request()->routeIs(['kids','kid_show']) ? '' : 'collapsed' }}" href="{{ route('kids') }}">
    <i class="bi bi-backpack4"></i>
    <span>{{ __('menu.child') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link  {{ request()->routeIs(['groups','groups_show']) ? '' : 'collapsed' }}" href="{{ route('groups') }}">
    <i class="bi bi-collection"></i>
    <span>{{ __('menu.groups') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['emploes','emploes_show']) ? '' : 'collapsed' }}" href="{{ route('emploes') }}">
    <i class="bi bi-person-badge"></i>
    <span>{{ __('menu.emploes') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['kassa']) ? '' : 'collapsed' }}" href="{{ route('kassa') }}">
    <i class="bi bi-wallet2"></i>
    <span>{{ __('menu.cashier') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['emploes_davomad','kid_davomad_show_all_groups','kid_davomad_show']) ? '' : 'collapsed' }}" data-bs-target="#davomad-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-calendar2-check"></i><span>{{ __('menu.attendance') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="davomad-nav" class="nav-content collapse {{ request()->routeIs(['emploes_davomad','kid_davomad_show','kid_davomad_show_all_groups']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('emploes_davomad') }}" class="nav-link {{ request()->routeIs(['emploes_davomad']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.staff_attendance') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('kid_davomad_show_all_groups') }}" class="nav-link {{ request()->routeIs(['kid_davomad_show_all_groups','kid_davomad_show']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.child_attendance') }}</span>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['emploes_lead','emploes_lead_show', 'child_lead_show', 'child_lead']) ? '' : 'collapsed' }}" data-bs-target="#lead-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-person-plus-fill"></i><span>{{ __('menu.lead') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="lead-nav" class="nav-content collapse {{ request()->routeIs(['emploes_lead', 'emploes_lead_show', 'child_lead_show', 'child_lead']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('emploes_lead') }}" class="nav-link {{ request()->routeIs(['emploes_lead','emploes_lead_show']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.staff_leads') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('child_lead') }}" class="nav-link {{ request()->routeIs(['child_lead', 'child_lead_show']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.child_leads') }}</span>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['moliya']) ? '' : 'collapsed' }}" href="{{ route('moliya') }}">
    <i class="bi bi-bank"></i>
    <span>{{ __('menu.finance') }}</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-graph-up-arrow"></i><span>{{ __('menu.statistics') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
      <a href="#">
        <i class="bi bi-dot"></i><span>Chart 01</span>
      </a>
    </li>
    <li>
      <a href="#">
        <i class="bi bi-dot"></i><span>Chart 02</span>
      </a>
    </li>
  </ul>
</li>