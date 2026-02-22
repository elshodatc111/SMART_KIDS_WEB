@extends('layouts.admin')
@section('title', 'Kassa nazorati')

@section('content')
    <div class="pagetitle">
      <h1>Kassa nazorati</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.dashboard') }}</a></li>
          <li class="breadcrumb-item active">Kassa</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        
        <div class="col-lg-12">
          <div class="card info-card sales-card">
            <div class="card-body">
              <div class="row border-bottom">
                <div class="col-lg-6 border-end">
                  <h5 class="card-title">Kassada mavjud <span>| Jami balans</span></h5>
                  <div class="row">
                      <div class="col-xxl-4 col-md-4">
                          <div class="card shadow-none border d-flex align-items-center p-2">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success-light text-success">
                                  <i class="bi bi-cash-stack"></i>
                              </div>
                              <div class="ps-2 text-center">
                                  <h6 class="mb-0">0 UZS</h6>
                                  <span class="text-muted small pt-2 ps-1">Naqd pul</span>
                              </div>
                          </div>
                      </div>
                      <div class="col-xxl-4 col-md-4">
                          <div class="card shadow-none border d-flex align-items-center p-2">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary-light text-primary">
                                  <i class="bi bi-credit-card"></i>
                              </div>
                              <div class="ps-2 text-center">
                                  <h6 class="mb-0">152 000 UZS</h6>
                                  <span class="text-muted small pt-2 ps-1">Plastik karta</span>
                              </div>
                          </div>
                      </div>
                      <div class="col-xxl-4 col-md-4">
                          <div class="card shadow-none border d-flex align-items-center p-2">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info-light text-info">
                                  <i class="bi bi-bank"></i>
                              </div>
                              <div class="ps-2 text-center">
                                  <h6 class="mb-0">152 000 UZS</h6>
                                  <span class="text-muted small pt-2 ps-1">Hisob raqam (Bank)</span>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <h5 class="card-title">Tasdiqlanishi kutilayotgan <span>chiqimlar | xarajatlar</span></h5>
                  <div class="row">
                      <div class="col-xxl-4 col-md-4">
                          <div class="card shadow-none border d-flex align-items-center p-2">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success-light text-success">
                                  <i class="bi bi-cash-stack"></i>
                              </div>
                              <div class="ps-2 text-center">
                                  <h6 class="mb-0 text-warning">0 UZS</h6>
                                  <span class="text-muted small pt-2 ps-1">Naqd pul</span>
                              </div>
                          </div>
                      </div>
                      <div class="col-xxl-4 col-md-4">
                          <div class="card shadow-none border d-flex align-items-center p-2">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary-light text-primary">
                                  <i class="bi bi-credit-card"></i>
                              </div>
                              <div class="ps-2 text-center">
                                  <h6 class="mb-0 text-warning">152 000 UZS</h6>
                                  <span class="text-muted small pt-2 ps-1">Plastik karta</span>
                              </div>
                          </div>
                      </div>
                      <div class="col-xxl-4 col-md-4">
                          <div class="card shadow-none border d-flex align-items-center p-2">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info-light text-info">
                                  <i class="bi bi-bank"></i>
                              </div>
                              <div class="ps-2 text-center">
                                  <h6 class="mb-0 text-warning">152 000 UZS</h6>
                                  <span class="text-muted small pt-2 ps-1">Hisob raqam (Bank)</span>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-3"><button class="w-100 mt-2 btn btn-outline-success px-4" data-bs-toggle="modal" data-bs-target="#chiqim_post"><i class="bi bi-arrow-up-right-circle me-1"></i> Kassadan chiqim</button></div>
                <div class="col-3"><button class="w-100 mt-2 btn btn-outline-primary px-4" data-bs-toggle="modal" data-bs-target="#xarajat"><i class="bi bi-cart-dash me-1"></i> Xarajatlar</button></div>
                <div class="col-3"><button class="w-100 mt-2 btn btn-outline-danger px-4" data-bs-toggle="modal" data-bs-target="#qytarilgan_tulov"><i class="bi bi-arrow-counterclockwise"></i> Qaytarilgan to'lovlar</button></div>
                <div class="col-3"><button class="w-100 mt-2 btn btn-outline-warning px-4 text-dark" data-bs-toggle="modal" data-bs-target="#chegirmalar"><i class="bi bi-percent"></i> Chegirmalar hisobi</button></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-danger">Tasdiqlanmagan operatsiyalar</h5>
              <div class="table-responsive">
                <table class="table table-bordered" style="font-size: 14px;">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Summa</th>
                      <th scope="col">Chiqim turi</th>
                      <th scope="col">Izoh (Haqida)</th>
                      <th scope="col">Vaqt</th>
                      <th scope="col">Menejer</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">1</td>
                      <td class="text-center">15 000 UZS (Naqt)</td>
                      <td class="text-center">Chiqim</td>
                      <td>Test Uchun</td>
                      <td>2025-12-12 15:01:11</td>
                      <td>Elshod Musurmonov</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <form action="#" method="post" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-outline-success btn-sm" title="Tasdiqlash">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>

                            <form action="#" method="post" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Bekor qilish">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">2</td>
                      <td class="text-center">15 000 UZS (Plastik)</td>
                      <td class="text-center">Xarajat</td>
                      <td>Test Uchun</td>
                      <td>2025-12-12 15:01:11</td>
                      <td>Elshod Musurmonov</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <form action="#" method="post" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-outline-success btn-sm" title="Tasdiqlash">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>

                            <form action="#" method="post" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Bekor qilish">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">3</td>
                      <td class="text-center">15 000 UZS (Karta)</td>
                      <td class="text-center">To'lov</td>
                      <td>Alimov Sarva uchun to'lov</td>
                      <td>2025-12-12 15:01:11</td>
                      <td>Elshod Musurmonov</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <form action="#" method="post" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-outline-success btn-sm" title="Tasdiqlash">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>

                            <form action="#" method="post" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Bekor qilish">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">4</td>
                      <td class="text-center">15 000 UZS (Bank)</td>
                      <td class="text-center">To'lov</td>
                      <td>Kamronov Kamol uchun to'lov</td>
                      <td>2025-12-12 15:01:11</td>
                      <td>Elshod Musurmonov</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <form action="#" method="post" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-outline-success btn-sm" title="Tasdiqlash">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>

                            <form action="#" method="post" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Bekor qilish">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="7" class="text-center py-4 text-muted">
                        <i class="bi bi-info-circle me-1"></i> Tasdiqlanmagan chiqimlar mavjud emas.
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Chiqim Modal -->
        <div class="modal" id="chiqim_post" tabindex="-1">
          <form action="#" method="post">
            @csrf 
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Kassadan chiqim qilish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                  <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- Xarajat Modal -->
        <div class="modal" id="xarajat" tabindex="-1">
          <form action="#" method="post">
            @csrf 
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Kassadan xarajat uchun chiqim qilish</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                  <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- Qaytarilgan to'lovlar -->
        <div class="modal fade" id="qytarilgan_tulov" tabindex="-1">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Qaytarilgan to'lovlar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="p-0">Ogirgi 45 kunda qaytarib berilgan to'lovlar</p>
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px;">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Summa</th>
                        <th scope="col">Chiqim turi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">15 000 UZS(Naqt)</td>
                        <td class="text-center">Chiqim</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Chegirmalar -->
        <div class="modal fade" id="chegirmalar" tabindex="-1">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Chegirmalar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="p-0">Ogirgi 45 kunda berilgan chegirmalar</p>
                <div class="table-responsive">
                  <table class="table table-bordered" style="font-size: 14px;">
                    <thead>
                      <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Summa</th>
                        <th scope="col">Chiqim turi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">15 000 UZS(Naqt)</td>
                        <td class="text-center">Chiqim</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
              </div>
            </div>
          </div>
        </div>



      </div>
    </section>
@endsection