  <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
              <div class="card-body p-3">
                  <div class="row">
                      <div class="col-8">
                          <div class="numbers">
                              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Users</p>
                              <h5 class="font-weight-bolder">
                                  {{ $totalUsers }}
                              </h5>
                          </div>
                      </div>
                      <div class="col-4 text-end">
                          <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
              <div class="card-body p-3">
                  <div class="row">
                      <div class="col-8">
                          <div class="numbers">
                              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Videos</p>
                              <h5 class="font-weight-bolder">
                                  {{ $totalVideos }}
                              </h5>
                          </div>
                      </div>
                      <div class="col-4 text-end">
                          <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                              <i class="fa fa-world text-lg opacity-10" aria-hidden="true"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
              <div class="card-body p-3">
                  <div class="row">
                      <div class="col-8">
                          <div class="numbers">
                              <p class="text-sm mb-0 text-uppercase font-weight-bold">Published</p>
                              <h5 class="font-weight-bolder">
                                  {{ $totalInfos }}
                              </h5>
                          </div>
                      </div>
                      <div class="col-4 text-end">
                          <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                              <i class="fa fa-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-sm-6">
          <div class="card">
              <div class="card-body p-3">
                  <div class="row">
                      <div class="col-8">
                          <div class="numbers">
                              <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                              <h5 class="font-weight-bolder">
                                  ${{ $money }}
                              </h5>
                              {{-- <p class="mb-0">
                                  <span class="text-success text-sm font-weight-bolder">+5%</span> than last
                                  month
                              </p> --}}
                          </div>
                      </div>
                      <div class="col-4 text-end">
                          <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                              <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
