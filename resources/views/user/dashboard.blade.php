@extends('user.layouts.default')
@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="d-flex justify-content-between align-items-start align-items-lg-center ms-1 ms-md-3 flex-wrap gap-3">
            <div class="me-2">
                <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
                <p class="mb-4">
                    Check your overall spend analysis.
                </p>
            </div>
            <div class="dashboard-filter-panel">
                <p class="mb-1 text-primary font-weight-bolder">
                    Filter transaction range
                </p>
                <p class="text-xs text-secondary mb-2" id="range-text">Showing data for selected range</p>
                <div class="input-group dashboard-filter-group">
                    <span class="input-group-text border-0 bg-transparent pe-2">
                        <i class="material-symbols-rounded opacity-9">date_range</i>
                    </span>
                    <input type="text" class="form-control bg-white px-2" id="daterange-picker"
                        placeholder="Select date range" readonly>
                    <input type="hidden" name="hidden-href" id="hidden-href" value="{{ route('fetch-data') }}">
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Total Expense</p>
                            <h4 class="mb-0">&#8377; {{number_format($total_expense)}}</h4>
                        </div>
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">money_off</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    {{-- <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>than last
                        week</p> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Total Income</p>
                            <h4 class="mb-0">&#8377; {{number_format($total_income)}}</h4>
                        </div>
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">attach_money</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    {{-- <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>than last
                        month</p> --}}
                </div>
            </div>
        </div>
        <!-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Ads Views</p>
              <h4 class="mb-0">3,462</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">leaderboard</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>than yesterday</p>
        </div>
      </div>
    </div> -->
        <!-- <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Sales</p>
              <h4 class="mb-0">$103,430</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than yesterday</p>
        </div>
      </div>
    </div> -->
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-0 ">Transaction Analysis</h6>
                    <p class="text-sm ">For Last Month</p>
                    <div class="pe-2">
                        <div class="chart">
                            <canvas id="pie-chart" class="pie-chart-canvas dashboard-chart"></canvas>
                        </div>
                    </div>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm">just updated</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card ">
                <div class="card-body">
                    <h6 class="mb-0 "> Daily Sales </h6>
                    <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>
                    <div class="pe-2">
                        <div class="chart">
                            <canvas id="bar-chart" class="bar-chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm"> updated 4 min ago </p>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-8 col-md-6 mt-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-0 ">Transaction Analysis</h6>
                    <p class="text-sm ">For Last Month</p>
                    <div class="pe-2">
                        <div class="chart">
                            <canvas id="line-chart" class="line-chart-canvas dashboard-chart"></canvas>
                        </div>
                    </div>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm">just updated</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Transactions --}}

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card h-100 mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Your Transaction's</h6>
                            <i class="material-symbols-rounded me-2 mt-2 text-lg">date_range</i>
                            <small class="my-0 text-md">Last 5 transactions</small>
                        </div>
                        <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                            <a href="{{route('user.transaction.create')}}" class="btn btn-primary"><i
                                    class="material-symbols-rounded me-2 text-lg">add</i> Add new</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <!-- <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6> -->
                    <ul class="list-group">
                        @foreach($lastFiveTransactions as $transaction)
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                @if($transaction->type == 'expense')
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="material-symbols-rounded text-lg">expand_more</i></button>
                                @else
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="material-symbols-rounded text-lg">expand_less</i></button>
                                @endif
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">{{$transaction->description}}</h6>
                                    <span class="text-xs">{{ date('d F Y', strtotime($transaction->date)) }}</span>
                                </div>
                            </div>
                            @if($transaction->type == 'expense')
                            <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                - &#8377; {{$transaction->amount}}
                            </div>
                            @else
                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                + &#8377; {{$transaction->amount}}
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    <!-- <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6> -->
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- {{-- <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h6>Orders overview</h6>
            <p class="text-sm">
              <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
              <span class="font-weight-bold">24%</span> this month
            </p>
          </div>
          <div class="card-body p-3">
            <div class="timeline timeline-one-side">
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="material-symbols-rounded text-success text-gradient">notifications</i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                </div>
              </div>
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="material-symbols-rounded text-danger text-gradient">code</i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                </div>
              </div>
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="material-symbols-rounded text-info text-gradient">shopping_cart</i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                </div>
              </div>
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="material-symbols-rounded text-warning text-gradient">credit_card</i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                </div>
              </div>
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="material-symbols-rounded text-primary text-gradient">key</i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                </div>
              </div>
              <div class="timeline-block">
                <span class="timeline-step">
                  <i class="material-symbols-rounded text-dark text-gradient">payments</i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}} -->
    </div>
