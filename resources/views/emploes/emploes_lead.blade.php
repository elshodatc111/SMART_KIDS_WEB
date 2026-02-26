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
                    <th scope="col">{{ __('lead_emploes_page.malumoti') }}</th>
                    <th scope="col">{{ __('lead_emploes_page.lavozimlar') }}</th>
                    <th scope="col">{{ __('lead_emploes_page.status') }}</th>
                    <th scope="col">{{ __('lead_emploes_page.create_data') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($leads as $lead)
                      <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td><a href="{{ route('emploes_lead_show',$lead['id']) }}">{{ $lead['full_name'] }}</a></td>
                          <td>{{ $lead['address'] }}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($lead->date_of_birth)->age }} {{ __('lead_emploes_page.yosh') }}</td>
                          <td class="text-center">
                            @if($lead['education_level'] == 'College')
                              {{ __('lead_emploes_page.mal_kollej') }}
                            @elseif($lead['education_level'] == 'Bachelor')
                              {{ __('lead_emploes_page.mal_bakalavr') }}
                            @elseif($lead['education_level'] == 'Master')
                              {{ __('lead_emploes_page.mal_magestr') }}
                            @else
                              {{ __('lead_emploes_page.mal_doctor') }}
                            @endif
                          </td>
                          <td class="text-center">{{ $lead['lovozim'] }}</td>
                          <td class="text-center">
                            @if($lead['status']=='new')
                              <span class="badge border border-primary border-1 text-primary">{{ __('lead_emploes_page.new') }}</span>
                            @elseif($lead['status']=='pending')
                              <span class="badge border border-warning border-1 text-warning">{{ __('lead_emploes_page.pending') }}</span>
                            @elseif($lead['status']=='success')
                              <span class="badge border border-success border-1 text-success">{{ __('lead_emploes_page.success') }}</span>
                            @else
                              <span class="badge border border-danger border-1 text-danger">{{ __('lead_emploes_page.cancel') }}</span>
                            @endif
                          </td>
                          <td class="text-center">{{ $lead['created_at'] }}</td>
                      </tr>
                  @empty
                      <tr>
                          <td class="text-center" colspan=8>
                              {{ __('lead_emploes_page.not_found')}}
                          </td>
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
      <form action="{{ route('emploes_lead_create') }}" method="post">
        @csrf 
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ __('lead_emploes_page.create') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-1">
              <label for="full_name" class="form-label">{{ __('lead_emploes_page.fio')}}</label>
              <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
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
                  <label for="date_of_birth" class="form-label">{{ __('lead_emploes_page.tkun')}}</label>
                  <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-1">
                  <label for="education_level" class="form-label">{{ __('lead_emploes_page.malumoti')}}</label>
                  <select name="education_level" id="education_level" class="form-select" required>
                    <option value="">Tanlang</option>
                    <option value="College" {{ old('education_level') == 'College' ? 'selected' : '' }}>{{ __('lead_emploes_page.mal_kollej')}}</option>
                    <option value="Bachelor" {{ old('education_level') == 'Bachelor' ? 'selected' : '' }}>{{ __('lead_emploes_page.mal_bakalavr') }}</option>
                    <option value="Master" {{ old('education_level') == 'Master' ? 'selected' : '' }}>{{ __('lead_emploes_page.mal_magestr') }}</option>
                    <option value="Doctor" {{ old('education_level') == 'Doctor' ? 'selected' : '' }}>{{ __('lead_emploes_page.mal_doctor') }}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="mb-1">
              <label for="education_detail" class="form-label">{{ __('lead_emploes_page.talim') }}</label>
              <input type="text" class="form-control" id="education_detail" name="education_detail" value="{{ old('education_detail') }}" required>
            </div>
            <div class="mb-1">
              <label for="previous_company" class="form-label">{{ __('lead_emploes_page.work') }}</label>
              <input type="text" class="form-control" id="previous_company" name="previous_company" value="{{ old('previous_company') }}" required>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-1">
                  <label for="vacance_about" class="form-label">{{ __('lead_emploes_page.elon_haqida') }}</label>
                  <select name="vacance_about" id="vacance_about" class="form-select" required>
                    <option value="">Tanlang</option>
                    <option value="social_media" {{ old('vacance_about') == 'social_media' ? 'selected' : '' }}>{{ __('lead_emploes_page.elon_ijtimoiy') }}</option>
                    <option value="friend" {{ old('vacance_about') == 'friend' ? 'selected' : '' }}>{{ __('lead_emploes_page.elon_tanish') }}</option>
                    <option value="other" {{ old('vacance_about') == 'other' ? 'selected' : '' }}>{{ __('lead_emploes_page.elon_boshqa') }}</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-1">
                  <label for="expected_salary" class="form-label">{{ __('lead_emploes_page.kutilayotgan_ish_haqi') }}</label>
                  <input type="text" class="form-control" id="amount" name="expected_salary" value="{{ old('expected_salary') }}" required>
                </div>
              </div>
            </div>
            <div class="mb-1">
              <label for="career_objective" class="form-label">{{ __('lead_emploes_page.ishlashdan_maqsad') }}</label>
              <input type="text" class="form-control" id="career_objective" name="career_objective" value="{{ old('career_objective') }}" required>
            </div>
            <div class="mb-1">
              <label for="lovozim" class="form-label">{{__('lead_emploes_page.qaysi_lavozimga')}}</label>
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