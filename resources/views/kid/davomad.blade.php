@extends('layouts.admin')
@section('title', 'Guruhlar davomadi')
@section('content')
    <div class="pagetitle">
      <h1>Guruhlar davomadi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item active">Guruhlar davomadi</li>
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
                  <div class="col-6">Bolalar soni</div>
                  <div class="col-6" style="text-align: right">{{ $group->child_count }}</div>
                </div>
                @if ($group->davomad_status)
                  <p class="text-success text-center">Bugun davomad olingan</p>
                @else
                  <p class="text-danger text-center">Bugun davomad olinmagan</p>
                @endif
                <a href="{{ route('kid_davomad_show', $group->id) }}" class="btn btn-primary w-100">Guruh davomadi</a>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <p class='mt-2'>Hech qanday guruh mavjud emas.</p>
              </div>
            </div>
          </div>
        @endforelse
      </div>
    </section>
@endsection