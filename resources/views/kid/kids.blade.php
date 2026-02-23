@extends('layouts.admin')
@section('title', __('bolalar.title'))
@section('content')
    <div class="pagetitle">
      <h1>{{ __('bolalar.title') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item active">{{ __('bolalar.title') }}</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <h2 class="card-title">{{ __('bolalar.title') }}</h2>
            </div>
            <div class="col-6 pt-2" style="text-align: right">
              <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addChild"><i class="bi bi-plus"></i> {{ __('bolalar.create') }}</button>
            </div>
          </div>
          <div>
            <form action="{{ route('kids') }}" method="GET">
              <div class="input-group mb-2">
                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="{{ __('bolalar.title_search') }}">
                <button class="btn btn-primary" type="submit">{{ __('bolalar.search') }}</button>
                @if(request('search'))<a href="{{ route('kids') }}" class="btn btn-secondary">{{ __('bolalar.clear') }}</a>@endif
              </div>
            </form>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px">
              <thead>
                <tr class="text-center bg-light">
                  <th scope="col">#</th>
                  <th scope="col">{{ __('bolalar.fio') }}</th>
                  <th scope="col">{{ __('bolalar.tkun') }}</th>
                  <th scope="col">{{ __('bolalar.serya') }}</th>
                  <th scope="col">{{ __('bolalar.balans') }}</th>
                  <th scope="col">{{ __('bolalar.holat') }}</th>
                  <th scope="col">{{ __('bolalar.createt_data') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($kids as $kid)
                  <tr>
                    <td class="text-center">{{ ($kids->currentPage() - 1) * $kids->perPage() + $loop->iteration }}</td>
                    <td><a href="">{{ $kid->child_full_name }}</a></td>
                    <td class="text-center">{{ $kid->tkun->format('d.m.Y') }}</td>
                    <td class="text-center">{{ $kid->certificate_serial }}</td>
                    <td class="text-center">{{ $kid->amount }}</td>
                    <td class="text-center">
                      @if($kid->status == 'true')
                        <span class="badge bg-success">{{ __('bolalar.active') }}</span>
                      @else
                        <span class="badge bg-danger">{{ __('bolalar.noactiv') }}</span>
                      @endif
                    </td>
                    <td class="text-center">
                      {{ $kid->created_at->format('d.m.Y H:i') }}
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center text-muted">{{ __('bolalar.not_found') }}</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center mt-3">
              {{ $kids->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </section>

<div class="modal fade" id="addChild" tabindex="-1">
  <form action="{{ route('kids_create') }}" method="POST">
    @csrf
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold">{{ __('bolalar.create') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.fio') }}</label>
              <input name="child_full_name" type="text" class="form-control" value="{{ old('child_full_name') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.serya') }}</label>
              <div class="row">
                <div class="col-4">
                  <input name="certificate_serial1" type="text" class="form-control guvoxnoma_serya" value="{{ old('certificate_serial1') }}" required>
                </div>
                <div class="col-8">
                  <input name="certificate_serial2" type="text" class="form-control guvoxnoma_raqam" value="{{ old('certificate_serial2') }}" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.tkun') }}</label>
              <input name="tkun" type="date" class="form-control" value="{{ old('tkun') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.jinsi') }}</label>
              <select name="gender" class="form-select" required>
                <option value="" selected disabled>{{ __('bolalar.tanlang') }}</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('bolalar.male') }}</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('bolalar.female') }}</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('bolalar.qarindosh') }}</label>
            <input name="parent_full_name" type="text" class="form-control" value="{{ old('parent_full_name') }}" required>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.phone1') }}</label>
              <input name="phone1" type="text" class="form-control phone" value="{{ old('phone1', '+998') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">{{ __('bolalar.phone2') }}</label>
              <input name="phone2" type="text" class="form-control phone" value="{{ old('phone2', '+998') }}">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('bolalar.addres') }}</label>
            <input name="address" type="text" class="form-control" value="{{ old('address') }}" required>
          </div>
          <div class="mb-0">
            <label class="form-label">{{ __('bolalar.izoh') }}</label>
            <textarea name="admin_note" class="form-control" rows="2" placeholder="Sog'lig'i yoki boshqa muhim ma'lumotlar...">{{ old('admin_note') }}</textarea>
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