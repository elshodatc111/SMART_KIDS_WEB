@extends('layouts.admin')
@section('title', 'Moliya')
@section('content')
    <div class="pagetitle">
      <h1>Moliya</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item active">Moliya</li>
        </ol>
      </nav>
    </div><section class="section dashboard">
      <div class="row">

        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Balansda mavjud</h5>
              <p>Siz tizimga muvaffaqiyatli kirdingiz. Bu yerda sizning asosiy statistikalaringiz ko'rinadi.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">To'lov kutilmoqda</h5>
              <p>Siz tizimga muvaffaqiyatli kirdingiz. Bu yerda sizning asosiy statistikalaringiz ko'rinadi.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tasdiqlanmagan to'lovlar</h5>
              <p>Siz tizimga muvaffaqiyatli kirdingiz. Bu yerda sizning asosiy statistikalaringiz ko'rinadi.</p>
            </div>
          </div>
        </div>

      </div>
    </section>
@endsection