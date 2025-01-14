<div class="main-panel">
  <div class="content-wrapper">
      <div class="row">
          <!-- Metric Cards -->
          <div class="col-xl-3 col-md-6 grid-margin stretch-card">
              <div class="card text-white bg-primary">
                  <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                              <h3 class="mb-0">{{$total_product}}</h3>
                              <p class="card-text">Total Products</p>
                          </div>
                          <div>
                              <i class="mdi mdi-cube-outline icon-lg"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-6 grid-margin stretch-card">
              <div class="card text-white bg-success">
                  <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                              <h3 class="mb-0">{{$total_order}}</h3>
                              <p class="card-text">Total Orders</p>
                          </div>
                          <div>
                              <i class="mdi mdi-cart-outline icon-lg"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-6 grid-margin stretch-card">
              <div class="card text-white bg-info">
                  <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                              <h3 class="mb-0">{{$total_customer}}</h3>
                              <p class="card-text">Total Customers</p>
                          </div>
                          <div>
                              <i class="mdi mdi-account-group icon-lg"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-6 grid-margin stretch-card">
              <div class="card text-white bg-warning">
                  <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                              <h3 class="mb-0">${{$total_revenue}}</h3>
                              <p class="card-text">Total Revenue</p>
                          </div>
                          <div>
                              <i class="mdi mdi-cash-multiple icon-lg"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-6 grid-margin stretch-card">
              <div class="card text-white bg-teal">
                  <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                              <h3 class="mb-0">{{$total_delivered}}</h3>
                              <p class="card-text">Orders Delivered</p>
                          </div>
                          <div>
                              <i class="mdi mdi-truck-delivery icon-lg"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-6 grid-margin stretch-card">
              <div class="card text-white bg-danger">
                  <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                              <h3 class="mb-0">{{$total_processing}}</h3>
                              <p class="card-text">Orders Processing</p>
                          </div>
                          <div>
                              <i class="mdi mdi-progress-clock icon-lg"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Table Section -->
      <div class="row mt-4">
          <div class="col-xl-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Detailed Metrics Breakdown</h4>
                      <div class="table-responsive">
                          <table class="table table-striped">
                              <thead class="thead-dark">
                                  <tr>
                                      <th>Metric</th>
                                      <th>Total</th>
                                      <th>Growth (%)</th>
                                      <th>Comparison (Last Month)</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>Total Products</td>
                                      <td>{{$total_product}}</td>
                                      <td>+5%</td>
                                      <td>120 → 126</td>
                                  </tr>
                                  <tr>
                                      <td>Total Orders</td>
                                      <td>{{$total_order}}</td>
                                      <td>+8%</td>
                                      <td>450 → 486</td>
                                  </tr>
                                  <tr>
                                      <td>Total Customers</td>
                                      <td>{{$total_customer}}</td>
                                      <td>+10%</td>
                                      <td>300 → 330</td>
                                  </tr>
                                  <tr>
                                      <td>Total Revenue</td>
                                      <td>${{$total_revenue}}</td>
                                      <td>+15%</td>
                                      <td>$45,000 → $51,750</td>
                                  </tr>
                                  <tr>
                                      <td>Orders Delivered</td>
                                      <td>{{$total_delivered}}</td>
                                      <td>+7%</td>
                                      <td>350 → 374</td>
                                  </tr>
                                  <tr>
                                      <td>Orders Processing</td>
                                      <td>{{$total_processing}}</td>
                                      <td>-3%</td>
                                      <td>50 → 48</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Footer -->
  <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">© 2025 Famms</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
              Built with <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a>
          </span>
      </div>
  </footer>
</div>
