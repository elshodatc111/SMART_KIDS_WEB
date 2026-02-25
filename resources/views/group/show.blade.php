@extends('layouts.admin')
@section('title', __('groups.group'))
@section('content')
    <div class="pagetitle">
      <h1>{{ __('groups.group') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('groups') }}">{{ __('groups.guruhlar') }}</a></li>
          <li class="breadcrumb-item active">{{ __('groups.group') }}</li>
        </ol>
      </nav>
    </div><section class="section dashboard">
      <div class="row">

        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('groups.group') }}</h5>
              <div class="row mb-2">
                <div class="col-5 label">{{ __('groups.guruh_nomi') }}:</div>
                <div class="col-7" style="text-align: right">{{ $group->group_name }}</div>
              </div>
              <div class="row mb-2">
                <div class="col-5 label">{{ __('groups.guruh_narxi') }}:</div>
                <div class="col-7" style="text-align: right">{{ number_format($group->group_amount, 0, '.', ' ') }} UZS</div>
              </div>
              <div class="row mb-2">
                <div class="col-5 label">{{ __('groups.guruh_haqida') }}:</div>
                <div class="col-7" style="text-align: right">{{ $group->description }}</div>
              </div>
              <div class="row mb-2">
                <div class="col-5 label">{{ __('groups.meneger') }}:</div>
                <div class="col-7" style="text-align: right">{{ $group->manager->name }}</div>
              </div>
              <div class="row mb-2">
                <div class="col-5 label">{{ __('groups.yaratilgan_sana') }}:</div>
                <div class="col-7" style="text-align: right">{{ $group->created_at->format('d.m.Y') }}</div>
              </div>
              <hr>
              <button class="btn btn-outline-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#taxrirlash"><i class="bi bi-pencil"></i> {{ __('groups.edit_group') }}</button>
              <button class="btn btn-outline-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#yangi_tarbiyachi"><i class="bi bi-person-plus"></i> {{ __('groups.add_teacher') }}</button>
              <button class="btn btn-outline-warning w-100 mb-2" data-bs-toggle="modal" data-bs-target="#yangi_bola"><i class="bi bi-person-plus"></i> {{ __('groups.add_kid') }}</button>
              <button class="btn btn-outline-danger w-100 mb-2" data-bs-toggle="modal" data-bs-target="#guruhni_ochirish"><i class="bi bi-trash"></i> {{ __('groups.delete_group') }}</button>
            </div>
          </div>
          
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('groups.eslatmalar') }}</h5>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
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
              <form action="{{ route('groups_create_note') }}" method="post">
                @csrf 
                <div class="row g-2"> <div class="col-9">
                    <input type="hidden" name="id" value="{{ $group->id }}">
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
        <div class="col-lg-9">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Guruhdagi davomadi</h5>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">

              </div>
            </div>
          </div>
          <div class="card"> 
            <div class="card-body">
              <h5 class="card-title">Guruh bolalari</h5>
              <p>Siz tizimga muvaffaqiyatli kirdingiz. Bu yerda sizning asosiy statistikalaringiz ko'rinadi.</p>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Guruh tarbiyachilari</h5>
              <p>Siz tizimga muvaffaqiyatli kirdingiz. Bu yerda sizning asosiy statistikalaringiz ko'rinadi.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- Guruhni taxrirlash modal -->
    <div class="modal" id="taxrirlash" tabindex="-1">
      <form action="{{ route('groups_update') }}" method="post">
        @csrf 
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('groups.guruhni_taxrirlash') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" value="{{ $group->id }}">
              <label for="group_name" class="mb-2">{{ __('groups.guruh_nomi') }}</label>
              <input type="text" name="group_name" class="form-control" value="{{ $group->group_name }}" required>
              <label for="group_amount" class="my-2">{{ __('groups.guruh_narxi') }}</label>
              <input type="text" name="group_amount" id="amount" class="form-control" value="{{ $group->group_amount }}" required>
              <label for="description" class="my-2">{{ __('groups.guruh_haqida') }}</label>  
              <textarea name="description" class="form-control" rows="3">{{ $group->description }}</textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('groups.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ __('groups.save') }}</button>
            </div>
          </div>
        </div>
      </form>
    </div>
<!-- Yangi tarbiyachi qo'shish -->
    <div class="modal" id="yangi_tarbiyachi" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Yangi tarbiyachi qo'shish</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
<!-- Yangi bola qo'shish -->
    <div class="modal" id="yangi_bola" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Yangi bola qo'shish</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
<!-- Guruhni o'chirish -->
    <div class="modal" id="guruhni_ochirish" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Guruhni o'chirish</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
@endsection