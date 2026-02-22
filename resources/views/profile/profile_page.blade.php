@extends('layouts.admin')

@section('title', __('profile_page.profile'))

@section('content')
<div class="pagetitle">
    <h1>{{ __('profile_page.profile') }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('profile_page.profile') }}</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body profile-overview">
                    <h5 class="card-title">{{ __('profile_page.shaxsiy_mal') }}</h5>
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-5 label">{{ __('profile_page.fio')}}:</div>
                        <div class="col-lg-8 col-md-7" style="text-align: right">{{ $user['name'] }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-4 col-md-5 label">{{ __('profile_page.phone1')}}:</div>
                        <div class="col-lg-8 col-md-7" style="text-align: right">{{ $user['phone'] }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-4 col-md-5 label">{{ __('profile_page.phone2')}}:</div>
                        <div class="col-lg-8 col-md-7" style="text-align: right">
                            {{ $user['phone_two'] ?? '—' }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-5 label">{{ __('profile_page.address')}}:</div>
                        <div class="col-lg-8 col-md-7" style="text-align: right">{{ $user['address'] }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-5 label">{{ __('profile_page.tkun')}}:</div>
                        <div class="col-lg-8 col-md-7" style="text-align: right">{{ \Carbon\Carbon::parse($user['birthday'])->format('d.m.Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-5 label">{{ __('profile_page.passport')}}:</div>
                        <div class="col-lg-8 col-md-7" style="text-align: right">{{ $user['passport_number'] }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-5 label">{{ __('profile_page.lavozim')}}:</div>
                        <div class="col-lg-8 col-md-7" style="text-align: right">{{ $user['type'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body px-4">
                    <h5 class="card-title">{{ __('profile_page.parol_yangilash')}}</h5>
                    <form method="POST" action="{{ route('profile_password_update') }}">
                        @csrf
                        <div class="row mb-2">
                            <label for="current_password">{{ __('profile_page.joriy_parol')}}</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" required>
                        </div>
                        <div class="row mb-2">
                            <label for="password">{{ __('profile_page.yangi_parol')}}</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="row mb-2">
                            <label for="password_confirmation">{{ __('profile_page.yangi_parol_tasdiq')}}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"> {{ __('profile_page.parol_yangilash')}} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection