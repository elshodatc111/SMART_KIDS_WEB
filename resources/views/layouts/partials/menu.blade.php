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
  <a class="nav-link {{ request()->routeIs(['report_vakansiya','report_bolalar_qabul','report_guruhlar','report_barcha_bolalar','report_bolalar_tolovlari','report_barcha_hodimlar','report_hodim_ish_haqi','report_moliya',]) ? '' : 'collapsed' }}" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-file-earmark-bar-graph"></i><span>{{ __('menu.hisobot') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="report-nav" class="nav-content collapse {{ request()->routeIs(['report_vakansiya','report_bolalar_qabul','report_guruhlar','report_barcha_bolalar','report_bolalar_tolovlari','report_barcha_hodimlar','report_hodim_ish_haqi','report_moliya']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('report_vakansiya') }}" class="nav-link {{ request()->routeIs(['report_vakansiya']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.barcha_hodim_vakansiya_arizalari') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('report_bolalar_qabul') }}" class="nav-link {{ request()->routeIs(['report_bolalar_qabul']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.barcha_bolalar_qabul_arizalari') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('report_guruhlar') }}" class="nav-link {{ request()->routeIs(['report_guruhlar']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.barcha_guruhlar') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('report_barcha_bolalar') }}" class="nav-link {{ request()->routeIs(['report_barcha_bolalar']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.barcha_bolalar') }}</span>
      </a>
    </li>    
    <li>
      <a href="{{ route('report_bolalar_tolovlari') }}" class="nav-link {{ request()->routeIs(['report_bolalar_tolovlari']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.barcha_bolalar_tolovlari') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('report_barcha_hodimlar') }}" class="nav-link {{ request()->routeIs(['report_barcha_hodimlar']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.barcha_hodimlar') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('report_hodim_ish_haqi') }}" class="nav-link {{ request()->routeIs(['report_hodim_ish_haqi']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.barcha_hodimlar_ish_haqi_tolovlari') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('report_moliya') }}" class="nav-link {{ request()->routeIs(['report_moliya']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.barcha_balans_tarixi') }}</span>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['chart_paymart','chart_aktive', 'chart_chart', 'chart_varonka']) ? '' : 'collapsed' }}" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-graph-up-arrow"></i><span>{{ __('menu.statistics') }}</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="charts-nav" class="nav-content collapse {{ request()->routeIs(['chart_paymart','chart_aktive', 'chart_chart', 'chart_varonka']) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('chart_paymart') }}" class="nav-link {{ request()->routeIs(['chart_paymart']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.tulovlar') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('chart_aktive') }}" class="nav-link {{ request()->routeIs(['chart_aktive']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.aktiv_bolalar') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('chart_varonka') }}" class="nav-link {{ request()->routeIs(['chart_varonka']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.varonka') }}</span>
      </a>
    </li>
    <li>
      <a href="{{ route('chart_chart') }}" class="nav-link {{ request()->routeIs(['chart_chart']) ? '' : 'collapsed' }}">
        <i class="bi bi-dot"></i><span>{{ __('menu.statistics') }}</span>
      </a>
    </li>
  </ul>
</li>