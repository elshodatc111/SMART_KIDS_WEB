@extends('layouts.admin')
@section('title', __('menu.statistics'))

@section('content')

<div class="pagetitle">
  <h1>{{ __('menu.statistics') }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
      <li class="breadcrumb-item active">{{ __('menu.statistics') }}</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Moliyaviy tahlil (Oxirgi 6 oy)</h5>
                    <canvas id="statistika" style="max-height: 450px;"></canvas>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const ctx = document.querySelector('#statistika').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: @json($months),
                                    datasets: [
                                        {
                                            label: "To'lovlar",
                                            data: @json($paymentsData),
                                            backgroundColor: 'rgba(46, 202, 106, 0.7)', // Yashil
                                            borderColor: 'rgb(46, 202, 106)',
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Ish haqi',
                                            data: @json($salaryData),
                                            backgroundColor: 'rgba(255, 159, 64, 0.7)', // To'q sariq
                                            borderColor: 'rgb(255, 159, 64)',
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Xarajatlar',
                                            data: @json($expenseData),
                                            backgroundColor: 'rgba(255, 99, 132, 0.7)', // Qizil
                                            borderColor: 'rgb(255, 99, 132)',
                                            borderWidth: 1
                                        },
                                        {
                                            label: 'Sof Daromad',
                                            type: 'line', // Daromadni chiziqli qilsak yaqqol ajralib turadi
                                            data: @json($profitData),
                                            fill: false,
                                            borderColor: 'rgb(65, 84, 241)', // Ko'k
                                            tension: 0.3,
                                            borderWidth: 3,
                                            pointBackgroundColor: 'rgb(65, 84, 241)'
                                        }
                                    ]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    let label = context.dataset.label || '';
                                                    if (label) label += ': ';
                                                    if (context.parsed.y !== null) {
                                                        label += new Intl.NumberFormat('uz-UZ').format(context.parsed.y) + " so'm";
                                                    }
                                                    return label;
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                callback: function(value) {
                                                    return new Intl.NumberFormat('uz-UZ').format(value);
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection