@extends('layouts.admin')
@section('title', __('kid_davomad_page.groups_title'))
@section('content')
    <div class="pagetitle">
      <h1>{{ __('kid_davomad_page.groups_title') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item active">{{ __('kid_davomad_page.groups_title') }}</li>
        </ol>
      </nav>
    </div><section class="section dashboard">
      <div class="row">
        @forelse ($res as $key => $group)
          <div class="col-lg-3 col-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title w-100 text-center">{{ $group->group_name }}</h5>
                <div class="row my-2">
                  <div class="col-6">{{ __('kid_davomad_page.bolalar_soni') }}</div>
                  <div class="col-6" style="text-align: right">{{ $group->child_count }}</div>
                </div>
                @if ($group->davomad_status)
                  <p class="text-success text-center">{{ __('kid_davomad_page.bugun_davomad_olindi') }}</p>
                @else
                  <p class="text-danger text-center">{{ __('kid_davomad_page.bugun_davomad_olinmagan') }}</p>
                @endif
                <a href="{{ route('kid_davomad_show', $group->id) }}" class="btn btn-primary w-100">{{ __('kid_davomad_page.group_title') }}</a>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <p class='mt-2'>{{ __('kid_davomad_page.xech_qanday_guruhlar_topilmadi') }}</p>
              </div>
            </div>
          </div>
        @endforelse
      </div>
    </section>
@endsection