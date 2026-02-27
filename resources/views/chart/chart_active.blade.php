@extends('layouts.admin')
@section('title', __('menu.aktiv_bolalar'))
@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.aktiv_bolalar') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.aktiv_bolalar') }}</li>
      </ol>
    </nav>
  </div><section class="section dashboard">
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ __('menu.aktiv_bolalar') }}</h5>
              <div id="aktivKid"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const activeData = @json(json_decode($monthlyActiveData)).map(Number);
                  const labels = @json(json_decode($monthLabels));
                  new ApexCharts(document.querySelector("#aktivKid"), {
                      series: [{name: "Aktiv bolalar:",data: activeData}],
                      chart: {height: 350,type: 'line', zoom: { enabled: false },toolbar: { show: true }},
                      dataLabels: { enabled: true,style: { colors: ['#4154f1'] }},
                      stroke: {curve: 'smooth',width: 3},
                      colors: ['#4154f1'],
                      grid: {row: {colors: ['#f3f3f3', 'transparent'],opacity: 0.5},},
                      xaxis: {categories: labels,},
                      yaxis: {title: { text: 'Bolalar soni' }},
                      tooltip: {y: {formatter: function (val) {return val + " ta bola";}}}
                  }).render();
                });
              </script>
          </div>
        </div>
      </div>

    </div>
  </section>

@endsection