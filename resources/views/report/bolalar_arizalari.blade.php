@extends('layouts.admin')
@section('title', __('menu.barcha_bolalar_qabul_arizalari') )
@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.barcha_bolalar_qabul_arizalari') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.barcha_bolalar_qabul_arizalari') }}</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title">{{ __('menu.barcha_bolalar_qabul_arizalari') }}</h5>
          </div>
          <div class="col-6" style="text-align: right">
            <button onclick="exportTableToExcel()" class="btn btn-outline-success mt-2">
                <i class="bi bi-file-earmark-spreadsheet"></i> Yuklash
            </button>
          </div>
        </div>
        <div class="notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;">
          <div class="table-responsive">
            <table id="leadsTable" class="table table-bordered" style="font-size: 12px">
              <thead class="text-center">
                <tr>
                  <th>#</th>
                  <th>child_full_name</th>
                  <th>certificate_serial</th>
                  <th>tkun</th>
                  <th>gender</th>
                  <th>parent_full_name</th>
                  <th>phone1</th>
                  <th>phone2</th>
                  <th>address</th>
                  <th>status</th>
                  <th>source</th>
                  <th>admin_note</th>
                  <th>created_at</th>
                  <th>updated_at</th>
                </tr>
              </thead>
              <tbody>                
                  @forelse($leads as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->child_full_name }}</td>
                    <td>{{ $item->certificate_serial }}</td>
                    <td>{{ $item->tkun }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->parent_full_name }}</td>
                    <td>{{ $item->phone1 }}</td>
                    <td>{{ $item->phone2 }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->source }}</td>
                    <td>{{ $item->admin_note }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
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
      var wb = XLSX.utils.table_to_book(table, { sheet: "arizalar" });
      var fileName = "barcha_bolalar_qabul_arizalari" + new Date().toISOString().slice(0, 10) + ".xlsx";
      XLSX.writeFile(wb, fileName);
  }
</script>
@endsection