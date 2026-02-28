@extends('layouts.admin')
@section('title', __('home.tkun'))
@section('content')
  <div class="pagetitle">
    <h1>{{ __('home.tkun') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('home.tkun') }}</li>
      </ol>
    </nav>
  </div>
<section class="section dashboard">
  <div class="row">
    @foreach ($birthdays as $item)
    @if($item['category']=='Hodim')
    <div class="col-xxl-3 col-md-4 col-sm-6">
      <div class="card info-card birthday-card-today shadow-sm border-0 border-top border-4 border-success">
        <div class="card-body p-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            @if($item['day']=='today')
            <span class="badge bg-success-light text-success small">
               <i class="bi bi-gift-fill me-1"></i> {{ __('home.bugun') }}
            </span>
            @else
            <span class="badge bg-primary-light text-primary small">
               <i class="bi bi-calendar-event me-1"></i> {{ __('home.ertaga') }}
            </span>
            @endif
            <div class="card-icon rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
              <i class="bi bi-stars"></i>
            </div>
          </div>
          
          <div class="text-center">
            <h6 class="fw-bold mb-1" style="font-size: 1.1rem; color: #012970;">{{ $item['name'] }}</h6>
            <p class="text-muted small mb-0">
              <i class="bi bi-briefcase me-1"></i> 
              <!-- '','','','','','','','' -->
              @if($item['role']=='drektor')
                {{ __('home.drektor') }}
              @elseif($item['role']=='admin')
                {{ __('home.admin') }}
              @elseif($item['role']=='katta_tarbiyachi')
                {{ __('home.katta_tarbiyachi') }}
              @elseif($item['role']=='kichik_tarbiyachi')
                {{ __('home.kichik_tarbiyachi') }}
              @elseif($item['role']=='oshpaz')
                {{ __('home.oshpaz') }}
              @elseif($item['role']=='teacher')
                {{ __('home.teacher') }}
              @elseif($item['role']=='farrosh')
                {{ __('home.farrosh') }}
              @elseif($item['role']=='hodim')
                {{ __('home.hodim') }}
              @else
              {{ $item['role'] }}
              @endif
            </p>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="col-xxl-3 col-md-4 col-sm-6">
      <div class="card info-card birthday-card-tomorrow shadow-sm border-0 border-top border-4 border-primary">
        <div class="card-body p-3">
          <div class="d-flex align-items-center justify-content-between mb-2">
            @if($item['day']=='today')
            <span class="badge bg-success-light text-success small">
               <i class="bi bi-gift-fill me-1"></i> {{ __('home.bugun') }}
            </span>
            @else
            <span class="badge bg-primary-light text-primary small">
               <i class="bi bi-calendar-event me-1"></i> {{ __('home.ertaga') }}
            </span>
            @endif
            <div class="card-icon rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
              <i class="bi bi-person-heart"></i>
            </div>
          </div>

          <div class="text-center">
            <h6 class="fw-bold mb-1" style="font-size: 1.1rem; color: #012970;">{{ $item['name'] }}</h6>
            <p class="text-muted small mb-0">
              <i class="bi bi-emoji-smile me-1"></i> {{ $item['role'] }}
            </p>
          </div>
        </div>
      </div>
    </div>
    @endif
    @endforeach
  </div>
</section>

<style>
  /* NiceAdmin ranglariga mos qo'shimcha stillar */
  .bg-success-light { background-color: #e7f9ed; }
  .bg-primary-light { background-color: #e7f1ff; }
  .birthday-card-today { transition: 0.3s; }
  .birthday-card-today:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important; }
</style>

@endsection