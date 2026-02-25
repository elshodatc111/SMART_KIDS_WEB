@extends('layouts.admin')
@section('title', 'Guruh davomadi')
@section('content')
    <div class="pagetitle">
      <h1>Guruh davomadi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('kid_davomad_show_all_groups') }}">Guruhlar davomadi</a></li>
          <li class="breadcrumb-item active">Guruh davomadi</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div style="text-align: right"><button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#davomad_olish"><i class="bi bi-check"></i> Davomad olish</button></div>
      @foreach($attendanceData as $type => $monthInfo)
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title text-primary">
              {{ $type == 'current' ? 'Joriy oy' : 'O\'tgan oy' }} | <span class="text-muted">{{ $monthInfo['month_name'] }}</span>
            </h5>
            <div class="table-responsive">
              <table class="table table-bordered text-center align-middle" style="font-size: 12px;">
                <thead class="bg-light">
                  <tr>
                    <th rowspan="2" class="align-middle" style="min-width: 150px;">F.I.O.</th>
                    <th colspan="{{ $monthInfo['days_count'] }}">{{ Str::title($monthInfo['month_name']) }}</th>
                  </tr>
                  <tr>
                    @for($i = 1; $i <= $monthInfo['days_count']; $i++)
                      <th style="width: 30px; {{ \Carbon\Carbon::now()->day == $i && $type == 'current' ? 'background: #e7f1ff;' : '' }}">
                        {{ $i }}
                      </th>
                    @endfor
                  </tr>
                </thead>
                <tbody>
                  @foreach($kids as $kid)
                    <tr>
                      <td class="text-start">
                        <strong><a href="{{ route('kid_show', $kid->id) }}">{{ $kid->child_full_name }}</a></strong>
                      </td>
                      @for($i = 1; $i <= $monthInfo['days_count']; $i++)
                        @php
                          $status = $monthInfo['data'][$kid->id][$i][0]->status ?? null;
                        @endphp
                        <td>
                          @if($status == 'keldi')
                            <span class="badge bg-success p-1"><i class="bi bi-person-check"></i></span>
                          @elseif($status == 'kelmadi')
                            <span class="badge bg-danger p-1"><i class="bi bi-x-lg"></i></span>
                          @else
                            <span class="text-muted">-</span>
                          @endif
                        </td>
                      @endfor
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      @endforeach
    </section>

<div class="modal fade" id="davomad_olish" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('kid_davomad_store') }}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Davomat olish / Tahrirlash ({{ now()->format('d.m.Y') }})</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <input type="hidden" name="group_id" value="{{ $group->id }}">
          <input type="hidden" name="attendance_date" value="{{ now()->format('Y-m-d') }}">

          <table class="table table-hover mb-0">
            <thead class="bg-light">
              <tr>
                <th class="ps-4">Bola</th>
                <th class="text-center" style="width: 300px;">Holati</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kids as $kid)
                @php
                  $today = now()->day;
                  $currentStatus = $attendanceData['current']['data'][$kid->id][$today][0]->status ?? 'kelmadi';
                @endphp
                <tr>
                  <td class="ps-4 align-middle">
                    <strong>{{ $kid->child_full_name }}</strong>
                  </td>
                  <td class="text-center">
                    <div class="btn-group w-100" role="group" aria-label="Attendance status">
                      <input type="radio" class="btn-check" name="attendance[{{ $kid->id }}]" 
                             id="keldi_{{ $kid->id }}" value="keldi" autocomplete="off"
                             {{ $currentStatus == 'keldi' ? 'checked' : '' }}>
                      <label class="btn btn-outline-success border-end-0" for="keldi_{{ $kid->id }}">Keldi</label>

                      <input type="radio" class="btn-check" name="attendance[{{ $kid->id }}]" 
                             id="kelmadi_{{ $kid->id }}" value="kelmadi" autocomplete="off"
                             {{ $currentStatus == 'kelmadi' ? 'checked' : '' }}>
                      <label class="btn btn-outline-danger" for="kelmadi_{{ $kid->id }}">Kelmadi</label>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary px-4">Saqlash</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection