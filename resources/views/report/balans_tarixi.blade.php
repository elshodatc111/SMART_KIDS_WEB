@extends('layouts.admin')
@section('title', __('menu.barcha_balans_tarixi') )
@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.barcha_balans_tarixi') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.barcha_balans_tarixi') }}</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title">{{ __('menu.barcha_balans_tarixi') }}</h5>
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
                  <th>type</th>
                  <th>amount</th>
                  <th>payment_method</th>
                  <th>description</th>
                  <th>status</th>
                  <th>start_date</th>
                  <th>meneger_id</th>
                  <th>end_date</th>
                  <th>admin_id</th>
                  <th>created_at</th>
                  <th>updated_at</th>
                </tr>
              </thead>
              <tbody>
                @forelse($leads as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->type }} </td>
                    <td>{{ $item->amount }} </td>
                    <td>{{ $item->payment_method }} </td>
                    <td>{{ $item->description }} </td>
                    <td>{{ $item->status }} </td>
                    <td>{{ $item->start_date }} </td>
                    <td>{{ $item->meneger->name }} </td>
                    <td>{{ $item->end_date }} </td>
                    <td>{{ $item->admin_id?$item->admin->name:"_" }}</td>
                    <td>{{ $item->created_at }} </td>
                    <td>{{ $item->updated_at }} </td>
                  </tr>
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
      var fileName = "barcha_balans_tarixi" + new Date().toISOString().slice(0, 10) + ".xlsx";
      XLSX.writeFile(wb, fileName);
  }
</script>
@endsection