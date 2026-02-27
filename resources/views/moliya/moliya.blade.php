@extends('layouts.admin')
@section('title', __('moliya.moliya'))
@section('content')
<div class="pagetitle">
  <h1>{{ __('moliya.moliya') }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
      <li class="breadcrumb-item active">{{ __('moliya.moliya') }}</li>
    </ol>
  </nav>
</div><section class="section dashboard">
  <div class="row">
    <!-- Balansda mavjud -->
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title w-100 text-center">{{ __('moliya.balansda_mavjud') }}</h5>
            <div class="row g-2">
              <div class="col-lg-4">
                  <div class="op-card rounded p-2 text-center bg-light">
                      <div class="text-success mb-1"><i class="bi bi-cash-stack fs-4"></i></div>
                      <h5 class="mb-0">{{ number_format($moliya->cash, 0, '.', ' ') }}</h5>
                      <div class="text-muted small">{{ __('moliya.naqt') }}</div>
                  </div>
                  <button class="btn btn-outline-danger w-100 mt-2" data-bs-toggle="modal" data-bs-target="#xarajat">{{ __('moliya.xarajat') }}</button>
              </div>
              <div class="col-lg-4">
                  <div class="op-card rounded p-2 text-center bg-light">
                      <div class="text-primary mb-1"><i class="bi bi-credit-card fs-4"></i></div>
                      <h5 class="mb-0">{{ number_format($moliya->card, 0, '.', ' ') }}</h5>
                      <div class="text-muted small">{{ __('moliya.card') }}</div>
                  </div>
                  <button class="btn btn-outline-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#daromad">{{ __('moliya.daromad') }}</button>
              </div>
              <div class="col-lg-4">
                  <div class="op-card rounded p-2 text-center bg-light">
                      <div class="text-info mb-1"><i class="bi bi-bank fs-4"></i></div>
                      <h5 class="mb-0">{{ number_format($moliya->bank, 0, '.', ' ') }}</h5>
                      <div class="text-muted small">{{ __('moliya.bank') }}</div>
                  </div>
                  <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#balansToKassa">{{ __('moliya.kassaga_qaytarish') }}</button>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Kutilayotgan to'lovlar -->
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title w-100 text-center">{{ __('moliya.tolov_kutilmoqda') }}</h5>
          <div class="row g-2">
            <div class="col-lg-6">
              <div class="op-card rounded p-2 text-center bg-light">
                <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                <h5 class="mb-0">{{ number_format($moliya->pending_card, 0, '.', ' ') }}</h5>
                <div class="text-muted small">{{ __('moliya.card') }}</div>
              </div>
              <button class="btn btn-outline-warning text-dark w-100 mt-2" data-bs-toggle="modal" data-bs-target="#pendingPaymart">{{ __('moliya.tasdiqlanmagan_tolovlar') }}</button>
            </div>
            <div class="col-lg-6">
              <div class="op-card rounded p-2 text-center bg-light">
                <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                <h5 class="mb-0">{{ number_format($moliya->pending_bank, 0, '.', ' ') }}</h5>
                <div class="text-muted small">{{ __('moliya.bank') }}</div>
              </div>
              <button class="btn btn-outline-danger w-100 mt-2" data-bs-toggle="modal" data-bs-target="#canceledPaymart">{{ __('moliya.bekor_qilingan_tolovlar') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Balans tarixi -->
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ __('moliya.balans_tarixi') }}</h5>
          <p>{{ __('moliya.45kunlik_balans_tarixi') }}</p>
            <div class="notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;">
            <div class="table-responsive">
              <table class="table table-bordered" style="font-size: 14px">
                <thead>
                  <tr class="text-center bg-light">
                    <th scope="col">#</th>
                    <th scope="col">{{ __('moliya.status') }}</th>
                    <th scope="col">{{ __('moliya.summa') }}</th>
                    <th scope="col">{{ __('moliya.tolov_turi')}}</th>
                    <th scope="col">{{ __('moliya.status') }}</th>
                    <th scope="col">{{ __('moliya.izoh')}}</th>
                    <th scope="col">{{ __('moliya.tolov_vaqti')}}</th>
                    <th scope="col">{{ __('moliya.meneger')}}</th>
                    <th scope="col">{{ __('moliya.tasdiqlangan_vaqt') }}</th>
                    <th scope="col">{{ __('moliya.tasdiqlandi') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($moliyaHistory as $item) 
                    <tr class="text-center">
                      <td>{{ $loop->iteration }}</td>
                      <td> <!-- '','','','','','' -->
                        @if($item->type=='tulov')
                          <span class='text-success'>{{ __('moliya.tolov') }}</span>
                        @elseif($item->type=='xarajat')
                          <span class='text-danger'>{{ __('moliya.xarajat') }}</span>
                        @elseif($item->type=='KassaToBalans')
                          <span class='text-dark'>{{ __('moliya.balansga_kirim') }}</span>
                        @elseif($item->type=='BalansToKassa')
                          <span class='text-warning'>{{ __('moliya.balansdan_chiqim') }}</span>
                        @elseif($item->type=='daromad')
                          <span class='text-success'>{{ __('moliya.daromad') }}</span>
                        @elseif($item->type=='ish_haqi')
                          <span class='text-primary'>{{ __('moliya.ish_haqi') }}</span>
                        @endif
                      </td>
                      <td>{{ number_format($item->amount, 0, '.', ' ') }}</td>
                      <td>
                        @if($item->payment_method=='cash')
                          {{ __('moliya.naqt') }}
                        @elseif($item->payment_method=='card')
                          {{ __('moliya.card') }}
                        @else
                          {{ __('moliya.bank') }}
                        @endif
                      </td>
                      <td>
                        @if($item->status == 'success')
                          <span class="badge bg-success">{{ __('moliya.tasdiqlandi')}}</span>
                        @else
                          <span class="badge bg-danger">{{ __('moliya.bekor_qilindi') }}</span>
                        @endif
                      </td>
                      <td>{{ $item->description }}</td>
                      <td>{{ $item->created_at }}</td>
                      <td>{{ $item->meneger ? $item->meneger->name : '   ' }}</td>
                      <td>{{ $item->updated_at }}</td>
                      <td>{{ $item->admin ? $item->admin->name : '   ' }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="9" class="text-center">{{ __('moliya.moliya_tarixi_mavjud_emas') }}</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Xarajat Model -->
<div class="modal" id="xarajat" tabindex="-1">
  <form action="{{ route('moliya_balans_to_xarajat') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('moliya.xarajat') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="amount" class="mb-2">{{ __('moliya.xarajat_summasi') }}</label>
          <input type="text" name="amount" class="form-control" id="amount" required>
          <label for="payment_method" class="my-2">{{ __('moliya.xarajat_turi') }}</label>
          <select name="payment_method" class="form-select" required>
            <option value="">{{ __('moliya.tanlang') }}</option>
            <option value="cash">{{ __('moliya.naqt') }}</option>
            <option value="card">{{ __('moliya.card') }}</option>
            <option value="bank">{{ __('moliya.bank') }}</option>
          </select>
          <label for="description" class="my-2">{{ __('moliya.xarajat_haqida') }}</label>
          <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('moliya.cancel') }}</button>
          <button type="submit" class="btn btn-primary">{{ __('moliya.save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Daromad Model -->
<div class="modal" id="daromad" tabindex="-1">
  <form action="{{ route('moliya_balans_to_daromad') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('moliya.daromad') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="amount" class="mb-2">{{ __('moliya.daromad_summasi') }}</label>
          <input type="text" name="amount" class="form-control" id="amount" required>
          <label for="payment_method" class="my-2">{{ __('moliya.daromad_turi') }}</label>
          <select name="payment_method" class="form-select" required>
            <option value="">{{ __('moliya.tanlang') }}</option>
            <option value="cash">{{ __('moliya.naqt') }}</option>
            <option value="card">{{ __('moliya.card') }}</option>
            <option value="bank">{{ __('moliya.bank') }}</option>
          </select>
          <label for="description" class="my-2">{{ __('moliya.daromad_haqida') }}</label>
          <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('moliya.cancel') }}</button>
          <button type="submit" class="btn btn-primary">{{ __('moliya.save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- BalansToKassa Model -->
<div class="modal" id="balansToKassa" tabindex="-1">
  <form action="{{ route('moliya_balans_to_kassa') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('moliya.balansdan_kassaga_orqazma') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="amount" class="mb-2">{{ __('moliya.otqazma_summasi') }}</label>
          <input type="text" name="amount" class="form-control" id="amount" required>
          <label for="payment_method" class="my-2">{{ __('moliya.otqazma_turi') }}</label>
          <select name="payment_method" class="form-select" required>
            <option value="">{{ __('moliya.tanlang') }}</option>
            <option value="cash">{{ __('moliya.naqt') }}</option>
            <option value="card">{{ __('moliya.card') }}</option>
            <option value="bank">{{ __('moliya.bank') }}</option>
          </select>
          <label for="description" class="my-2">{{ __('moliya.otqazma_haqida') }}</label>
          <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('moliya.cancel') }}</button>
          <button type="submit" class="btn btn-primary">{{ __('moliya.save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Tasdiqlanmagan to'lovlar -->
<div class="modal fade" id="pendingPaymart" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('moliya.tasdiqlanmagan_tolovlar') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle" style="font-size: 13px;">
            <thead class="bg-light text-center text-nowrap">
                <tr>
                    <th>#</th>
                    <th>{{ __('moliya.bola') }}</th>
                    <th>{{ __('moliya.summa') }}</th>
                    <th>{{ __('moliya.tolov_turi') }}</th>
                    <th>{{ __('moliya.tolov_haqida') }}</th>
                    <th>{{ __('moliya.meneger') }}</th>
                    <th>{{ __('moliya.tolov_vaqti') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pending as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td><a href="{{ route('kid_show', $item->kid->id) }}">{{ $item->kid->child_full_name }}</a></td>
                    <td class="text-center">{{ number_format($item->amount, 0, '.', ' ') }}</td>
                    <td class="text-center">
                      @if($item->payment_method=='cash')
                        {{ __('moliya.naqt') }}
                      @elseif($item->payment_method=='card')
                        {{ __('moliya.card') }}
                      @else
                        {{ __('moliya.bank') }}
                      @endif
                    </td>
                    <td>{{ $item->comment }}</td>
                    <td class="text-center">{{ $item->admin->name }}</td>
                    <td class="text-center">{{ $item->created_at }}</td>
                    <td>
                      <div class="d-flex justify-content-center gap-1">
                        <form action="{{ route('kids_payment_success', $item->id) }}" method="POST">
                          @csrf
                          <button class="btn btn-success btn-sm"><i class="bi bi-check-lg"></i></button>
                        </form>
                        <form action="{{ route('kids_payment_cancel', $item->id) }}" method="POST">
                          @csrf
                          <button class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9" class="text-center">{{ __('moliya.xech_qanday_tasdiqlanmagan_tolov_topilmadi') }}</td>
                  </tr>
                @endforelse
            </tbody>  
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('moliya.cancel') }}</button>
      </div>
    </div>
  </div>
</div>
<!-- Bekor qilingan to'lovlar -->
<div class="modal fade" id="canceledPaymart" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('moliya.bekor_qilingan_tolovlar') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>{{ __('moliya.45kun_ichida_qaytarilgan_tolovlar') }}</p>
        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle" style="font-size: 13px;">
            <thead class="bg-light text-center text-nowrap">
                <tr>
                    <th>#</th>
                    <th>{{ __('moliya.bola') }}</th>
                    <th>{{ __('moliya.summa') }}</th>
                    <th>{{ __('moliya.tolov_turi') }}</th>
                    <th>{{ __('moliya.tolov_haqida') }}</th>
                    <th>{{ __('moliya.meneger')}}</th>
                    <th>{{ __('moliya.tolov_vaqti') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($canceled as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td><a href="{{ route('kid_show', $item->kid->id) }}">{{ $item->kid->child_full_name }}</a></td>
                    <td class="text-center">{{ number_format($item->amount, 0, '.', ' ') }}</td>
                    <td class="text-center">
                      @if($item->payment_method=='cash')
                        {{ __('moliya.naqt') }}
                      @elseif($item->payment_method=='card')
                        {{ __('moliya.card') }}
                      @else
                        {{ __('moliya.bank') }}
                      @endif
                    </td>
                    <td>{{ $item->comment }}</td>
                    <td class="text-center">{{ $item->admin->name }}</td>
                    <td class="text-center">{{ $item->created_at }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9" class="text-center">{{ __('moliya.xech_qanday_qaytarilgan_tolov_topilmadi') }}</td>
                  </tr>
                @endforelse
            </tbody>  
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('moliya.cancel') }}</button>
      </div>
    </div>
  </div>
</div>
@endsection