</div>
@push('custom-styles')
<style>
    .dashboard-filter-panel {
        min-width: 290px;
        width: 100%;
        max-width: 440px;
    }

    .dashboard-filter-group {
        border: 1px solid #d2d6da;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0 0.2rem 0.6rem rgba(33, 37, 41, 0.08);
    }

    .dashboard-filter-group #daterange-picker {
        border: 0;
        color: #344767;
        font-weight: 600;
        cursor: pointer;
    }

    .dashboard-filter-group #daterange-picker:focus {
        box-shadow: none;
    }

    .dashboard-chart {
        min-height: 320px;
        width: 100%;
    }

    .daterangepicker .drp-selected {
        color: #2dce89;
        font-weight: 700;
    }

    .daterangepicker td.active,
    .daterangepicker td.active:hover {
        background-color: #344767;
        border-color: #344767;
    }

    .daterangepicker .ranges li.active {
        background-color: #344767;
        color: #fff;
    }
</style>
@endpush
@push('custom-scripts')
<script>
    $(document).ready(function() {
    const $rangeText = $('#range-text');
    const $dateRangePicker = $('#daterange-picker');
    const href = $('#hidden-href').val();

    function setRangeText(startDate, endDate) {
      const formatted = `${startDate.format('DD MMM YYYY')} - ${endDate.format('DD MMM YYYY')}`;
      $rangeText.text(`Showing data for ${formatted}`);
    }

    function applyChartData(response) {
      const labels = response && Array.isArray(response.labels) ? response.labels : [];
      const prices = response && Array.isArray(response.prices) ? response.prices : [];
      const expenses = response && Array.isArray(response.expenses) ? response.expenses : [];
      const incomes = response && Array.isArray(response.incomes) ? response.incomes : [];

      pie.data.labels = labels;
      pie.data.datasets[0].data = prices;
      pie.update();

      line.data.labels = labels;
      line.data.datasets[0].data = expenses;
      line.data.datasets[1].data = incomes;
      line.update();
    }

    $dateRangePicker.daterangepicker({
      autoApply: true,
      alwaysShowCalendars: true,
      maxDate: moment(),
      opens: 'left',
      startDate: moment().subtract(6, 'days'),
      endDate: moment(),
      locale: {
        format: 'YYYY-MM-DD',
        cancelLabel: 'Clear'
      },
      ranges: {
        'Today': [moment(), moment()],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    });

    setRangeText(moment().subtract(6, 'days'), moment());

    $dateRangePicker.on('apply.daterangepicker', function(ev, picker) {
      const startDate = picker.startDate;
      const endDate = picker.endDate;
      setRangeText(startDate, endDate);

      $.ajax({
        url: href,
        method: 'POST',
        data: {
          start_date: startDate.format('YYYY-MM-DD'),
          end_date: endDate.format('YYYY-MM-DD'),
          _token: `{{ csrf_token() }}`
        },
        success: function(response) {
          if (!response || !response.labels || response.labels.length === 0) {
            toastr.info('No data available for the selected date range.');
            applyChartData({
              labels: [],
              prices: [],
              expenses: [],
              incomes: []
            });
            return;
          }

          applyChartData(response);
        },
        error: function() {
          toastr.error('Unable to fetch data for the selected date range.');
        }
      });
    });

    var labels = @json($labels);
    var prices = @json($prices);
    var incomes = @json($incomes);
    var expenses = @json($expenses);

    const pieCtx = $('.pie-chart-canvas').get(0).getContext('2d');
    const pie = new Chart(pieCtx, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          label: 'Spend Analysis',
          data: prices,
          backgroundColor: [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(199, 199, 199, 0.6)',
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(199, 199, 199, 0.6)',
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top'
          },
        }
      }
    });
    // const barCtx = $('.bar-chart-canvas').get(0).getContext('2d');
    // const bar = new Chart(barCtx,{
    //     type: 'bar',
    //     data: {
    //         labels: labels,
    //         datasets: [{
    //             label: 'Spend Analysis',
    //             data: prices,
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.6)',
    //                 'rgba(54, 162, 235, 0.6)',
    //                 'rgba(255, 206, 86, 0.6)',
    //                 'rgba(75, 192, 192, 0.6)',
    //                 'rgba(153, 102, 255, 0.6)'
    //             ],
    //             borderColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: {
    //                 position: 'top'
    //             },
    //         }
    //     }
    // });
    const lineCtx = $('.line-chart-canvas').get(0).getContext('2d');
    const line = new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
            label: 'Expenses',
            data: expenses,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            tension: 0.4,
            fill: false,
          },
          {
            label: 'Incomes',
            data: incomes,
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            tension: 0.4,
            fill: false,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
          },
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Categories',
            },
          },
          y: {
            title: {
              display: true,
              text: 'Values',
            },
            beginAtZero: true,
          },
        },
      },
    });
  });
</script>
@endpush
@endsection
