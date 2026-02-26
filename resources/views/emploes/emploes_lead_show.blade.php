@extends('layouts.admin')
@section('title', 'Ariza haqida')
@section('content')
  <div class="pagetitle">
    <h1>Ariza haqida</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('emploes_lead') }}">{{ __('lead_emploes_page.title') }}</a></li>
        <li class="breadcrumb-item active">Ariza haqida</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <h5 class="card-title">{{ $user->full_name }}</h5>
                <div class="row">
                  <div class="col-6 my-1">Telefon raqam</div>
                  <div class="col-6 my-1" style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $user->phone1) }} </div>
                  <div class="col-6 my-1">Telefon raqam</div>
                  <div class="col-6 my-1" style="text-align: right">{{ preg_replace('/^(\+998)(\d{2})(\d{3})(\d{4})$/', '$1 $2 $3 $4', $user->phone2) }} </div>
                  <div class="col-6 my-1">Yashash manzili</div>
                  <div class="col-6 my-1" style="text-align: right">{{ $user->address }}</div>
                  <div class="col-6 my-1">Tugilgan kuni</div>
                  <div class="col-6 my-1" style="text-align: right">{{ \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') }}</div>
                  <div class="col-6 my-1">Malumoti</div>
                  <div class="col-6 my-1" style="text-align: right">
                    @if($user->education_level == 'College')
                      O'rta maxsus
                    @elseif($user->education_level == 'Bachelor')
                      Bakalavr
                    @elseif($user->education_level == 'Master')
                      Magistr
                    @elseif($user->education_level == 'Doctor')
                      Doktorantura
                    @endif
                  </div>
                  <div class="col-6 my-1">Ta'lim muassasasi</div>
                  <div class="col-6 my-1" style="text-align: right">{{ $user->education_detail }}</div>
                </div>
              </div>
              <div class="col-lg-6">
                <h5 class="card-title w-100" style="text-align: right">
                  @if($user->status=='new')
                    <p class='text-primary p-0 m-0'>Yangi</p>
                  @elseif($user->status=='pending')
                    <p class='text-warning p-0 m-0'>Jarayonda</p>
                  @elseif($user->status=='success')
                    <p class='text-success p-0 m-0'>Qabul qilindi</p>
                  @else
                    <p class='text-danger p-0 m-0'>Bekor qilindi</p>
                  @endif
                </h5>
                <div class="row">                    
                  <div class="col-6 my-1">Oxirgi ish joyi</div>
                  <div class="col-6 my-1" style="text-align: right">{{ $user->previous_company }}</div>
                  <div class="col-6 my-1">Elon haqida</div>
                  <div class="col-6 my-1" style="text-align: right">
                    @if($user->vacance_about=='social_media')
                      Ijtimoiy tarmoqlar
                    @elseif($user->vacance_about=='friend')
                      Tanishlar
                    @else
                      Boshqa
                    @endif
                  </div>
                  <div class="col-6 my-1">Kutayotgan ish haqi</div>
                  <div class="col-6 my-1" style="text-align: right">{{ number_format($user->expected_salary, 0, '.', ' ') }} UZS</div>
                  <div class="col-6 my-1">Ishga kirishdan maqsadi</div>
                  <div class="col-6 my-1" style="text-align: right">{{ $user->career_objective }}</div>
                  <div class="col-6 my-1">Qaysi lavozimga nomzod?</div>
                  <div class="col-6 my-1" style="text-align: right">{{ $user->lovozim }}</div>
                  <div class="col-6 my-1">Ariza vaqti</div>
                  <div class="col-6 my-1" style="text-align: right">{{ $user->created_at }}</div>
                </div>
              </div>
              @if($user->status=='new' || $user->status=='pending')
              <div class="col-6">
                <button class="btn btn-outline-danger mt-2 w-100" data-bs-toggle="modal" data-bs-target="#arizani_bekor_qilish">Arizani bekor qilish</button>
              </div>
              <div class="col-6">
                <button class="btn btn-outline-primary mt-2 w-100" data-bs-toggle="modal" data-bs-target="#hodimni_ishga_olish">Ishga qabul qilish</button>
              </div>
              @endif
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
            <form action="{{ route('emploes_eslatma_lead_create') }}" method="post">
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
<div class="modal" id="arizani_bekor_qilish" tabindex="-1">
  <form action="{{ route('emploes_lead_cancel') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Arizani bekor qilish</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" value="{{ $user->id }}">
          <p class="text-danger">Ariza bekor qilingach o'zgartirish hamda ishga olish imkoniyati bo'lmaydi</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-danger">Arizani bekor qilish</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Ishga qabul qilish -->
<div class="modal" id="hodimni_ishga_olish" tabindex="-1">
  <form action="{{ route('emploes_lead_success') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Xodimni ishga olish</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="lead_id" value="{{ $user->id }}">
          <label for="name" class="mb-2">FIO</label>
          <input type="text" name="name" value="{{ $user->full_name }}" required class="form-control">
          <label for="phone1" class="my-2">Telefon raqami</label>
          <input type="text" name="phone1" value="{{ $user->phone1 }}" required class="form-control phone">
          <label for="phone_two" class="my-2">Telefon raqami 2</label>
          <input type="text" name="phone_two" value="{{ $user->phone2 }}" required class="form-control phone">
          <label for="address" class="my-2">Manzil</label>
          <input type="text" name="address" value="{{ $user->address }}" required class="form-control">
          <label for="amount" class="my-2">Maosh miqdori</label>
          <input type="text" name="amount" id="amount" required class="form-control">
          <label for="birthday" class="my-2">Tug'ilgan sana</label>
          <input type="date" name="birthday" value="{{ \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') }}" required class="form-control">
          <label for="passport_number" class="my-2">Pasport seriyasi</label>
          <input type="text" name="passport_number" required class="form-control passport">
          <label for="type" class="my-2">Lavozimi</label>
          <select class="form-select" id="type" name="type" required>   
            <option value="">{{ __('emploes_page.lavozim_tanlang') }}</option>
            <option value="drektor">{{ __('emploes_page.lavozim_drektor') }}</option>
            <option value="admin">{{ __('emploes_page.lavozim_admin') }}</option>  
            <option value="katta_tarbiyachi">{{ __('emploes_page.lavozim_tarbiyachi') }}</option>
            <option value="kichik_tarbiyachi">{{ __('emploes_page.lavozim_yordamch_tarbiyachi') }}</option>
            <option value="oshpaz">{{ __('emploes_page.lavozim_oshpaz') }}</option>
            <option value="teacher">{{ __('emploes_page.lavozim_oqituvchi') }}</option> 
            <option value="farrosh">{{ __('emploes_page.lavozim_farrosh') }}</option>
            <option value="hodim">{{ __('emploes_page.lavozim_hodim') }}</option>
          </select>
          <label for="type_about" class="mt-2">Lavozim haqida ma'lumot</label>
          <textarea name="type_about" required class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary">Ishga olish</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection