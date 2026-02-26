@extends('layouts.admin')
@section('title', __('lead_kid_page.yangi_qabul'))
@section('content')
  <div class="pagetitle">
    <h1>{{ __('lead_kid_page.yangi_qabul') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('child_lead') }}">{{ __('lead_emploes_page.title') }}</a></li>
        <li class="breadcrumb-item active">{{ __('lead_kid_page.yangi_qabul') }}</li>
      </ol>
    </nav>
  </div><section class="section dashboard">
    <div class="row">
      <div class="col-lg-8">
        <div class="card"> 
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <h5 class="card-title">{{ $user->child_full_name }}</h5>
                <div class="row">
                  <div class="col-6 my-2">{{ __('lead_kid_page.guvohnoma_raqami') }}</div>
                  <div class="col-6 my-2" style="text-align: right">{{ $user->certificate_serial }}</div>
                  <div class="col-6 my-2">{{ __('lead_kid_page.tkun') }}</div>
                  <div class="col-6 my-2" style="text-align: right">{{ $user->tkun }}</div>
                  <div class="col-6 my-2">{{ __('lead_kid_page.jinsi')}}</div>
                  <div class="col-6 my-2" style="text-align: right">
                    @if($user->gender=='male')
                      {{ __('lead_kid_page.ogil_bola') }}
                    @else
                      {{ __('lead_kid_page.qiz_bola') }}
                    @endif
                  </div>
                  <div class="col-6 my-2">{{ __('lead_kid_page.yashash_manzil') }}</div>
                  <div class="col-6 my-2" style="text-align: right">{{ $user->address }}</div>
                </div>
              </div>
              <div class="col-lg-6">
                <h5 class="card-title w-100" style="text-align:right">
                  @if($user->status=='new')
                    <p class="p-0 m-0 text-primary">{{ __('lead_kid_page.new') }}</p>
                  @elseif($user->status=='pending')
                    <p class="p-0 m-0 text-warning">{{ __('lead_kid_page.pending') }}</p>
                  @elseif($user->status=='success')
                    <p class="p-0 m-0 text-success">{{ __('lead_kid_page.success') }}</p>
                  @else
                    <p class="p-0 m-0 text-danger">{{ __('lead_kid_page.cancel') }}</p>
                  @endif
                </h5>
                <div class="row">
                  <div class="col-6 my-2">{{ __('lead_kid_page.ota_onasi') }}</div>
                  <div class="col-6 my-2" style="text-align: right">{{ $user->parent_full_name }}</div>
                  <div class="col-6 my-2">{{ __('lead_kid_page.phone') }}</div>
                  <div class="col-6 my-2" style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $user->phone1) }}</div>
                  <div class="col-6 my-2">{{ __('lead_kid_page.phone') }}</div>
                  <div class="col-6 my-2" style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $user->phone2) }}</div>
                  <div class="col-6 my-2">{{ __('lead_kid_page.biz_haqimizda') }}</div>
                  <div class="col-6 my-2" style="text-align: right">
                    @if($user->source=='instagram')
                      {{ __('lead_kid_page.instagram') }}
                    @elseif($user->source=='telegram')
                      {{ __('lead_kid_page.telegram') }}
                    @elseif($user->source=='friend')
                      {{ __('lead_kid_page.tanish') }}
                    @else
                      {{ __('lead_kid_page.boshqa') }}
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row">                  
                  <div class="col-6 my-2">{{ __('lead_kid_page.qoshimcha_izoh') }}</div>
                  <div class="col-6 my-2" style="text-align: right">{{ $user->admin_note }}</div>
                  @if($user->status=='new' || $user->status=='pending')
                  <div class="col-6">
                    <button class="btn btn-outline-danger w-100 mt-2" data-bs-toggle="modal" data-bs-target="#cancel">{{ __('lead_kid_page.arizani_bekor_qilish') }}</button>
                  </div>
                  <div class="col-6">
                    <button class="btn btn-outline-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#success">{{ __('lead_kid_page.bolani_qabul_qilish') }}</button>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Eslatmalar -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ __('groups.eslatmalar') }}</h5>
            <div class="notes-wrapper" style="max-height: 168px; overflow-y: auto; overflow-x: hidden;">
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
            <form action="{{ route('child_lead_create_note') }}" method="post">
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
  </section>

  <!-- Arizani bekor qilish -->
<div class="modal" id="cancel" tabindex="-1">
  <form action="{{ route('child_lead_cancel') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('lead_kid_page.arizani_bekor_qilish') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" value="{{ $user->id }}">
          <p class="text-danger">{{ __('lead_kid_page.cancel_ariza_izoh') }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
          <button type="submit" class="btn btn-danger">{{ __('lead_kid_page.arizani_bekor_qilish') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>

  <!-- Bolani qabul qilish -->

<div class="modal fade" id="success" tabindex="-1">
  <form action="{{ route('child_lead_success') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold">{{ __('lead_kid_page.bolani_qabul_qilish') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.fio') }}</label>
              <input name="child_full_name" type="text" class="form-control" value="{{ $user->child_full_name }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.serya') }}</label>
              <div class="row">
                <div class="col-4">
                  <input name="certificate_serial1" type="text" class="form-control guvoxnoma_serya" value="{{ $user->certificate_serial }}" required>
                </div>
                <div class="col-8">
                  <input name="certificate_serial2" type="text" class="form-control guvoxnoma_raqam" value="{{ $user->certificate_serial }}" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.tkun') }}</label>
              <input name="tkun" type="date" class="form-control" value="{{ $user->tkun }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.jinsi') }}</label>
              <select name="gender" class="form-select" required>
                <option value="" selected disabled>{{ __('bolalar.tanlang') }}</option>
                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>{{ __('bolalar.male') }}</option>
                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>{{ __('bolalar.female') }}</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('bolalar.qarindosh') }}</label>
            <input name="parent_full_name" type="text" class="form-control" value="{{ $user->parent_full_name }}" required>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.phone1') }}</label>
              <input name="phone1" type="text" class="form-control phone" value="{{ $user->phone1 }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.phone2') }}</label>
              <input name="phone2" type="text" class="form-control phone" value="{{ $user->phone2 }}">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('bolalar.addres') }}</label>
            <input name="address" type="text" class="form-control" value="{{ $user->address }}" required>
          </div>
          <div class="mb-0">
            <label class="form-label">{{ __('bolalar.izoh') }}</label>
            <textarea name="admin_note" class="form-control" rows="2" required>{{ $user->admin_note }}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('bolalar.cancel') }}</button>
          <button type="submit" class="btn btn-primary px-4">{{ __('bolalar.success') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection