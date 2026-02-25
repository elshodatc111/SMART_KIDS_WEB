@extends('layouts.admin')
@section('title', __('kassa.kassa'))

@section('content')

<div class="pagetitle">
    <h1>{{ __('kassa.kassa') }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('kassa.kassa') }}</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <div class="col-6">
            <div class="card info-card">
                <div class="card-body pt-3">
                    <div class="row g-3">
                        <div class="col-12 col-xl-12 border-xl-end">
                            <h5 class="card-title p-0 mb-3 text-success">{{ __('kassa.kassa_mavjud') }} <span>| {{ __('kassa.jami_balans') }}</span></h5>
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-success mb-1"><i class="bi bi-cash-stack fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->naqt, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">{{ __('kassa.naqt') }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-primary mb-1"><i class="bi bi-credit-card fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->card, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">{{ __('kassa.plastik') }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-info mb-1"><i class="bi bi-bank fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->bank, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">{{ __('kassa.bank') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="row">
                        <div class="col-6"><button class="btn w-100 btn-outline-success" data-bs-toggle="modal" data-bs-target="#chiqim_post">
                            <i class="bi bi-arrow-up-right-circle d-block d-md-inline"></i> {{ __('kassa.chiqim') }}
                        </button></div>
                        <div class="col-6"><button class="btn w-100 btn-outline-primary" data-bs-toggle="modal" data-bs-target="#xarajat">
                            <i class="bi bi-cart-dash d-block d-md-inline"></i> {{ __('kassa.xarajat') }}
                        </button></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card info-card">
                <div class="card-body pt-3">
                    <div class="row g-3">
                        <div class="col-12 col-xl-12">
                            <h5 class="card-title p-0 mb-3 text-warning">{{ __('kassa.tasdiqlanmagan_operatsiyalar') }} <span>({{__('kassa.chiqim_xarajatlar_tulovlar')}})</span></h5>
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->pending_naqt, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">{{ __('kassa.naqt') }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->pending_card, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">{{ __('kassa.plastik') }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->pending_bank, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">{{ __('kassa.bank') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="row">
                        <div class="col-6"><button class="btn w-100 btn-outline-danger" data-bs-toggle="modal" data-bs-target="#qytarilgan_tulov">
                            <i class="bi bi-arrow-counterclockwise d-block d-md-inline"></i> {{ __('kassa.qaytarish') }}
                        </button></div>
                        <div class="col-6"><button class="btn w-100 btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#chegirmalar">
                            <i class="bi bi-percent d-block d-md-inline"></i> {{ __('kassa.chegirma') }}
                        </button></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tasdiqlanmagan operatsiyalar jadvali --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-danger">{{ __('kassa.tasdiqlanmagan_operatsiyalar') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" style="font-size: 14px;">
                            <thead class="bg-light text-center text-nowrap">
                                <tr>
                                    <th>#</th>
                                    <th>{{__('kassa.summa')}}</th>
                                    <th>{{__('kassa.turi')}}</th>
                                    <th class="d-none d-md-table-cell">{{__('kassa.izoh')}}</th>
                                    <th>{{__('kassa.vaqt')}}</th>
                                    <th class="d-none d-md-table-cell">{{__('kassa.meneger')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($pending as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-nowrap font-monospace text-center">
                                      {{ number_format($item->amount, 0, '.', ' ') }} 
                                      <small>
                                        @if($item->payment_method=='cash')
                                          ({{__('kassa.naqt')}})
                                        @elseif($item->payment_method=='card')
                                          ({{__('kassa.plastik')}})
                                        @else
                                          ({{__('kassa.bank')}})
                                        @endif
                                      </small>
                                    </td>
                                    <td class="text-center">
                                      @if($item->type=='KassaToBalans')
                                        {{ __('kassa.kassadan_chiqim')}}
                                      @else
                                        {{__('kassa.kassadan_xarajat')}}
                                      @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">{{ $item->description }}</td>
                                    <td class="text-center">{{ $item->created_at }}</td>
                                    <td class="d-none d-md-table-cell text-center small">{{ optional($item->meneger)->name ?? 'N/A' }}</td>
                                    <td class="d-flex gap-1 text-center justify-content-center">
                                        <form action="{{ route('moliya_pending_success') }}" method="post">
                                            @csrf 
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('moliya_pending_canceled')  }}" method="post">
                                            @csrf 
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                <tr>
                                  <td colspan="7" class="text-center">{{ __('kassa.tasdiqlanmagan_operatsiyalar_yoq') }}</td>
                                </tr>
                              @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



  <!-- Chiqim Modal -->
  <div class="modal" id="chiqim_post" tabindex="-1">
    <form action="{{ route('moliya_kassa_chiqim') }}" method="post">
      @csrf 
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ __('kassa.kassadan_chiqim') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label for="amount" class="mb-2">{{ __('kassa.chiqim_summa') }}</label>
            <input type="text" class="form-control" id="amount" name="amount" required>
            <label for="payment_method" class="my-2">{{ __('kassa.chiqim_turi') }}</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
              <option value="">{{ __('kassa.tanlang') }}</option>
              <option value="cash">{{ __('kassa.naqt') }}</option>
              <option value="card">{{ __('kassa.plastik') }}</option>
              <option value="bank">{{ __('kassa.bank') }}</option>
            </select>
            <label for="description" class="my-2">{{ __('kassa.chiqim_izoh') }}</label>
            <textarea name="description" class="form-control" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('kassa.bekor_qilish') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('kassa.saqlash') }}</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- Xarajat Modal -->
  <div class="modal" id="xarajat" tabindex="-1">
    <form action="{{ route('moliya_kassa_xarajat') }}" method="post">
      @csrf 
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ __('kassa.kassadan_xarajat')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label for="amount" class="mb-2">{{ __('kassa.xarajat_summa') }}</label>
            <input type="text" class="form-control" id="amount2" name="amount" required>
            <label for="payment_method" class="my-2">{{ __('kassa.xarajat_turi') }}</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
              <option value="">{{ __('kassa.tanlang') }}</option>
              <option value="cash">{{ __('kassa.naqt') }}</option>
              <option value="card">{{ __('kassa.plastik') }}</option>
              <option value="bank">{{ __('kassa.bank') }}</option>
            </select>
            <label for="description" class="my-2">{{ __('kassa.xarajat_haqida') }}</label>
            <textarea name="description" class="form-control" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('kassa.bekor_qilish') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('kassa.saqlash') }}</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- Qaytarilgan to'lovlar -->
  <div class="modal fade" id="qytarilgan_tulov" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('kassa.qaytarilgan_tulovlar') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="p-0">{{ __('kassa.45kunda_qaytarilgan_tulovlar') }}</p>
          <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px;">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">{{ __('kassa.bola') }}</th>
                  <th scope="col">{{ __('kassa.qaytarilgan_summa') }}</th>
                  <th scope="col">{{ __('kassa.tolov_turi') }}</th>
                  <th scope="col">{{ __('kassa.izoh') }}</th>
                  <th scope="col">{{ __('kassa.meneger') }}</th>
                  <th scope="col">{{ __('kassa.qaytarilgan_vaqt') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($qaytar as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td><a href="{{ route('kid_show', $item->kid_id) }}">{{ $item->kid->child_full_name }}</a></td>
                    <td class="text-center">{{ number_format($item->amount, 0, '.', ' ') }} UZS</td>
                    <td class="text-center">
                      @if($item->payment_method=='cash')
                        {{ __('kassa.naqt') }}
                      @elseif($item->payment_method=='card')
                        {{ __('kassa.plastik') }}
                      @else
                        {{ __('kassa.bank') }}
                      @endif
                    </td>
                    <td class="text-center">{{ $item->comment }}</td>
                    <td class="text-center">{{ $item->admin->name }}</td>
                    <td class="text-center">{{ $item->created_at }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center">{{ __('kassa.qaytarilgan_tulovlar_mavjud_emas') }}</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('kassa.bekor_qilish') }}</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Chegirmalar -->
  <div class="modal fade" id="chegirmalar" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('kassa.chegirmalar') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="p-0">{{ __('kassa.45kunda_berilgan_chegirmalar') }}</p>
          <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px;">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">{{ __('kassa.bola') }}</th>
                  <th scope="col">{{ __('kassa.chegirma_summa') }}</th>
                  <th scope="col">{{ __('kassa.tolov_turi') }}</th>
                  <th scope="col">{{ __('kassa.izoh') }}</th>
                  <th scope="col">{{ __('kassa.meneger') }}</th>
                  <th scope="col">{{ __('kassa.chegirma_vaqt') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($chegirma as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td><a href="{{ route('kid_show', $item->kid_id) }}">{{ $item->kid->child_full_name }}</a></td>
                    <td class="text-center">{{ number_format($item->amount, 0, '.', ' ') }} UZS</td>
                    <td class="text-center">
                      @if($item->payment_method=='cash')
                        {{ __('kassa.naqt') }}
                      @elseif($item->payment_method=='card')
                        {{ __('kassa.plastik') }}
                      @else
                        {{ __('kassa.bank') }}
                      @endif
                    </td>
                    <td class="text-center">{{ $item->comment }}</td>
                    <td class="text-center">{{ $item->admin->name }}</td>
                    <td class="text-center">{{ $item->created_at }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center">{{ __('kassa.chegirmalar_mavjud_emas') }}</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('kassa.bekor_qilish') }}</button>
        </div>
      </div>
    </div>
  </div>

@endsection