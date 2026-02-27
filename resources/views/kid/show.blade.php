@extends('layouts.admin')
@section('title', __('bolalar_show.tarbiyalanuvchi'))
@section('content')
    <div class="pagetitle">
      <h1>{{ __('bolalar_show.tarbiyalanuvchi') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('kids') }}">{{ __('bolalar.title') }}</a></li>
          <li class="breadcrumb-item active">{{ __('bolalar_show.tarbiyalanuvchi') }}</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $kid->child_full_name }}</h5>
              <div class="row">
                <div class="col-6 mb-1">{{ __('bolalar_show.balans') }}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ number_format($kid->amount, 0, '.', ' ') }} UZS</div>
                <div class="col-6 mb-1">{{ __('bolalar_show.holati') }}:</div>
                <div class="col-6 mb-1" style="text-align: right">
                  @if($kid->status=='true')
                    <span class="text-success">{{ __('bolalar_show.activ') }}</span>
                  @else
                    <span class="text-danger">{{ __('bolalar_show.noactiv') }}</span>
                  @endif
                </div>
                <div class="col-6 mb-1">{{ __('bolalar_show.guruh_uchun_tolov_oyi') }}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->payment_month!=null?$kid->payment_month:"-" }}</div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('bolalar_show.shaxshiy')}}</h5>
              <div class="row">
                <div class="col-6 mb-1">{{ __('bolalar_show.guvohnoma')}}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->certificate_serial }}</div>
                <div class="col-6 mb-1">{{ __('bolalar_show.tkun')}}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->tkun->format('Y-m-d') }}</div>
                <div class="col-6 mb-1">{{ __('bolalar_show.jinsi')}}:</div>
                <div class="col-6 mb-1" style="text-align: right">
                  @if($kid->gender == 'male')
                    {{ __('bolalar_show.ogil_bola')}} 
                  @else
                    {{ __('bolalar_show.qiz_bola')}}
                  @endif
                </div>
                <div class="col-6 mb-1">{{ __('bolalar_show.ota_onasi' )}}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->parent_full_name }}</div>
                <div class="col-6 mb-1">{{ __('bolalar_show.phone') }}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $kid->phone1) }}</div>
                <div class="col-6 mb-1">{{ __('bolalar_show.qoshimcha_phone') }}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $kid->phone2) }}</div>
                <div class="col-6 mb-1">{{ __('bolalar_show.manzil')}}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->address }}</div>
                <div class="col-6 mb-1">{{ __('bolalar_show.izoh')}}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->admin_note }}</div>
                <div class="col-6 mb-1">{{ __('bolalar_show.meneger') }}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->admin->name }}</div>
                <div class="col-6 mb-1">{{ __('bolalar_show.royhatga_olindi')}}:</div>
                <div class="col-6 mb-1" style="text-align: right">{{ $kid->created_at }}</div>
                @if($kid->status!='delete')
                <div class="col-12">
                  <button class="btn btn-outline-primary mt-2 w-100" data-bs-toggle="modal" data-bs-target="#taxrirlash"><i class="bi bi-pencil"></i> {{ __('bolalar_show.taxrirlash')}}</button>
                  <button class="btn btn-outline-danger mt-2 w-100" data-bs-toggle="modal" data-bs-target="#delete"><i class="bi bi-trash"></i> {{ __('bolalar_show.bolani_ochirish')}}</button>
                </div>
                @endif
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('bolalar_show.eslatmalar')}}</h5>    
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <table class="table table-bordered table-hover" style="font-size: 12px">
                  <thead class="bg-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr class="text-center">
                      <th>{{ __('bolalar_show.eslatma_matni') }}</th>
                      <th>{{ __('bolalar_show.meneger')}}</th>
                      <th>{{ __('bolalar_show.vaqt')}}</th>
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
                        <td colspan="3" class="text-center text-muted">{{ __('bolalar_show.eslatmalar_mavjud_emas') }}</td>
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
        
        <div class="col-lg-8">
          @if($kid->status!='delete')
          <div class="card">
            <div class="card-body pb-0">
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">{{ __('bolalar_show.tolov') }}</h5>
                </div>
                <div class="col-6 pt-1" style="text-align: right">
                  <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#tulov"><i class="bi bi-plus"></i> {{ __('bolalar_show.tolov') }}</button>
                </div>
              </div>
            </div>
          </div>
          @endif
          <!-- Bolani davomadi --> 
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('bolalar_show.bolalar_davomadi') }}</h5>
              <div class="notes-wrapper" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('bolalar_show.guruh') }}</th>
                        <th scope="col">{{ __('bolalar_show.davomad_kuni')}}</th>
                        <th scope="col">{{ __('bolalar_show.davomad_holati') }}</th>
                        <th scope="col">{{ __('bolalar_show.meneger') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($davomad as $dav)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td><a href="{{ route('groups_show', $dav->group->id) }}">{{ $dav->group->group_name }}</a></td>
                          <td class="text-center">{{ $dav->attendance_date->format('d.m.Y') }}</td>
                          <td class="text-center">
                            @if($dav->status == 'keldi')
                              <span class="badge bg-success">{{ __('bolalar_show.keldi') }}</span>
                            @else
                              <span class="badge bg-danger">{{ __('bolalar_show.kelmadi') }}</span>
                            @endif
                          </td>
                          <td class="text-center">{{ $dav->creator->name ?? '-' }}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="5" class="text-center">{{ __('bolalar_show.davomad_mavjud_emas') }}</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Guruh uchun to'lovlar --> 
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('bolalar_show.guruh_uchun_tolovlar') }}</h5>
              <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('bolalar_show.guruh') }}</th>
                        <th scope="col">{{ __('bolalar_show.tolangan_oy') }}</th>
                        <th scope="col">{{ __('bolalar_show.tolov_summasi')}}</th>
                        <th scope="col">{{ __('bolalar_show.tolov_vaqti')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($group_pay as $item)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $item->group->group_name }}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($item->monch)->format('Y-m') }}</td>
                          <td class="text-center">{{ number_format($item->amount, 0, '.', ' ') }}</td>
                          <td class="text-center">{{ $item->created_at }}</td>
                        </tr>
                      @empty
                      <tr>
                        <td colspan="5" class="text-center">{{ __('bolalar_show.guruh_uchun_tolovlar_mavjud_emas')}}</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Guruhlar tarixi -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('bolalar_show.guruhlar_tarixi') }}</h5>
              <div class="notes-wrapper" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('bolalar_show.guruh') }}</th>
                        <th scope="col">{{ __('bolalar_show.guruhga_qoshildi') }}</th>
                        <th scope="col">{{ __('bolalar_show.izoh')}}</th>
                        <th scope="col">{{ __('bolalar_show.guruhga_qoshdi') }}</th>
                        <th scope="col">{{ __('bolalar_show.guruhdan_ochirildi') }}</th>
                        <th scope="col">{{ __('bolalar_show.guruhdan_ochirdi') }}</th> 
                        <th scope="col">{{ __('bolalar_show.guruhdagi_holati') }}</th> 
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($groups as $group)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td><a href="{{ route('groups_show', $group->group->id) }}">{{ $group->group->group_name }}</a></td>
                          <td class="text-center">{{ $group->start_date->format('d.m.Y') }}</td>
                          <td>{{ $group->description ?? '-' }}</td>
                          <td>{{ $group->startAdmin->name ?? '-' }}</td>
                          <td class="text-center">{{ $group->end_date ? $group->end_date->format('d.m.Y') : '-' }}</td>
                          <td>{{ $group->endAdmin->name ?? '-' }}</td>
                          <td class="text-center">
                            @if($group->status == 'active')
                              <span class="badge bg-success">{{ __('bolalar_show.activ') }}</span>
                            @else
                              <span class="badge bg-danger">{{ __('bolalar_show.ochirilgan') }}</span>
                            @endif
                          </td>
                        </tr>
                        @empty
                        <tr>
                          <td colspan="9" class="text-center">{{ __('bolalar_show.guruh_tarixi_mavjud_emas') }}</td> 
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- To'lovlar tarixi -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('bolalar_show.tolov_tarix') }}</h5>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('bolalar_show.tolov_summasi')}}</th>
                        <th scope="col">{{ __('bolalar_show.tolov_turi') }}</th>
                        <th scope="col">{{ __('bolalar_show.tolov_holati')}}</th>
                        <th scope="col">{{ __('bolalar_show.tolov_haqida') }}</th>
                        <th scope="col">{{ __('bolalar_show.meneger') }}</th>
                        <th scope="col">{{ __('bolalar_show.tolov_vaqti') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($paymarts as $paymart)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td class="text-center">{{ number_format($paymart->amount, 0, '.', ' ') }} UZS</td>
                          <td class="text-center">
                            @if($paymart->payment_type == 'payment')
                              <span class="badge bg-primary">{{ __('bolalar_show.tolov') }} ({{ $paymart->payment_method }})</span>
                            @elseif($paymart->payment_type == 'discount')
                              <span class="badge bg-warning">{{ __('bolalar_show.chegirma') }}</span>
                            @else
                              <span class="badge bg-danger">{{ __('bolalar_show.tolov_qaytar') }} ({{ $paymart->payment_method }})</span>
                            @endif
                          </td>
                          <td class="text-center">
                            @if($paymart->payment_status == 'success')
                              <span class="badge bg-success">{{ __('bolalar_show.tolangan') }}</span>
                            @elseif($paymart->payment_status == 'canceled')
                              <span class="badge bg-danger">{{ __('bolalar_show.cancel2') }}</span>
                            @else
                              <span class="badge bg-warning">{{ __('bolalar_show.kutilmoqda') }}</span>
                            @endif
                          </td>
                          <td>{{ $paymart->comment ?? '-' }}</td>
                          <td>{{ $paymart->admin->name ?? '-' }}</td>
                          <td class="text-center">{{ $paymart->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="7" class="text-center">{{ __('bolalar_show.tolovlar_mavjud_emas') }}</td>
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
<div class="modal" id="delete" tabindex="-1">
  <form action="{{ route('kids_delete') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $kid->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('bolalar_show.bolani_ochirish') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="child_full_name" class="mb-2 text-danger">{{ __('bolalar_show.bolani_ochirish_comment') }}</label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('bolalar_show.cancel') }}</button>
          <button type="submit" class="btn btn-danger">{{ __('bolalar_show.bolani_ochirish') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal" id="taxrirlash" tabindex="-1">
  <form action="{{ route('kids_update') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $kid->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('bolalar_show.taxrirlash') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="child_full_name" class="mb-2">{{ __('bolalar_show.fio') }}</label>
          <input type="text" name="child_full_name" value="{{ $kid->child_full_name }}" class="form-control mb-2" required>
          <div class="row">
            <div class="col-6">
              <label for="tkun" class="mb-2">{{ __('bolalar_show.tkun') }}</label>
              <input type="date" value="{{ $kid->tkun->format('Y-m-d') }}" name="tkun" class="form-control mb-2" required>
            </div>
            <div class="col-6">
              <label for="gender" class="mb-2">{{ __('bolalar_show.jinsi') }}</label>
              <select name="gender" class="form-select">
                  <option value="">{{ __('bolalar_show.tanlang') }}</option>
                  <option value="male" @selected($kid->gender == 'male')>{{ __('bolalar_show.ogil_bola') }}</option>
                  <option value="female" @selected($kid->gender == 'female')>{{ __('bolalar_show.qiz_bola') }}</option>
              </select>
            </div>
          </div>
          <label for="parent_full_name" class="mb-2">{{ __('bolalar_show.ota_onasi') }}</label>
          <input type="text" name="parent_full_name" value="{{ $kid->parent_full_name }}" class="form-control mb-2" required>
          <div class="row">
            <div class="col-6">
              <label for="" class="mb-2">{{ __('bolalar_show.phone') }}</label>
              <input type="text" name="phone1" class="form-control mb-2 phone" value="{{ $kid->phone1 }}" required>
            </div>
            <div class="col-6">
              <label for="" class="mb-2">{{ __('bolalar_show.qoshimcha_phone') }}</label>
              <input type="text" name="phone2" class="form-control mb-2 phone" value="{{ $kid->phone2 }}" required>
            </div>
          </div>
          <label for="address" class="mb-2">{{ __('bolalar_show.manzil') }}</label>
          <input type="text" name="address" value="{{ $kid->address }}" class="form-control mb-2" required>
          <label for="admin_note" class="mb-2">{{ __('bolalar_show.izoh') }}</label>
          <input type="text" name="admin_note" value="{{ $kid->admin_note }}" class="form-control mb-2" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('bolalar_show.cancel') }}</button>
          <button type="submit" class="btn btn-primary">{{ __('bolalar_show.save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal" id="tulov" tabindex="-1">
  <form action="{{ route('kids_payment_create') }}" method="post">
    @csrf
    <input type="hidden" name="kid_id" value="{{ $kid->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('bolalar_show.tolov_qilish') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">              
              <div class="mb-2">
                <label for="payment_type" class="mb-2">{{ __('bolalar_show.tranzaksiya') }}</label>
                <select name="payment_type" class="form-select" required>
                  <option value="payment">{{ __('bolalar_show.tolov') }}</option>
                  <option value="discount">{{ __('bolalar_show.chegirma') }}</option>
                  <option value="return">{{ __('bolalar_show.tolov_qaytar') }}</option>
                </select>
              </div>
            </div>
            <div class="col-6">              
              <div class="mb-2">
                <label for="payment_method" class="mb-2">{{ __('bolalar_show.tolov_turi') }}</label>
                <select name="payment_method" class="form-select" required>
                  <option value="">{{ __('bolalar_show.tanlang') }}</option>
                  <option value="cash">{{ __('bolalar_show.cash') }}</option>
                  <option value="card">{{ __('bolalar_show.card') }}</option>
                  <option value="bank">{{ __('bolalar_show.bank') }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="mb-2">
            <label for="amount" class="mb-2">{{ __('bolalar_show.tolov_summasi') }}</label>
            <input type="text" name="amount" class="form-control" id="amount" required>
          </div>
          <div class="mb-2">
            <label for="comment" class="mb-2">{{ __('bolalar_show.tolov_haqida') }}</label>
            <textarea name="comment" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('bolalar_show.cancel') }}</button>
          <button type="submit" class="btn btn-primary">{{ __('bolalar_show.save') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection