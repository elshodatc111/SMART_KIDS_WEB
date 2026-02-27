@extends('layouts.admin')
@section('title', __('menu.barcha_bolalar_tolovlari') )
@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.barcha_bolalar_tolovlari') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.barcha_bolalar_tolovlari') }}</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title">{{ __('menu.barcha_bolalar_tolovlari') }}</h5>
          </div>
          <div class="col-6" style="text-align: right">
            <button onclick="exportTableToExcel()" class="btn btn-outline-success mt-2">
                <i class="bi bi-file-earmark-spreadsheet"></i> {{ __('menu.yuklash') }}
            </button>
          </div>
        </div>
        <div class="notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;">
          <div class="table-responsive">
            <table id="leadsTable" class="table table-bordered" style="font-size: 12px">
              <thead class="text-center">
                <tr>
                  <th>#</th>
                  <th>kid_id</th>
                  <th>amount</th>
                  <th>payment_type</th>
                  <th>payment_method</th>
                  <th>payment_status</th>
                  <th>comment</th>
                  <th>admin_id</th>
                  <th>created_at</th>
                  <th>updated_at</th>
                </tr>
              </thead>
              <tbody>
                @forelse($leads as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td> {{ $item->kid->child_full_name }} </td>
                    <td> {{ $item->amount }} </td>
                    <td> {{ $item->payment_type }} </td>
                    <td> {{ $item->payment_method }} </td>
                    <td> {{ $item->payment_status }} </td>
                    <td> {{ $item->comment }} </td>
                    <td> {{ $item->admin->name }} </td>
                    <td> {{ $item->created_at }} </td>
                    <td> {{ $item->updated_at }} </td>
                  @empty
                    <tr>
                      <td>Malumotlar mavjud emas.</td>
                    </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

<script>
  function exportTableToExcel() {
      var table = document.getElementById("leadsTable");
      var wb = XLSX.utils.table_to_book(table, { sheet: "tolovlar" });
      var fileName = "barcha_bolalar_tolovlari" + new Date().toISOString().slice(0, 10) + ".xlsx";
      XLSX.writeFile(wb, fileName);
  }
</script>
@endsection