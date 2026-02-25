@extends('layouts.admin')
@section('title', __('groups.guruhlar'))
@section('content')
  <div class="pagetitle">
    <h1>{{ __('groups.guruhlar') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('groups.guruhlar') }}</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title">{{ __('groups.guruhlar') }}</h5>
          </div>
          <div class="col-6" style="text-align: right">
            <button class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#newGroups">{{ __('groups.new_group') }}</button>
          </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">{{ __('groups.guruh_nomi') }}</th>
                  <th scope="col">{{ __('groups.guruh_narxi') }}</th>
                  <th scope="col">{{ __('groups.count_bolalar') }}</th>
                  <th scope="col">{{ __('groups.count_tarbiyachi') }}</th>
                  <th scope="col">{{ __('groups.meneger') }}</th>
                  <th scope="col">{{ __('groups.yaratilgan_sana') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($groups as $group)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td><a href="{{ route('groups_show', $group['id']) }}">{{ $group['group_name'] }}</a></td>
                    <td class="text-center">{{ number_format($group['group_amount'], 0, '.', ' ') }} UZS</td>
                    <td class="text-center">{{ $group['kids_count'] ?? 0 }}</td>
                    <td class="text-center">{{ $group['emploes_count'] ?? 0 }}</td>
                    <td class="text-center">{{ $group['manager_name'] }}</td>
                    <td class="text-center">{{ $group['created_at'] }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8" class="text-center">{{ __('groups.guruhlar_mavjud_emas') }}</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </section>
  <div class="modal" id="newGroups" tabindex="-1">
    <div class="modal-dialog">
      <form action="{{ route('groups_create') }}" method="post">
        @csrf 
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ __('groups.new_group') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label for="group_name" class="mb-2">{{ __('groups.guruh_nomi') }}</label>
            <input type="text" class="form-control" id="group_name" name="group_name" required>
            <label for="group_amount" class="my-2">{{ __('groups.guruh_narxi') }}</label>
            <input type="text" class="form-control" id="amount" name="group_amount" required>
            <label for="description" class="my-2">{{ __('groups.guruh_haqida') }}</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('groups.cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('groups.save') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection