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
        <!-- Balansda mavjud -->
        <div class="col-lg-7">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title w-100 text-center">Balansda mavjud</h5>
                <div class="row g-2">
                  <div class="col-lg-4">
                      <div class="op-card rounded p-2 text-center bg-light">
                          <div class="text-success mb-1"><i class="bi bi-cash-stack fs-4"></i></div>
                          <h5 class="mb-0">{{ number_format($moliya->cash, 0, '.', ' ') }}</h5>
                          <div class="text-muted small">Naqd</div>
                      </div>
                      <button class="btn btn-outline-danger w-100 mt-2" data-bs-toggle="modal" data-bs-target="#xarajat">Xarajat</button>
                  </div>
                  <div class="col-lg-4">
                      <div class="op-card rounded p-2 text-center bg-light">
                          <div class="text-primary mb-1"><i class="bi bi-credit-card fs-4"></i></div>
                          <h5 class="mb-0">{{ number_format($moliya->card, 0, '.', ' ') }}</h5>
                          <div class="text-muted small">Plastik</div>
                      </div>
                      <button class="btn btn-outline-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#daromad">Daromad</button>
                  </div>
                  <div class="col-lg-4">
                      <div class="op-card rounded p-2 text-center bg-light">
                          <div class="text-info mb-1"><i class="bi bi-bank fs-4"></i></div>
                          <h5 class="mb-0">{{ number_format($moliya->bank, 0, '.', ' ') }}</h5>
                          <div class="text-muted small">Bank</div>
                      </div>
                      <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#balansToKassa">Kassaga qaytarish</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Kutilayotgan to'lovlar -->
        <div class="col-lg-5">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title w-100 text-center">To'lov kutilmoqda</h5>
              <div class="row g-2">
                <div class="col-lg-6">
                  <div class="op-card rounded p-2 text-center bg-light">
                    <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                    <h5 class="mb-0">{{ number_format($moliya->pending_card, 0, '.', ' ') }}</h5>
                    <div class="text-muted small">Plastik</div>
                  </div>
                  <button class="btn btn-outline-warning text-dark w-100 mt-2" data-bs-toggle="modal" data-bs-target="#pendingPaymart">Tasdiqlanmagan to'lovlar</button>
                </div>
                <div class="col-lg-6">
                  <div class="op-card rounded p-2 text-center bg-light">
                    <div class="text-warning mb-1"><i class="bi bi-hourglass-split fs-4"></i></div>
                    <h5 class="mb-0">{{ number_format($moliya->pending_bank, 0, '.', ' ') }}</h5>
                    <div class="text-muted small">Bank</div>
                  </div>
                  <button class="btn btn-outline-danger w-100 mt-2" data-bs-toggle="modal" data-bs-target="#canceledPaymart">Bekor qilinganlar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Balans tarixi -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Balans tarixi</h5>
              <p>Oxirgi 45 kunlik hisobot</p>
                <div class="notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center bg-light">
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col">Summa</th>
                        <th scope="col">To'lov turi</th>
                        <th scope="col">Status</th>
                        <th scope="col">Izoh</th>
                        <th scope="col">To'lov vaqti</th>
                        <th scope="col">Meneger</th>
                        <th scope="col">Tasdiqlangan vaqt</th>
                        <th scope="col">Tasdiqladi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($moliyaHistory as $item)
                        <tr class="text-center">
                          <td>{{ $loop->iteration }}</td>
                          <td>
                            {{ $item->type }}
                          </td>
                          <td>{{ number_format($item->amount, 0, '.', ' ') }}</td>
                          <td>
                            @if($item->payment_method=='cash')
                              Naqd
                            @elseif($item->payment_method=='card')
                              Plastik
                            @else
                              Bank
                            @endif
                          </td>
                          <td>
                            @if($item->status == 'success')
                              <span class="badge bg-success">Tasdiqlangan</span>
                            @else
                              <span class="badge bg-danger">Bekor qilingan</span>
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
                          <td colspan="9" class="text-center">Ma'lumot yo'q</td>
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
          <h5 class="modal-title">Xarajat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="amount" class="mb-2">Xarajat summasi</label>
          <input type="text" name="amount" class="form-control" id="amount" required>
          <label for="payment_method" class="my-2">Xarajat turi</label>
          <select name="payment_method" class="form-select" required>
            <option value="">Tanlang...</option>
            <option value="cash">Naqt</option>
            <option value="card">Karta</option>
            <option value="bank">Bank</option>
          </select>
          <label for="description" class="my-2">Xarajat haqida</label>
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
<!-- Daromad Model -->
<div class="modal" id="daromad" tabindex="-1">
  <form action="{{ route('moliya_balans_to_daromad') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Daromad</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="amount" class="mb-2">Daromad summasi</label>
          <input type="text" name="amount" class="form-control" id="amount" required>
          <label for="payment_method" class="my-2">Daromad turi</label>
          <select name="payment_method" class="form-select" required>
            <option value="">Tanlang...</option>
            <option value="cash">Naqt</option>
            <option value="card">Karta</option>
            <option value="bank">Bank</option>
          </select>
          <label for="description" class="my-2">Daromad haqida</label>
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
<!-- BalansToKassa Model -->
<div class="modal" id="balansToKassa" tabindex="-1">
  <form action="{{ route('moliya_balans_to_kassa') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Balansdan kassaga o'tqazma</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="amount" class="mb-2">O'tqazma summasi</label>
          <input type="text" name="amount" class="form-control" id="amount" required>
          <label for="payment_method" class="my-2">O'tqazma turi</label>
          <select name="payment_method" class="form-select" required>
            <option value="">Tanlang...</option>
            <option value="cash">Naqt</option>
            <option value="card">Karta</option>
            <option value="bank">Bank</option>
          </select>
          <label for="description" class="my-2">O'tqazma haqida</label>
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
<!-- Tasdiqlanmagan to'lovlar -->
<div class="modal fade" id="pendingPaymart" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tasdiqlanmagan to'lovlar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle" style="font-size: 13px;">
            <thead class="bg-light text-center text-nowrap">
                <tr>
                    <th>#</th>
                    <th>Bola</th>
                    <th>Summa</th>
                    <th>To'lov turi</th>
                    <th>To'lov haqida</th>
                    <th>Menejer</th>
                    <th>To'lov vaqti</th>
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
                        Naqd
                      @elseif($item->payment_method=='card')
                        Plastik
                      @else
                        Bank
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
                    <td colspan="9" class="text-center">Hech qanday to'lov topilmadi</td>
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
<!-- Bekor qilingan to'lovlar -->
<div class="modal fade" id="canceledPaymart" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bekor qilingan to'lovlar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Oxirgi 45 kun ichidagi bekor qilingan to'lovlar</p>
        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle" style="font-size: 13px;">
            <thead class="bg-light text-center text-nowrap">
                <tr>
                    <th>#</th>
                    <th>Bola</th>
                    <th>Summa</th>
                    <th>To'lov turi</th>
                    <th>To'lov haqida</th>
                    <th>Menejer</th>
                    <th>To'lov vaqti</th>
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
                        Naqd
                      @elseif($item->payment_method=='card')
                        Plastik
                      @else
                        Bank
                      @endif
                    </td>
                    <td>{{ $item->comment }}</td>
                    <td class="text-center">{{ $item->admin->name }}</td>
                    <td class="text-center">{{ $item->created_at }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9" class="text-center">Hech qanday to'lov topilmadi</td>
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