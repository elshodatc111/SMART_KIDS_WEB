@extends('layouts.admin')
@section('title', __('emploes_page.hodim'))
@section('content')
    <div class="pagetitle">
      <h1>{{ __('emploes_page.hodim') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('emploes') }}">{{ __('menu.emploes') }}</a></li>
          <li class="breadcrumb-item active">{{ __('emploes_page.hodim') }}</li>
        </ol>
      </nav>
    </div><section class="section dashboard">
      <div class="row">

        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title w-100 text-center">{{ $user->name }}</h5>
              <table class="table table-bordered" style="font-size: 14px">
                <tr>
                  <th>{{ __('emploes_page.phone') }}</th>
                  <td style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $user->phone) }} </td>
                </tr>
                <tr>
                  <th>{{ __('emploes_page.phone') }}</th>
                  <td style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $user->phone_two) }}</td>
                </tr>
                <tr>
                  <th>{{ __('emploes_page.address') }}</th>
                  <td style="text-align: right">{{ $user->address??"-" }}</td>
                </tr>
                <tr>
                  <th>{{ __('emploes_page.amount') }}</th>
                  <td style="text-align: right">{{ number_format($user->amount, 0, '.', ' ') }} UZS</td>
                </tr>
                <tr>
                  <th>{{ __('emploes_page.birthday') }}</th>
                  <td style="text-align: right">{{ \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') }}</td>
                </tr>
                <tr>
                  <th>{{ __('emploes_page.passport_number') }}</th>
                  <td style="text-align: right">{{ $user->passport_number??"-" }}</td>
                </tr>
                <tr>
                  <th>{{ __('emploes_page.type') }}</th>
                  <td style="text-align: right">
                    @if($user->type == 'drektor')
                      {{ __('emploes_page.lavozim_drektor') }}
                    @elseif($user->type == 'admin')
                      {{ __('emploes_page.lavozim_admin') }}
                    @elseif($user->type == 'katta_tarbiyachi')
                      {{ __('emploes_page.lavozim_tarbiyachi') }}
                    @elseif($user->type == 'kichik_tarbiyachi')
                      {{ __('emploes_page.lavozim_yordamch_tarbiyachi') }}
                    @elseif($user->type == 'oshpaz')
                      {{ __('emploes_page.lavozim_oshpaz') }}
                    @elseif($user->type == 'teacher')
                      {{ __('emploes_page.lavozim_oqituvchi') }}
                    @elseif($user->type == 'farrosh')
                      {{ __('emploes_page.lavozim_farrosh') }}
                    @else
                      {{ __('emploes_page.lavozim_hodim') }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>{{ __('emploes_page.status') }}</th>
                  <td style="text-align: right">
                    @if($user->status == 'active') {{ __('emploes_page.status_active') }} @elseif($user->status == 'inactive') {{ __('emploes_page.status_noactive') }} @else {{ __('emploes_page.status_delete') }} @endif 
                  </td>
                </tr>
                <tr>
                  <td colspan="2">{{ $user->type_about??"-" }}</td>
                </tr>
              </table>              
              <button class="btn btn-outline-warning w-100"  data-bs-toggle="modal" data-bs-target="#taxrirlash"><i class="bi bi-pencil-square me-2"></i>{{ __('emploes_page.taxrirlash') }}</button>
              <button class="btn btn-outline-info my-2 w-100"  data-bs-toggle="modal" data-bs-target="#parol_yangilash"><i class="bi bi-key me-2"></i>{{ __('emploes_page.parolni_yangilash') }}</button>
              <button class="btn btn-outline-danger w-100"  data-bs-toggle="modal" data-bs-target="#hodim_ochirish"><i class="bi bi-trash3 me-2"></i>{{ __('emploes_page.hodimni_ochirish') }}</button>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ __('emploes_page.hodim_davomadi') }}</h5>
                  <div class="notes-wrapper" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                    <div class="table-responsive">
                      <table class="table table-bordered" style="font-size: 14px">
                        <thead>
                          <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">{{ __('emploes_page.davomad_sanasi') }}</th>
                            <th scope="col">{{ __('emploes_page.davomad_holati') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($davomad as $item)
                            <tr class="text-center">
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $item->attendance_date->format('d.m.Y') }}</td>
                              <td>
                                @if($item->status  == 'keldi')
                                  <span class="badge bg-success">{{ __('emploes_page.keldi') }}</span>
                                @elseif($item->status  == 'kechikdi')
                                  <span class="badge bg-warning">{{ __('emploes_page.kechikdi') }}</span>
                                @else
                                  <span class="badge bg-danger">{{ __('emploes_page.kelmadi') }}</span>
                                @endif
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="3" class="text-center">{{ __('emploes_page.davomad_malumoti_majud_emas') }}</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ __('groups.eslatmalar') }}</h5>
                  <div class="notes-wrapper" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                    <table class="table table-bordered table-hover" style="font-size: 12px">
                      <thead class="bg-light" style="position: sticky; top: 0; z-index: 1;">
                        <tr class="text-center">
                          <th>{{ __('groups.eslatma_matni') }}</th>
                          <th>{{ __('groups.meneger') }}</th>
                          <th>{{ __('groups.eslatma_vaqti') }}</th>
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
                            <td colspan="3" class="text-center text-muted">{{ __('groups.eslatmalar_mavjud_emas') }}</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <hr>    
                  <form action="{{ route('emploes_eslatma_create') }}" method="post">
                    @csrf 
                    <div class="row g-2"> <div class="col-9">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="text" name="text" class="form-control" required autocomplete="off">
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
          </div>
          <!-- Tarbiyachi guruhlari -->
          @if($user->type == 'kichik_tarbiyachi' OR $user->type == 'katta_tarbiyachi')
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('emploes_page.tarbiyachi_guruhlari') }}</h5>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('emploes_page.guruh')}}</th>
                        <th scope="col">{{ __('emploes_page.guruh_holati') }}</th>
                        <th scope="col">{{ __('emploes_page.guruh_qoshildi') }}</th>
                        <th scope="col">{{ __('emploes_page.guruh_qoshdi') }}</th>
                        <th scope="col">{{ __('emploes_page.guruh_ochirildi') }}</th>
                        <th scope="col">{{ __('emploes_page.guruh_ochirdi') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($guruhlari as $key => $group)
                        <tr class="text-center">
                          <td>{{ $key + 1 }}</td>
                          <td><a href="{{ route('groups_show', $group->group->id) }}">{{ $group->group->group_name }}</a></td>
                          <td>
                            @if($group->status == 'active')
                            <span class="badge bg-success">{{ __('emploes_page.status_active') }}</span>
                            @else
                              <span class="badge bg-danger">{{ __('emploes_page.status_delete') }}</span>
                            @endif
                          </td>
                          <td>{{ $group->start_date->format('d.m.Y') }}</td>
                          <td>{{ $group->creatorAdmin->name ?? '-' }}</td>
                          <td>{{ $group->end_date ? $group->end_date->format('d.m.Y') : '-' }}</td>
                          <td>{{ $group->stopperAdmin->name ?? '-' }}</td>
                        </tr>
                      @empty
                        <tr>  
                          <td colspan="8" class="text-center">{{ __('emploes_page.tarbiyachi_guruhlari_mavjud_emas') }}</td> 
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endif
          <!-- Ish haqi to'lovlari -->
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">{{ __('emploes_page.ish_haqi_tolovlari')}}</h5>
                </div>
                <div class="col-6" style="text-align: right">
                  <button class="btn btn-primary mt-2"  data-bs-toggle="modal" data-bs-target="#ish_haqi_tulash"><i class="bi bi-cash"></i>{{ __('emploes_page.ish_haqi_tolash')}}</button>
                </div>
              </div>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('emploes_page.tolov_summasi') }}</th>
                        <th scope="col">{{ __('emploes_page.tolov_turi') }}</th>
                        <th scope="col">{{ __('emploes_page.tolov_haqida') }}</th>
                        <th scope="col">{{ __('emploes_page.tolov_vaqti') }}</th>
                        <th scope="col">{{ __('emploes_page.meneger') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($userPaymart as $key => $paymart)
                        <tr class="text-center">
                          <td>{{ $key + 1 }}</td>
                          <td>{{ number_format($paymart->amount, 0, '.', ' ') }}</td>
                          <td>{{ $paymart->description }}</td> 
                          <td>{{ $paymart->payment_method }}</td> 
                          <td>{{ $paymart->admin ? $paymart->admin->name : '-' }}</td>
                          <td>{{ $paymart->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center">{{ __('emploes_page.ish_haqi_tolov_mavjud_emas') }}</td>
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
<!-- Taxrirlash -->
<div class="modal" id="taxrirlash" tabindex="-1">
  <form action="{{ route('emploes_update') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('emploes_page.taxrirlash')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <label for="name" class="mb-2">{{ __('emploes_page.name') }}</label>
          <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
          <label for="phone" class="my-2">{{ __('emploes_page.phone') }}</label>
          <input type="text" name="phone" class="form-control phone" value="{{ $user->phone }}" required>
          <label for="phone_two" class="my-2">{{ __('emploes_page.phone') }}</label>
          <input type="text" name="phone_two" class="form-control phone" value="{{ $user->phone_two }}" required>
          <label for="address" class="my-2">{{ __('emploes_page.address') }}</label>
          <input type="text" name="address" class="form-control" value="{{ $user->address }}" required>
          <label for="amount" class="my-2">{{ __('emploes_page.amount') }}</label>
          <input type="text" name="amount" class="form-control" id="amount" value="{{ $user->amount }}" required>
          <div class="row">
            <div class="col-6">
              <label for="birthday" class="my-2">{{ __('emploes_page.birthday') }}</label>
              <input type="date" name="birthday" class="form-control" value="{{ \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') }}" required>
            </div>
            <div class="col-6">
              <label for="passport_number" class="my-2">{{ __('emploes_page.passport_number') }}</label>
              <input type="text" name="passport_number" class="form-control" value="{{ $user->passport_number }}" required>
            </div>
          </div>
          <label for="type_about" class="my-2">{{ __('emploes_page.type_about') }}</label>
          <input type="text" name="type_about" class="form-control" value="{{ $user->type_about }}" required>
          <label for="type" class="my-2">{{ __('emploes_page.type') }}</label>
          <select name="type" id="type" class="form-select">
            <option value="">{{ __('emploes_page.lavozim_tanlang') }}</option>
            <option value="drektor" @selected($user->type == 'drektor')>{{ __('emploes_page.lavozim_drektor') }}</option>
            <option value="admin" @selected($user->type == 'admin')>{{ __('emploes_page.lavozim_admin') }}</option>
            <option value="katta_tarbiyachi" @selected($user->type == 'katta_tarbiyachi')>{{ __('emploes_page.lavozim_tarbiyachi') }}</option>
            <option value="kichik_tarbiyachi" @selected($user->type == 'kichik_tarbiyachi')>{{ __('emploes_page.lavozim_yordamch_tarbiyachi') }}</option>
            <option value="oshpaz" @selected($user->type == 'oshpaz')>{{ __('emploes_page.lavozim_oshpaz') }}</option>
            <option value="teacher" @selected($user->type == 'teacher')>{{ __('emploes_page.lavozim_oqituvchi') }}</option>
            <option value="farrosh" @selected($user->type == 'farrosh')>{{ __('emploes_page.lavozim_farrosh') }}</option>
            <option value="hodim" @selected($user->type == 'hodim')>{{ __('emploes_page.lavozim_hodim') }}</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-primary">{{ __('emploes_page.save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Parolni yangilash -->
<div class="modal" id="parol_yangilash" tabindex="-1">
  <form action="{{ route('emploes_password_update') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('emploes_page.parolni_yangilash')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <p>{{ __('emploes_page.hodim_parli_yangilash') }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-primary">{{ __('emploes_page.save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Hodimni ochirish -->
<div class="modal" id="hodim_ochirish" tabindex="-1">
  <form action="{{ route('emploes_delete') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('emploes_page.xodimni_ochirish') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <p class="text-danger">{{ __('emploes_page.xodim_ochirish_izoh') }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-danger">{{ __('emploes_page.hodimni_ochirish') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Ish haqi to'lash modal -->
<div class="modal" id="ish_haqi_tulash" tabindex="-1">
  <form action="{{ route('emploes_payment_create') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('emploes_page.ish_haqi_tolash') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <label for="" class="mb-2">{{ __('emploes_page.tolov_turi') }}</label>
          <select name="payment_method" class="form-control" required>
            <option value="">{{ __('emploes_page.tanlang')}} </option>
            <option value="cash">{{ __('emploes_page.naqt')}}</option>
            <option value="card">{{ __('emploes_page.card')}}</option>
            <option value="bank">{{ __('emploes_page.bank')}}</option>
          </select>
          <label for="amount" class="my-2">{{ __('emploes_page.ish_haqi_summasi') }}</label>
          <input type="text" name="amount" id="amount" class="form-control" required>
          <label for="description" class="my-2">{{ __('emploes_page.tolov_haqida')}}</label>
          <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-primary">{{ __('emploes_page.save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection