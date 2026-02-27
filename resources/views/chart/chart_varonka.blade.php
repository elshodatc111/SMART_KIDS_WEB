@extends('layouts.admin')
@section('title', __('menu.varonka'))

@section('content')
<style>
  .funnel-stats-container {display: flex;justify-content: space-between;gap: 10px;margin-top: 20px;padding: 10px 5px;background: #fdfdfd;border-radius: 8px;}
  .stat-block {flex: 1;display: flex;flex-direction: column;align-items: center;padding: 10px 5px;border-right: 1px solid #eee;transition: all 0.3s ease;}
  .stat-block:last-child {border-right: none;}
  .stat-block:hover {background: #f8f9ff;border-radius: 5px;}
  .stat-number {font-weight: 800;font-size: 1.2rem;color: #333;line-height: 1;margin-bottom: 5px;}
  .stat-text {color: #888;font-size: 0.75rem;text-transform: uppercase;letter-spacing: 0.5px;margin-bottom: 8px;text-align: center;}
  .stat-percent {font-weight: 600;color: #4154f1;background: #f0f2ff;padding: 2px 8px;border-radius: 20px;font-size: 0.7rem;}
  .indicator {width: 8px;height: 8px;border-radius: 50%;margin-bottom: 8px;}
  .apexcharts-canvas {margin: 0 auto;}
</style>

<div class="pagetitle">
  <h1>{{ __('menu.varonka') }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
      <li class="breadcrumb-item active">{{ __('menu.varonka') }}</li>
    </ol>
  </nav>
</div>
<section class="section dashboard">
  <div class="row">
    @php
      $charts = [
        ['id' => 'empMonth', 'title' => 'Xodimlar (Joriy oy)', 'data' => $empMonth],
        ['id' => 'empYear', 'title' => 'Xodimlar (Joriy yil)', 'data' => $empYear],
        ['id' => 'kidMonth', 'title' => 'Bolalar (Joriy oy)', 'data' => $kidMonth],
        ['id' => 'kidYear', 'title' => 'Bolalar (Joriy yil)', 'data' => $kidYear],
      ];
      $labels = ['Lidlar', 'Jarayonda', 'Qabul qilindi', 'Rad etildi'];
      $colors = ['#f3a683', '#f19066', '#cf6a87', '#778beb'];
    @endphp
    @foreach($charts as $chart)
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">{{ $chart['title'] }}</h5>
          <div id="{{ $chart['id'] }}Chart"></div>
          <div class="funnel-stats-container">
            @foreach($labels as $index => $label)
              @php 
                $value = $chart['data'][$index] ?? 0;
                $total = array_sum($chart['data']);
                $percent = $total > 0 ? round(($value / $total) * 100, 1) : 0;
              @endphp
              <div class="stat-block">
                <div class="indicator" style="background-color: {{ $colors[$index] }}"></div>
                <span class="stat-number">{{ $value }}</span>
                <span class="stat-text">{{ $label }}</span>
                <span class="stat-percent">{{ $percent }}%</span>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", () => {
      const funnelOptions = (data, title) => ({
          series: [{ name: title, data: data.map(Number) }],
          chart: { type: 'bar', height: 280, toolbar: {show: false},sparkline: { enabled: false }},
          plotOptions: {bar: {borderRadius: 8,horizontal: true,barHeight: '75%',isFunnel: true,distributed: true,},},
          colors: @json($colors),
          dataLabels: {enabled: true,formatter: function (val, opt) {
                  let total = opt.w.globals.series[0].reduce((a, b) => a + b, 0);
                  return total > 0 ? ((val / total) * 100).toFixed(1) + '%' : '0%';},
              style: {fontSize: '12px',fontWeight: 'bold',colors: ['#fff']},
              dropShadow: { enabled: true }},
          xaxis: {categories: @json($labels),labels: { show: false },axisBorder: { show: false },axisTicks: { show: false }},
          grid: { show: false },
          legend: { show: false },
          tooltip: {enabled: true,y: {formatter: function(val) { return val + " ta ariza" }}}
      });
      new ApexCharts(document.querySelector("#empMonthChart"), funnelOptions(@json($empMonth), "Xodimlar")).render();
      new ApexCharts(document.querySelector("#empYearChart"), funnelOptions(@json($empYear), "Xodimlar")).render();
      new ApexCharts(document.querySelector("#kidMonthChart"), funnelOptions(@json($kidMonth), "Bolalar")).render();
      new ApexCharts(document.querySelector("#kidYearChart"), funnelOptions(@json($kidYear), "Bolalar")).render();
  });
</script>
@endsection