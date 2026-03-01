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
    </div>
    <section class="section dashboard">
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
              @if(@auth()->user()->type == 'drektor')
              <button class="btn btn-outline-danger w-100 mb-2" data-bs-toggle="modal" data-bs-target="#guruhni_ochirish"><i class="bi bi-trash"></i> {{ __('groups.delete_group') }}</button>
              @endif
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
          @foreach($attendanceData as $type => $monthInfo)
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-primary">
              {{ $type == 'current' ? __('kid_davomad_page.joriy_oy') : __('kid_davomad_page.otgan_oy') }} | <span class="text-muted">{{ $monthInfo['month_name'] }}</span>
            </h5>
            <div class="notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;">
            <div class="table-responsive">
              <table class="table table-bordered text-center align-middle" style="font-size: 12px;">
                <thead class="bg-light">
                  <tr>
                    <th rowspan="2" class="align-middle" style="min-width: 150px;">FIO</th>
                    <th colspan="{{ $monthInfo['days_count'] }}">{{ Str::title($monthInfo['month_name']) }}</th>
                  </tr>
                  <tr>
                    @for($i = 1; $i <= $monthInfo['days_count']; $i++)
                      <th style="width: 30px; {{ \Carbon\Carbon::now()->day == $i && $type == 'current' ? 'background: #e7f1ff;' : '' }}">
                        {{ $i }}
                      </th>
                    @endfor
                  </tr>
                </thead>
                <tbody>
                  @foreach($kids as $kid)
                    <tr>
                      <td class="text-start">
                        <strong><a href="{{ route('kid_show', $kid->id) }}">{{ $kid->child_full_name }}</a></strong>
                      </td>
                      @for($i = 1; $i <= $monthInfo['days_count']; $i++)
                        @php
                          $status = $monthInfo['data'][$kid->id][$i][0]->status ?? null;
                        @endphp
                        <td>
                          @if($status == 'keldi')
                            <span class="badge bg-success p-1"><i class="bi bi-person-check"></i></span>
                          @elseif($status == 'kelmadi')
                            <span class="badge bg-danger p-1"><i class="bi bi-x-lg"></i></span>
                          @else
                            <span class="text-muted">-</span>
                          @endif
                        </td>
                      @endfor
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
      @endforeach
          <!-- Tarbiyachilar ro'yhati -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('groups.group_tarbiyachilari') }}</h5>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 12px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('groups.tarbiyachi') }}</th>
                        <th scope="col">{{ __('groups.lavozimi') }}</th>
                        <th scope="col">{{ __('groups.guruhga_qoshildi') }}</th>
                        <th scope="col">{{ __('groups.guruhga_qo_shdi') }}</th>
                        <th scope="col">{{ __('groups.guruhdan_ochirildi') }}</th>
                        <th scope="col">{{ __('groups.guruhdan_ochirdi') }}</th>
                        <th scope="col">{{ __('groups.guruhdagi_holati') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($group_tarbiyachilar as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><a href="#">{{ $item->user?->name ?? '_' }}</a></td>
                            <td class="text-center">
                                {{ ($item->user?->type == 'kichik_tarbiyachi') ? __('groups.yordamchi_tarbiyachi') : __('groups.katta_tarbiyachi') }}
                            </td>
                            <td class="text-center">{{ $item->start_date ? \Carbon\Carbon::parse($item->start_date)->format('d.m.Y') : '-' }}</td>
                            <td class="text-center">{{ $item->creatorAdmin?->name ?? '-' }}</td>                            
                            <td class="text-center">{{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('d.m.Y') : '-' }}</td>                            
                            <td class="text-center">{{ $item->stopperAdmin?->name ?? '-' }}</td>                            
                            <td class="text-center">
                              @if($item->status == 'active')
                                  <div class="row">
                                    <div class="col">
                                      <span class="badge bg-success">Aktiv</span>
                                    </div>
                                    <div class="col">
                                      <form action="{{ route('groups_delete_tarbiyachi') }}" method="post">
                                        @csrf 
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger p-0 px-1 m-0"><i class="bi bi-trash"></i></button>
                                      </form>
                                    </div>
                                  </div>
                              @else
                                  <span class="badge bg-danger">{{ __('groups.deleted') }}</span>
                              @endif
                            </td>
                        </tr>
                      @empty
                          <tr>  
                              <td colspan="9" class="text-center text-muted">{{ __('groups.tarbiyachilar_mavjud_emas') }}</td> 
                          </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Bolalar ro'yhati -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ __('groups.guruhdagi_bolalar_tarixi') }}</h5>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 12px">
                    <thead>
                      <tr class="text-center">
                      <th scope="col">#</th>
                        <th scope="col">{{ __('groups.bola') }}</th>
                        <th scope="col">{{ __('groups.bola_balansi') }}</th>
                        <th scope="col">{{ __('groups.guruhdga_qoshish_haqida_izoh') }}</th>
                        <th scope="col">{{ __('groups.guruhga_qoshildi') }}</th>
                        <th scope="col">{{ __('groups.guruhga_qo_shdi') }}</th>
                        <th scope="col">{{ __('groups.guruhdan_ochirildi') }}</th>
                        <th scope="col">{{ __('groups.guruhdan_ochirdi') }}</th>
                        <th scope="col">{{ __('groups.guruhdagi_holati') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($groupKids as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><a href="{{ route('kid_show', $item->kid_id ) }}">{{ $item->kid?->child_full_name ?? '_' }}</a></td>
                            <td class="text-center">{{ number_format($item->kid?->amount ?? 0, 0, '.', ' ') }} UZS</td>
                            <td>{{ $item->description }}</td>
                            <td class="text-center">{{ $item->start_date ? \Carbon\Carbon::parse($item->start_date)->format('d.m.Y') : '-' }}</td>
                            <td class="text-center">{{ $item->startAdmin?->name ?? '-' }}</td>                            
                            <td class="text-center">{{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('d.m.Y') : '-' }}</td>                            
                            <td class="text-center">{{ $item->endAdmin?->name ?? '-' }}</td>                            
                            <td class="text-center">
                              @if($item->status == 'active')
                                  <div class="row">
                                    <div class="col">
                                      <span class="badge bg-success">Aktiv</span>
                                    </div>
                                    <div class="col">
                                      <form action="{{ route('groups_delete_kid') }}" method="post"> 
                                        @csrf 
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger p-0 px-1 m-0"><i class="bi bi-trash"></i></button>
                                      </form>
                                    </div>
                                  </div>
                              @else
                                  <span class="badge bg-danger">{{ __('groups.deleted') }}</span>
                              @endif
                            </td>
                        </tr>
                      @empty
                          <tr>  
                              <td colspan="10" class="text-center text-muted">{{ __('groups.guruhda_bola_mavjud_emas') }}</td> 
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
      <form action="{{ route('groups_add_tarbiyachi') }}" method="post">
        @csrf
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('groups.yangi_tarbiyachi') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" value="{{ $group->id }}">
              <label for="user_id" class="mb-2">{{ __('groups.tarbiyachini_tanlang') }}</label>
              <select name="user_id" class="form-control">
                <option value="">{{ __('groups.tanlang') }}</option>
                @foreach($noactive_tarbiyachilar as $tarbiyachi)
                  <option value="{{ $tarbiyachi->id }}">{{ $tarbiyachi->name }} | 
                    @if($tarbiyachi->type=='kichik_tarbiyachi')
                      {{ __('groups.yordamchi_tarbiyachi')}} 
                    @else
                      {{ __('groups.katta_tarbiyachi')}}
                    @endif
                  </option>
                @endforeach
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('groups.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ __('groups.guruhga_qoshish') }}</button>
            </div>
          </div>
        </div>
      </form>
    </div>
<!-- Yangi bola qo'shish -->
    <div class="modal" id="yangi_bola" tabindex="-1">
      <form action="{{ route('groups_add_kid') }}" method="post">
        @csrf
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('groups.yangi_bola') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" value="{{ $group->id }}">
              <label for="kid_id" class="mb-2">{{ __('groups.bolani_tanlang') }}</label> 
              <select name="kid_id" class="form-control" required> 
                <option value="">{{ __('groups.tanlang') }}</option>
                @foreach ($groupAddChild as $kid)
                  <option value="{{ $kid->id }}">{{ $kid->child_full_name }} (<i>{{ $kid->certificate_serial }}</i>)</option>
                @endforeach
              </select>
              <label for="description" class="my-2">{{ __('groups.bolani_guruhga_qoshish_haqida') }}</label> 
              <textarea name="description" required class="form-control"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('groups.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ __('groups.save') }}</button>
            </div>
          </div>
        </div>
      </form>
    </div>
<!-- Guruhni o'chirish -->
    <div class="modal" id="guruhni_ochirish" tabindex="-1">
      <form action="{{ route('groups_delete') }}" method="post">
        @csrf
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('groups.guruhni_ochirish') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" value="{{ $group->id }}">
              <p class="text-danger">{{ __('groups.group_delete_comment') }}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('groups.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ __('groups.deleted') }}</button>
            </div>
          </div>
        </div>
      </form>
    </div>
@endsection