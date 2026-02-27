@extends('layouts.admin')
@section('title', __('menu.tulovlar'))
@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.tulovlar') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.tulovlar') }}</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title w-100 text-center">Joriy oy to'lovlar</h5>
            <div id="joriyOy"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#joriyOy"), {
                    series:@json($joriyOyData),
                    chart: {height: 350,type: 'pie',toolbar: {show: true}},
                    labels: ['Naqt', 'Karta', 'Bank','Chegirma', 'Qaytarildi'],
                    colors: ['#2eca6a', '#4154f1', '#0dcaf0', '#ffc107', '#dc3545']
                  }).render();
                });
              </script>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title w-100 text-center">O'tgan oy to'lovlari</h5>
            <div id="otganOy"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#otganOy"), {
                    series: @json($otganOyData),
                    chart: {height: 350,type: 'donut',toolbar: {show: true}},
                    labels: ['Naqt', 'Karta', 'Bank','Chegirma', 'Qaytarildi'],
                    colors: ['#2eca6a', '#4154f1', '#0dcaf0', '#ffc107', '#dc3545']
                  }).render();
                });
              </script>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kunlik to'lovlar</h5>
              <div id="kunlikTolovlar"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#kunlikTolovlar"), {
                    series: [
                      {name: 'Naqd', data: @json($kunlik['cash'])},
                      {name: 'Karta', data: @json($kunlik['card'])},
                      {name: 'Bank', data: @json($kunlik['bank'])},
                      {name: 'Chegirma', data: @json($kunlik['discount'])},
                      {name: 'Qaytarildi', data: @json($kunlik['return'])}
                    ],
                    chart: {type: 'bar',height: 350},
                    plotOptions: {bar: {horizontal: false,columnWidth: '55%',endingShape: 'rounded'},},
                    dataLabels: {enabled: false},
                    stroke: {show: true,width: 2,colors: ['transparent']},
                    xaxis: {categories: @json($kunlikDates)},
                    yaxis: {title: {text: ' UZS'}},
                    colors: ['#2eca6a', '#4154f1', '#0dcaf0', '#ffc107', '#dc3545'],
                    fill: {opacity: 1},
                    tooltip: {y: {formatter: function(val) {return val + " UZS"}}}
                  }).render();
                });
              </script>
          </div>
        </div>
      </div>
      
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Oylik to'lovlar</h5>
              <div id="oylikTolovlar"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#oylikTolovlar"), {
                    series: [
                      {name: 'Naqd', data: @json($oylik['cash'])},
                      {name: 'Karta', data: @json($oylik['card'])},
                      {name: 'Bank', data: @json($oylik['bank'])},
                      {name: 'Chegirma', data: @json($oylik['discount'])},
                      {name: 'Qaytarildi', data: @json($oylik['return'])}
                    ],
                    chart: {type: 'bar',height: 350},
                    plotOptions: {bar: {horizontal: false,columnWidth: '55%',endingShape: 'rounded'},},
                    dataLabels: {enabled: false},
                    stroke: {show: true,width: 2,colors: ['transparent']},
                    xaxis: {categories: @json($oylikLabels),},
                    colors: ['#2eca6a', '#4154f1', '#0dcaf0', '#ffc107', '#dc3545'],
                    yaxis: {title: {text: ' UZS'}},
                    fill: {opacity: 1},
                    tooltip: {y: {formatter: function(val) {return val + " UZS"}}}
                  }).render();
                });
              </script>
          </div>
        </div>
      </div>

    </div>
  </section>


@endsection