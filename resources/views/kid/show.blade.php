@extends('layouts.admin')
@section('title', 'Bosh sahifa | NiceAdmin')
@section('content')
    <div class="pagetitle">
      <h1>Tarbiyalanuvchi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('kids') }}">{{ __('bolalar.title') }}</a></li>
          <li class="breadcrumb-item active">Tarbiyalanuvchi</li>
        </ol>
      </nav>
    </div><section class="section dashboard">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $kid->child_full_name }}</h5>
              <div class="row">
                <div class="col-6 mb-1">Balans:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ number_format($kid->amount, 0, '.', ' ') }} UZS</div>
                <div class="col-6 mb-1">Holati:</div>
                <div class="col-6 mb-1" style="text-align: right">
                  @if($kid->status=='true')
                    <span class="text-success">Aktiv</span>
                  @else
                    <span class="text-danger">NoAktiv</span>
                  @endif
                </div>
                <div class="col-6 mb-1">Guruh uchun to'lov oyi:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->payment_month!=null?$kid->payment_month:"-" }}</div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Shaxsiy malumoti</h5>
              <div class="row">
                <div class="col-6 mb-1">Guvohnoma raqami:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->certificate_serial }}</div>
                <div class="col-6 mb-1">Tug'ilgan kuni:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->tkun->format('Y-m-d') }}</div>
                <div class="col-6 mb-1">Jinsi:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->gender }}</div>
                <div class="col-6 mb-1">Ota-onasi:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->parent_full_name }}</div>
                <div class="col-6 mb-1">Telefon raqam:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $kid->phone1) }}</div>
                <div class="col-6 mb-1">Qo'shimcha telefon:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $kid->phone2) }}</div>
                <div class="col-6 mb-1">Manzil:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->address }}</div>
                <div class="col-6 mb-1">Izoh:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->admin_note }}</div>
                <div class="col-6 mb-1">Meneger:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->admin->name }}</div>
                <div class="col-6 mb-1">Ro'yhatga olindi:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->created_at }}</div>
                <div class="col-12">
                  <button class="btn btn-primary mt-2 w-100" data-bs-toggle="modal" data-bs-target="#taxrirlash"><i class="bi bi-pencil"></i> Taxrirlash</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Eslatmalar</h5>    
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <table class="table table-bordered table-hover" style="font-size: 12px">
                  <thead class="bg-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr class="text-center">
                      <th>Eslatma matni</th>
                      <th>Menejer</th>
                      <th>Vaqti</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($notes as $note)
                      <tr>
                        <td>{{ $note->text }}</td>
                        <td class="text-center text-nowrap">{{ $note->admin->name }}</td>
                        <td class="text-end text-nowrap">{{ $note->created_at->format('d.m.H:i') }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="3" class="text-center text-muted">Eslatmalar mavjud emas.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <hr>    
              <form action="{{ route('kids_note_create') }}" method="post">
                @csrf 
                <div class="row g-2"> <div class="col-9">
                    <input type="hidden" name="id" value="{{ $kid->id }}">
                    <input type="text" name="text" class="form-control" placeholder="Yangi eslatma..." required autocomplete="off">
                  </div>
                  <div class="col-3">
                    <button type="submit" class="btn btn-primary w-100">
                      <i class="bi bi-send"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body pb-0">
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">Tarbiyalanuvchi hisobini to'ldirish</h5>
                </div>
                <div class="col-6 pt-1" style="text-align: right">
                  <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#tulov"><i class="bi bi-plus"></i> To'lov</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Guruhlar tarixi</h5>
              <div class="table-responsive">
                <table class="table table-bordered" style="font-size: 14px">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Guruh</th>
                      <th scope="col">Guruhga qo'shildi</th>
                      <th scope="col">Meneger</th>
                      <th scope="col">Guruhdan o'chirildi</th>
                      <th scope="col">Meneger</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Guruh uchun to'lov</h5>
              <div class="table-responsive">
                <table class="table table-bordered" style="font-size: 14px">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Guruh</th>
                      <th scope="col">To'lov so'mmasi</th>
                      <th scope="col">To'lov vaqt</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
          
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">To'lovlar tarixi</h5>
              <div class="table-responsive">
                <table class="table table-bordered" style="font-size: 14px">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">To'lov summasi</th>
                      <th scope="col">To'lov turi</th>
                      <th scope="col">To'lov xolati</th>
                      <th scope="col">To'lov haqida</th>
                      <th scope="col">Meneger</th>
                      <th scope="col">To'lov vaqti</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>



<div class="modal" id="taxrirlash" tabindex="-1">
  <form action="{{ route('kids_update') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $kid->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Taxrirlash</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="child_full_name" class="mb-2">FIO</label>
          <input type="text" name="child_full_name" value="{{ $kid->child_full_name }}" class="form-control mb-2" required>
          <div class="row">
            <div class="col-6">
              <label for="tkun" class="mb-2">Tug'ilgan kuni</label>
              <input type="date" value="{{ $kid->tkun->format('Y-m-d') }}" name="tkun" class="form-control mb-2" required>
            </div>
            <div class="col-6">
              <label for="gender" class="mb-2">Jinsi</label>
              <select name="gender" class="form-select">
                  <option value="">Tanlang ...</option>
                  <option value="male" @selected($kid->gender == 'male')>O'g'il bola</option>
                  <option value="female" @selected($kid->gender == 'female')>Qiz bola</option>
              </select>
            </div>
          </div>
          <label for="parent_full_name" class="mb-2">Ota onasi</label>
          <input type="text" name="parent_full_name" value="{{ $kid->parent_full_name }}" class="form-control mb-2" required>
          <div class="row">
            <div class="col-6">
              <label for="" class="mb-2">Telefon raqam</label>
              <input type="text" name="phone1" class="form-control mb-2 phone" value="{{ $kid->phone1 }}" required>
            </div>
            <div class="col-6">
              <label for="" class="mb-2">Qo'shimcha telefon</label>
              <input type="text" name="phone2" class="form-control mb-2 phone" value="{{ $kid->phone2 }}" required>
            </div>
          </div>
          <label for="address" class="mb-2">Manzil</label>
          <input type="text" name="address" value="{{ $kid->address }}" class="form-control mb-2" required>
          <label for="admin_note" class="mb-2">Izoh</label>
          <input type="text" name="admin_note" value="{{ $kid->admin_note }}" class="form-control mb-2" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal" id="tulov" tabindex="-1">
  <form action="{{ route('kids_payment_create') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $kid->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">To'lov qilish</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">              
              <div class="mb-2">
                <label for="tranzaksion" class="mb-2">Tranzaksiya</label>
                <select name="tranzaksion" class="form-select" required>
                  <option value="payment">To'lov</option>
                  <option value="discount">Chegirma</option>
                  <option value="return">To'lov qaytarish</option>
                </select>
              </div>
            </div>
            <div class="col-6">              
              <div class="mb-2">
                <label for="type" class="mb-2">To'lov turi</label>
                <select name="type" class="form-select" required>
                  <option value="">Tanlang...</option>
                  <option value="naqt">Naqt</option>
                  <option value="card">Plastik</option>
                  <option value="bank">Bank</option>
                </select>
              </div>
            </div>
          </div>
          <div class="mb-2">
            <label for="amount" class="mb-2">To'lov so'masi</label>
            <input type="text" name="amount" class="form-control" id="amount" required>
          </div>
          <div class="mb-2">
            <label for="description" class="mb-2">To'lov haqida</label>
            <textarea name="description" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection