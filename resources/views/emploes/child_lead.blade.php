@extends('layouts.admin')
@section('title', __('lead_emploes_page.title'))
@section('content')
  <div class="pagetitle">
    <h1>{{ __('lead_emploes_page.title') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('lead_emploes_page.title') }}</li>
      </ol>
    </nav>
  </div><section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <h5 class="card-title">{{ __('lead_emploes_page.title') }}</h5>
              </div>
              <div class="col-6">
                <button class="btn btn-outline-primary float-end my-3" data-bs-toggle="modal" data-bs-target="#create_emploes">
                  <i class="bi bi-plus-circle"></i>{{ __('lead_emploes_page.create') }}</button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered" style="font-size: 14px">
                <thead>
                  <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">{{ __('lead_emploes_page.fio') }}</th>
                    <th scope="col">{{ __('lead_emploes_page.addres') }}</th>
                    <th scope="col">{{ __('lead_emploes_page.tkun') }}</th>
                    <th scope="col">{{ __('lead_emploes_page.status') }}</th>
                    <th scope="col">{{ __('lead_emploes_page.create_data') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($leads as $lead)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td><a href="#">{{ $lead->child_full_name }}</a></td>
                      <td>{{ $lead->address }}</td>
                      <td class="text-center">{{ $lead->tkun }}</td>
                      <td class="text-center">{{ $lead->status }}</td>
                      <td class="text-center">{{ $lead->created_at }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">Arizalar mavjud emas.</td>
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

  <div class="modal" id="create_emploes" tabindex="-1">
    <div class="modal-dialog">
      <form action="{{ route('child_lead_create') }}" method="post">
        @csrf 
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ __('lead_emploes_page.create') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-1">
              <label for="child_full_name" class="form-label">{{ __('lead_emploes_page.fio')}}</label>
              <input type="text" class="form-control" id="child_full_name" name="child_full_name" value="{{ old('child_full_name') }}" required>
            </div>
            <div class="row">
              <div class="col-lg-8">
                <div class="mb-1">
                  <label for="certificate_serial" class="form-label">Guvohnoma raqami</label>
                  <div class="row">
                    <div class="col-5">
                      <input type="text" class="form-control guvoxnoma_serya" id="certificate_serial_01" name="certificate_serial_01" value="{{ old('certificate_serial_01') }}" required>
                    </div>
                    <div class="col-7">
                      <input type="text" class="form-control guvoxnoma_raqam" id="certificate_serial_02" name="certificate_serial_02" value="{{ old('certificate_serial_02') }}" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-1">
                  <label for="gender" class="form-label">Jinsi</label>
                  <select name="gender" id="gender" class="form-select" required>
                    <option value="">Tanlang</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Erkak</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Ajol</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="mb-1">
              <label for="parent_full_name" class="form-label">Yaqin qarindoshi</label>
              <input type="text" class="form-control" id="parent_full_name" name="parent_full_name" value="{{ old('parent_full_name') }}" required>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-1">
                    <label for="phone1" class="form-label">{{ __('lead_emploes_page.phone')}}</label>
                    <input type="text" class="form-control phone" value="{{ old('phone1', '+998') }}" id="phone1" name="phone1" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-1">
                    <label for="phone2" class="form-label">{{ __('lead_emploes_page.phone2')}}</label>
                    <input type="text" class="form-control phone" value="{{ old('phone2', '+998') }}" id="phone2" name="phone2" required>
                </div>
              </div>
            </div>
            <div class="mb-1">
              <label for="address" class="form-label">{{ __('lead_emploes_page.addres')}}</label>
              <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-1">
                  <label for="tkun" class="form-label">{{ __('lead_emploes_page.tkun')}}</label>
                  <input type="date" class="form-control" id="tkun" name="tkun" value="{{ old('tkun') }}" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-1">
                  <label for="source" class="form-label">Biz haqimizda</label>
                  <select name="source" id="source" class="form-select" required>
                    <option value="">Tanlang</option>
                    <option value="instagram" {{ old('source') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="telegram" {{ old('source') == 'telegram' ? 'selected' : '' }}>Telegram</option>
                    <option value="friend" {{ old('source') == 'friend' ? 'selected' : '' }}>Tanishlar</option>
                    <option value="other" {{ old('other') == 'friend' ? 'selected' : '' }}>Boshqa</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="mb-1">
              <label for="lovozim" class="form-label">Qo'shimcha izoh</label>
              <input type="text" class="form-control" id="lovozim" name="lovozim" value="{{ old('lovozim') }}" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('emploes_page.cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('emploes_page.save') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>    
@endsection