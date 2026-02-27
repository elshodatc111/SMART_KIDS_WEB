@extends('layouts.admin')
@section('title', __('menu.barcha_guruhlar') )
@section('content')
  <div class="pagetitle">
    <h1>{{ __('menu.barcha_guruhlar') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
        <li class="breadcrumb-item active">{{ __('menu.barcha_guruhlar') }}</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title">{{ __('menu.barcha_guruhlar') }}</h5>
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
                  <th>FIO</th>
                  <th>Telefon raqam</th>
                  <th>Qo'shimcha telefon raqam</th>
                  <th>Yashash manzili</th>
                  <th>Tugilgan kuni</th>
                  <th>Malumoti</th>
                  <th>O'qish joyi</th>
                  <th>Oldingi ish joyi</th>
                  <th>Ishlashdan maqsad</th>
                  <th>Kutayotgan ish haqi</th>
                  <th>Lovozimga nomzod</th>
                  <th>Status</th>
                  <th>Biz haqimizda</th>
                  <th>Admin hodim haqida fikri</th>
                  <th>Oxirgi yangilanish</th>
                  <th>Ariza vaqti</th>
                </tr>
              </thead>
              <tbody>
                
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
      var fileName = "barcha_guruhlar" + new Date().toISOString().slice(0, 10) + ".xlsx";
      XLSX.writeFile(wb, fileName);
  }
</script>
@endsection