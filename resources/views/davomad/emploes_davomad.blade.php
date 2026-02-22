@extends('layouts.admin')
@section('title', __('emploes_davomad_page.title'))

@section('content')
<div class="pagetitle">
    <h1>{{ __('emploes_davomad_page.title') }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('emploes_davomad_page.title') }}</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="card recent-sales overflow-auto">
        <div class="card-body pb-0 pt-3">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <td><span class="badge bg-success"><i class="bi bi-person-check"></i></span></td>
                        <td><span class="badge bg-danger"><i class="bi bi-x"></i></span></td>
                        <td><span class="badge bg-warning text-dark"><i class="bi bi-person-check"></i></span></td>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <tr>
                        <td>{{ __('emploes_davomad_page.ishga_keldi') }}</td>
                        <td>{{ __('emploes_davomad_page.ishga_kelmadi') }}</td>
                        <td>{{ __('emploes_davomad_page.ishga_kechikdi') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <div class="row border-bottom align-items-center">
                <div class="col-6">
                    <h5 class="card-title">{{ __('emploes_davomad_page.joriy_oy') }} <span>| {{ $currentMonth->translatedFormat('F, Y') }}</span></h5>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#attendanceModal">
                        <i class="bi bi-calendar-check"></i> {{ __('emploes_davomad_page.davomad_olish') }}
                    </button>
                </div>
            </div>
            
            <div class="table-responsive mt-3">
                <table class="table table-bordered" style="font-size:13px;">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle text-center bg-light" style="min-width: 200px;">{{ __('emploes_davomad_page.fio') }}</th>
                            <th colspan="{{ $daysInCurrentMonth }}" class="text-center bg-light">{{ $currentMonth->translatedFormat('F') }}</th>
                        </tr>
                        <tr class="text-center">
                            @for($i = 1; $i <= $daysInCurrentMonth; $i++)
                                <th style="min-width: 35px;">{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            @php
                                $userAttendances = $user->attendances
                                    ->whereBetween('attendance_date', [
                                        $currentMonth->copy()->startOfMonth()->format('Y-m-d 00:00:00'), 
                                        $currentMonth->copy()->endOfMonth()->format('Y-m-d 23:59:59')
                                    ])
                                    ->keyBy(fn($item) => \Carbon\Carbon::parse($item->attendance_date)->format('j'));
                            @endphp
                            <tr>
                                <td><b>{{ $user->name }}</b></td>
                                @for($i = 1; $i <= $daysInCurrentMonth; $i++)
                                    <td class="text-center">
                                        @if(isset($userAttendances[$i]))
                                            @php $st = $userAttendances[$i]->status; @endphp
                                            <span class="badge {{ $st == 'keldi' ? 'bg-success' : ($st == 'kelmadi' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                                <i class="bi {{ $st == 'kelmadi' ? 'bi-x' : 'bi-person-check' }}"></i>
                                            </span>
                                        @else
                                            <span class="text-muted" style="font-size: 10px;">-</span>
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

    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <h5 class="card-title">{{ __('emploes_davomad_page.otgan_oy') }} <span>| {{ $prevMonth->translatedFormat('F, Y') }}</span></h5>
            <div class="table-responsive mt-2">
                <table class="table table-bordered" style="font-size:13px;">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle text-center bg-light" style="min-width: 200px;">{{ __('emploes_davomad_page.fio') }}</th>
                            <th colspan="{{ $daysInPrevMonth }}" class="text-center bg-light">{{ $prevMonth->translatedFormat('F') }}</th>
                        </tr>
                        <tr class="text-center">
                            @for($i = 1; $i <= $daysInPrevMonth; $i++)
                                <th style="min-width: 35px;">{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            @php
                                $userPrevAttendances = $user->attendances
                                    ->whereBetween('attendance_date', [
                                        $prevMonth->copy()->startOfMonth()->format('Y-m-d 00:00:00'), 
                                        $prevMonth->copy()->endOfMonth()->format('Y-m-d 23:59:59')
                                    ])
                                    ->keyBy(fn($item) => \Carbon\Carbon::parse($item->attendance_date)->format('j'));
                            @endphp
                            <tr>
                                <td>{{ $user->name }}</td>
                                @for($i = 1; $i <= $daysInPrevMonth; $i++)
                                    <td class="text-center">
                                        @if(isset($userPrevAttendances[$i]))
                                            @php $st = $userPrevAttendances[$i]->status; @endphp
                                            <span class="badge {{ $st == 'keldi' ? 'bg-success' : ($st == 'kelmadi' ? 'bg-danger' : 'bg-warning text-dark') }} opacity-75">
                                                <i class="bi {{ $st == 'kelmadi' ? 'bi-x' : 'bi-person-check' }}"></i>
                                            </span>
                                        @else
                                            <span class="text-muted" style="font-size: 10px;">-</span>
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
</section>


<div class="modal fade" id="attendanceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('davomad_store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('emploes_davomad_page.davomad_olish') }} ({{ date('d.m.Y') }})</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="attendance_date" value="{{ date('Y-m-d') }}">
                    <table class="table align-middle table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>{{ __('emploes_davomad_page.hodim') }}</th>
                                <th class="text-center">{{ __('emploes_davomad_page.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @php
                                    $todayDate = date('Y-m-d');
                                    $todayAttendance = $user->attendances->filter(function($item) use ($todayDate) {
                                        return \Carbon\Carbon::parse($item->attendance_date)->format('Y-m-d') === $todayDate;
                                    })->first();
                                    $todayStatus = $todayAttendance ? $todayAttendance->status : 'kelmadi';
                                @endphp
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="attendances[{{ $user->id }}]" id="k_{{ $user->id }}" value="keldi" {{ $todayStatus == 'keldi' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-success btn-sm" for="k_{{ $user->id }}">{{ __('emploes_davomad_page.ishga_keldi') }}</label>
                                            <input type="radio" class="btn-check" name="attendances[{{ $user->id }}]" id="m_{{ $user->id }}" value="kelmadi" {{ $todayStatus == 'kelmadi' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-danger btn-sm" for="m_{{ $user->id }}">{{ __('emploes_davomad_page.ishga_kelmadi') }}</label>
                                            <input type="radio" class="btn-check" name="attendances[{{ $user->id }}]" id="ke_{{ $user->id }}" value="kechikdi" {{ $todayStatus == 'kechikdi' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-warning btn-sm text-dark" for="ke_{{ $user->id }}">{{ __('emploes_davomad_page.ishga_kechikdi') }}</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('emploes_davomad_page.cancel') }}</button>
                    <button type="submit" class="btn btn-primary px-4">{{ __('emploes_davomad_page.success') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .table-responsive { position: relative; }
    .table-responsive table th:first-child, 
    .table-responsive table td:first-child { 
        position: sticky; left: 0; background: white; z-index: 2; border-right: 2px solid #dee2e6 !important; 
    }
    .table-responsive table th:first-child { background: #f6f9ff; z-index: 3; }
    .btn-group .btn {
        min-width: 80px;
    }
</style>

@endsection