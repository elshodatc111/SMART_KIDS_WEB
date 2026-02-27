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
  </div><section class="section dashboard">
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Hush kelibsiz</h5>
            <p>Siz tizimga muvaffaqiyatli kirdingiz. Bu yerda sizning asosiy statistikalaringiz ko'rinadi.</p>
          </div>
        </div>
      </div>

    </div>
  </section>

@endsection