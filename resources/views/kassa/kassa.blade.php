@extends('layouts.admin')
@section('title', 'Kassa nazorati')

@section('content')

<div class="pagetitle">
    <h1>Kassa nazorati</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
            <li class="breadcrumb-item active">Kassa</li>
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
                            <h5 class="card-title p-0 mb-3 text-success">Kassada mavjud <span>| Jami balans</span></h5>
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-success mb-1"><i class="bi bi-cash-stack fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->naqt, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">Naqd</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-primary mb-1"><i class="bi bi-credit-card fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->card, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">Plastik</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-info mb-1"><i class="bi bi-bank fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->bank, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">Bank</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="row">
                        <div class="col-6"><button class="btn w-100 btn-outline-success" data-bs-toggle="modal" data-bs-target="#chiqim_post">
                            <i class="bi bi-arrow-up-right-circle d-block d-md-inline"></i> Chiqim
                        </button></div>
                        <div class="col-6"><button class="btn w-100 btn-outline-primary" data-bs-toggle="modal" data-bs-target="#xarajat">
                            <i class="bi bi-cart-dash d-block d-md-inline"></i> Xarajat
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
                            <h5 class="card-title p-0 mb-3 text-warning">Tasdiqlash kutilayotgan <span>(chiqimlar, xarajatlar, to'lovlar)</span></h5>
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->pending_naqt, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">Naqd</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->pending_card, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">Plastik</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="op-card rounded p-2 text-center bg-light">
                                        <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                                        <h5 class="mb-0">{{ number_format($kassa->pending_bank, 0, '.', ' ') }}</h5>
                                        <div class="text-muted small">Bank</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="row">
                        <div class="col-6"><button class="btn w-100 btn-outline-danger" data-bs-toggle="modal" data-bs-target="#qytarilgan_tulov">
                            <i class="bi bi-arrow-counterclockwise d-block d-md-inline"></i> Qaytarish
                        </button></div>
                        <div class="col-6"><button class="btn w-100 btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#chegirmalar">
                            <i class="bi bi-percent d-block d-md-inline"></i> Chegirma
                        </button></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tasdiqlanmagan operatsiyalar jadvali --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-danger">Tasdiqlanmagan operatsiyalar</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" style="font-size: 14px;">
                            <thead class="bg-light text-center text-nowrap">
                                <tr>
                                    <th>#</th>
                                    <th>Summa</th>
                                    <th>Tur</th>
                                    <th class="d-none d-md-table-cell">Izoh</th>
                                    <th>Vaqt</th>
                                    <th class="d-none d-md-table-cell">Menejer</th>
                                    <th>Amal</th>
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
                                          (Naqd)
                                        @elseif($item->payment_method=='card')
                                          (Plastik)
                                        @else
                                          (Bank)
                                        @endif
                                      </small>
                                    </td>
                                    <td class="text-center">
                                      @if($item->type=='KassaToBalans')
                                        Kassadan chiqim
                                      @else
                                        Xarajat
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
                                  <td colspan="7" class="text-center">Tasdiqlanmagan operatsiyalar yo'q</td>
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
            <h5 class="modal-title">Kassadan xarajat uchun chiqim qilish</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label for="amount" class="mb-2">Xarajat summasi</label>
            <input type="text" class="form-control" id="amount" name="amount" required>
            <label for="payment_method" class="my-2">Xarajat turi</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
              <option value="">Tanlang</option>
              <option value="cash">Naqt</option>
              <option value="card">Karta</option>
              <option value="bank">Bank</option>
            </select>
            <label for="description" class="my-2"></label>
            <textarea name="description" class="form-control" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
            <button type="submit" class="btn btn-primary">Saqlash</button>
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
            <h5 class="modal-title">Kassadan xarajat uchun chiqim qilish</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label for="amount" class="mb-2">Xarajat summasi</label>
            <input type="text" class="form-control" id="amount2" name="amount" required>
            <label for="payment_method" class="my-2">Xarajat turi</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
              <option value="">Tanlang</option>
              <option value="cash">Naqt</option>
              <option value="card">Karta</option>
              <option value="bank">Bank</option>
            </select>
            <label for="description" class="my-2">Izoh</label>
            <textarea name="description" class="form-control" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
            <button type="submit" class="btn btn-primary">Saqlash</button>
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
          <h5 class="modal-title">Qaytarilgan to'lovlar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="p-0">Ogirgi 45 kunda qaytarib berilgan to'lovlar</p>
          <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px;">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">Bola</th>
                  <th scope="col">Qaytarilgan summa</th>
                  <th scope="col">To'lov turi</th>
                  <th scope="col">Izoh</th>
                  <th scope="col">Meneger</th>
                  <th scope="col">Qaytarilgan vaqt</th>
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
                        Naqd
                      @elseif($item->payment_method=='card')
                        Plastik
                      @else
                        Bank
                      @endif
                    </td>
                    <td class="text-center">{{ $item->comment }}</td>
                    <td class="text-center">{{ $item->admin->name }}</td>
                    <td class="text-center">{{ $item->created_at }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center">Qaytarilgan to'lovlar mavjud emas</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Chegirmalar -->
  <div class="modal fade" id="chegirmalar" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Chegirmalar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="p-0">Ogirgi 45 kunda berilgan chegirmalar</p>
          <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px;">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">Bola</th>
                  <th scope="col">Qaytarilgan summa</th>
                  <th scope="col">To'lov turi</th>
                  <th scope="col">Izoh</th>
                  <th scope="col">Meneger</th>
                  <th scope="col">Qaytarilgan vaqt</th>
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
                        Naqd
                      @elseif($item->payment_method=='card')
                        Plastik
                      @else
                        Bank
                      @endif
                    </td>
                    <td class="text-center">{{ $item->comment }}</td>
                    <td class="text-center">{{ $item->admin->name }}</td>
                    <td class="text-center">{{ $item->created_at }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center">Qaytarilgan to'lovlar mavjud emas</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
        </div>
      </div>
    </div>
  </div>

@endsection