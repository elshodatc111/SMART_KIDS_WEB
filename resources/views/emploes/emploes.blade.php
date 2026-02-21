@extends('layouts.admin')
@section('title', __('menu.emploes'))
@section('content')
    <div class="pagetitle">
      <h1>{{ __('menu.emploes') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item active">{{ __('menu.emploes') }}</li>
        </ol>
      </nav>
    </div><section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">{{ __('menu.emploes') }}</h5>
                </div>
                <div class="col-6">
                  <button class="btn btn-outline-primary float-end my-3" data-bs-toggle="modal" data-bs-target="#create_emploes"><i class="bi bi-plus-circle"></i> {{ __('emploes_page.create') }}</button>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" style="font-size: 14px">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">{{ __('emploes_page.name') }}</th>
                      <th scope="col">{{ __('emploes_page.phone') }}</th>
                      <th scope="col">{{ __('emploes_page.type') }}</th>
                      <th scope="col">{{ __('emploes_page.status') }}</th>
                      <th scope="col">{{ __('emploes_page.create_data') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                      <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td><a href="#">{{ $user->name }}</a></td>
                        <td>{{ preg_replace('/(\+\d{3})(\d{2})(\d{3})(\d{4})/', '$1 $2 $3 $4', $user->phone) }}</td>
                        <td>{{ $user->type }}</td>
                        <td>{{ $user->status }}</td>
                        <td class="text-center">{{ $user->created_at }}</td> 
                      </tr>
                    @empty
                      <tr>
                        <td colspan="7" class="text-center">{{ __('emploes_page.no_emploes') }}</td>
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
    <form action="{{ route('emploes_create') }}" method="post">
      @csrf 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('emploes_page.create') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label for="name" class="form-label">{{ __('emploes_page.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-2 row">
            <div class="col-lg-6">
              <label for="phone" class="form-label">{{ __('emploes_page.phone') }}</label>
              <input type="text" class="form-control phone" id="phone" value="+998" name="phone" required>
            </div>
            <div class="col-lg-6">
              <label for="phone_two" class="form-label">{{ __('emploes_page.phone') }} 2</label>
              <input type="text" class="form-control phone" id="phone_two" value="+998" name="phone_two" required>
            </div>
          </div>
          <div class="mb-2">
            <label for="address" class="form-label">{{ __('emploes_page.address') }}</label>
            <input type="text" class="form-control" id="address" name="address" required>
          </div>
          <div class="mb-2 row">
            <div class="col-lg-6">
              <label for="amount" class="form-label">{{ __('emploes_page.amount') }}</label>
              <input type="text" class="form-control amount" id="amount" name="amount" required>
            </div>
            <div class="col-lg-6">
              <label for="birthday" class="form-label">{{ __('emploes_page.birthday') }}</label>
              <input type="date" class="form-control" id="birthday" name="birthday" required>
            </div>
          </div>  
          <div class="mb-2 row">
            <div class="col-lg-6">
              <label for="passport_number" class="form-label">{{ __('emploes_page.passport_number') }}</label>
              <input type="text" class="form-control passport" placeholder="AA 1234567" id="passport_number" name="passport_number" required>
            </div>
            <div class="col-lg-6"> <!-- 'drektor','admin','katta_tarbiyachi','kichik_tarbiyachi','oshpaz','teacher','farrosh','hodim' -->
              <label for="type" class="form-label">{{ __('emploes_page.type') }}</label>
              <select class="form-select" id="type" name="type" required>   
                <option value="">Lavozim tanlang</option>
                <option value="drektor">Direktor</option>
                <option value="admin">Admin</option>  
                <option value="katta_tarbiyachi">Tarbiyachi</option>
                <option value="kichik_tarbiyachi">Yordamchi tarbiyachi</option>
                <option value="oshpaz">Oshpaz</option>
                <option value="teacher">O'qituvchi</option>
                <option value="farrosh">Farrosh</option>
                <option value="hodim">Hodim</option>
              </select>
            </div>
          </div>        
          <div class="mb-2">
            <label for="type_about" class="form-label">{{ __('emploes_page.type_about') }}</label>
            <textarea type="text" class="form-control" id="type_about" name="type_about" required></textarea>
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