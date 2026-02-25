@extends('layouts.admin')
@section('title', 'Hodim')
@section('content')
    <div class="pagetitle">
      <h1>Hodim</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item"><a href="{{ route('emploes') }}">{{ __('menu.emploes') }}</a></li>
          <li class="breadcrumb-item active">Hodim</li>
        </ol>
      </nav>
    </div><section class="section dashboard">
      <div class="row">

        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title w-100 text-center">{{ $user->name }}</h5>
              <table class="table table-bordered" style="font-size: 14px">
                <tr>
                  <th>Telefon raqam</th>
                  <td style="text-align: right">{{ $user->phone }}</td>
                </tr>
                <tr>
                  <th>Qo'shimcha telefon</th>
                  <td style="text-align: right">{{ $user->phone_two ?? "-" }}</td>
                </tr>
                <tr>
                  <th>Manzil</th>
                  <td style="text-align: right">{{ $user->address??"-" }}</td>
                </tr>
                <tr>
                  <th>Ish haqi</th>
                  <td style="text-align: right">{{ $user->amount??"-" }}</td>
                </tr>
                <tr>
                  <th>Tug'ilgan kuni</th>
                  <td style="text-align: right">{{ $user->birthday??"-" }}</td>
                </tr>
                <tr>
                  <th>Pasport raqami</th>
                  <td style="text-align: right">{{ $user->passport_number??"-" }}</td>
                </tr>
                <tr>
                  <th>Lavozimi</th>
                  <td style="text-align: right">{{ $user->type??"-" }}</td>
                </tr>
                <tr>
                  <th>Ish faoliyati</th>
                  <td style="text-align: right">{{ $user->status??"-" }}</td>
                </tr>
                <tr>
                  <td colspan="2">{{ $user->type_about??"-" }}</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Hodim davomadi</h5>
              <div class="notes-wrapper" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Davomat sanasi</th>
                        <th scope="col">Davomad holati</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($davomad as $item)
                        <tr class="text-center">
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->attendance_date->format('d.m.Y') }}</td>
                          <td>
                            @if($item->status  == 'keldi')
                              <span class="badge bg-success">Keldi</span>
                            @elseif($item->status  == 'kechikdi')
                              <span class="badge bg-warning">Kechikdi</span>
                            @else
                              <span class="badge bg-danger">Kelmedi</span>
                            @endif
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="3" class="text-center">Davomat ma'lumotlari mavjud emas</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-9">
          <!-- Tarbiyachi guruhlari -->
          @if($user->type == 'kichik_tarbiyachi' OR $user->type == 'katta_tarbiyachi')
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tarbiyachi guruhlari</h5>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Guruh</th>
                        <th scope="col">Guruhdagi holati</th>
                        <th scope="col">Guruhga qo'shildi</th>
                        <th scope="col">Guruhga qo'shdi</th>
                        <th scope="col">Guruhdan o'chirildi</th>
                        <th scope="col">Guruhdan o'chirdi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($guruhlari as $key => $group)
                        <tr class="text-center">
                          <td>{{ $key + 1 }}</td>
                          <td><a href="{{ route('groups_show', $group->group->id) }}">{{ $group->group->group_name }}</a></td>
                          <td>
                            @if($group->status == 'active')
                            <span class="badge bg-success">Faol</span>
                            @else
                              <span class="badge bg-danger">O'chirilgan</span>
                            @endif
                          </td>
                          <td>{{ $group->start_date->format('d.m.Y') }}</td>
                          <td>{{ $group->creatorAdmin->name ?? '-' }}</td>
                          <td>{{ $group->end_date ? $group->end_date->format('d.m.Y') : '-' }}</td>
                          <td>{{ $group->stopperAdmin->name ?? '-' }}</td>
                        </tr>
                      @empty
                        <tr>  
                          <td colspan="8" class="text-center">Tarbiyachi guruhlari mavjud emas</td> 
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endif
          <!-- Ish haqi to'lovlari -->
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">Ish haqi to'lovlari</h5>
                </div>
                <div class="col-6" style="text-align: right">
                  <button class="btn btn-primary mt-2"  data-bs-toggle="modal" data-bs-target="#ish_haqi_tulash"><i class="bi bi-cash"></i>Ish haqi to'lash</button>
                </div>
              </div>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">To'lov summasi</th>
                        <th scope="col">To'lov turi</th>
                        <th scope="col">To'lov haqida</th>
                        <th scope="col">To'lov vaqti</th>
                        <th scope="col">Meneger</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($userPaymart as $key => $paymart)
                        <tr class="text-center">
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $paymart->amount }}</td>
                          <td>{{ $paymart->description }}</td> 
                          <td>{{ $paymart->payment_method }}</td> 
                          <td>{{ $paymart->admin ? $paymart->admin->name : '-' }}</td>
                          <td>{{ $paymart->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center">Ish haqi to'lovlari mavjud emas</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Rollar -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Hodim ruxsatlari</h5>
              <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;">
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Guruh</th>
                        <th scope="col">Guruhdagi holati</th>
                        <th scope="col">Guruhga qo'shildi</th>
                        <th scope="col">Guruhga qo'shdi</th>
                        <th scope="col">Guruhdan o'chirildi</th>
                        <th scope="col">Guruhdan o'chirdi</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>



        </div>
      </div>
    </section>


<!-- Ish haqi to'lash modal -->
<div class="modal" id="ish_haqi_tulash" tabindex="-1">
  <form action="{{ route('emploes_payment_create') }}" method="post">
    @csrf 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ish haqi to'lash</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <label for="" class="mb-2">To'lov usuli</label>
          <select name="payment_method" class="form-control" required>
            <option value="">Tanlang ... </option>
            <option value="cash">Naqd</option>
            <option value="card">Plastik</option>
            <option value="bank">Bank</option>
          </select>
          <label for="amount" class="my-2">Ish haqi summasi</label>
          <input type="text" name="amount" id="amount" class="form-control" required>
          <label for="description" class="my-2">To'lov haqida</label>
          <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
          <button type="submit" class="btn btn-primary">To'lov</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection