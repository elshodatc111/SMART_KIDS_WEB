@extends('layouts.admin')
@section('title', __('menu.dashboard'))
@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.dashboard')}}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('home.Aktiv') }} <span>| {{ __('home.Xodimlar') }}</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $hodimlar }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="card info-card revenue-card"> <div class="card-body">
            <h5 class="card-title">{{ __('home.Davomad') }} <span>| {{ __('home.Xodimlar') }}</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-person-check"></i>
              </div>
              <div class="ps-3">
                @if($davomad['keldi'])
                <h6>{{ $davomad['keldi'] }}</h6>
                <span class="text-success small pt-1 fw-bold">{{ $davomad['kechikdi'] }}</span> <span class="text-muted small pt-2 ps-1">{{ __('hodim.kechikdi')}}</span>
                @else
                <span class="text-danger small pt-1 fw-bold">{{ __('home.bugun_davomad_olinmadi') }}</span>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="card info-card customers-card"> <div class="card-body">
            <h5 class="card-title">{{ __('home.Aktiv') }} <span>| {{ __('home.Bolalar')}}</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-person-badge"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $aktivKid }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">{{ __('home.Davomad') }} <span>| {{ __('home.Guruhlar')}}</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-mortarboard"></i>
              </div>
              <div class="ps-3">
                <h6>{{ $guruhDavomad['guruhlar'] }}</h6>
                <span class="text-danger small pt-2 ps-1">{{ $guruhDavomad['davomadsiz'] }}</span>
                <span class="text-muted small pt-2 ps-1">{{ __('home.ta_qoldi')}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">{{ __('home.kunlik_hodimlar_davomadi')}}</h2>
        <div id="davomadChart"></div>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            const last10Days = [];
            for (let i = 9; i >= 0; i--) {
              const d = new Date();
              d.setDate(d.getDate() - i);
              last10Days.push(d.toISOString().split('T')[0]);
            }
            new ApexCharts(document.querySelector("#davomadChart"), {
              series: [{
                name: 'Keldi',
                data: @json($chart['keldi']),
              }, {
                name: 'Kelmadi',
                data: @json($chart['kelmadi'])
              }],
              chart: {height: 350,type: 'area',toolbar: { show: false },},
              markers: { size: 4 },
              colors: ['#2eca6a', '#EB4C42'],
              fill: {type: "gradient",gradient: {shadeIntensity: 1,opacityFrom: 0.3,opacityTo: 0.4,stops: [0, 90, 100]}},
              dataLabels: { enabled: false },
              stroke: { curve: 'smooth', width: 2 },
              xaxis: {type: 'datetime',categories: last10Days},
              tooltip: {x: { format: 'dd/MM/yy' },}
            }).render();
          });
        </script>
      </div>
    </div>
  </section>
@endsection