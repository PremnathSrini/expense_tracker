@extends('user.layouts.default')
@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                <h6 class="text-white text-capitalize ps-3">Bills</h6>
                <a href="{{route('user.bill.create')}}" class="btn btn-primary mx-3 float-end">Add new</a>
            </div>
        </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bill Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount (&#8377;)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- example --}}
                    @forelse ($bills as $bill)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <p class="text-xs text-secondary mx-3 text-center mt-3">#{{$bill->id}}</p>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$bill->name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">&#8377;{{$bill->amount}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                          @if($bill->is_paid == '0')
                            <span class="badge badge-sm bg-gradient-danger">Not Paid</span>
                          @else
                            <span class="badge badge-sm bg-gradient-success">Paid</span>
                          @endif
                      </td>
                      <td class="align-middle text-center">
                        @if($bill->due_date >= Carbon\Carbon::now() && $bill->due_date <= Carbon\Carbon::now()->addDays(5))
                            <span class="badge badge-sm bg-gradient-warning" title="warning remaining days are less than 5 days" data-toggle="tool-tip">{{date('Y-m-d',strtotime($bill->due_date))}}</span>
<<<<<<< HEAD
                        @else
                            <span class="text-secondary text-xs font-weight-bold">{{date('Y-m-d',strtotime($bill->due_date))}}</span>
                        @endif
=======
                          @else
                            <span class="text-secondary text-xs font-weight-bold">{{date('Y-m-d',strtotime($bill->due_date))}}</span>
                          @endif
>>>>>>> 5edcba8e05c4cc0fe9fbd85b8703373d9ed1e6ea
                      </td>
                      <td class="d-flex justify-content-around align-items-center mt-3 pt-3">
                        <a href="{{route('user.bill.edit',base64_encode($bill->id))}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit bill">
                          Edit
                        </a>
                        {{-- <a href="{{route('user.bill.mark-as-paid',base64_encode($bill->id))}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit bill">
                          Mark as Paid
                        </a> --}}
                        <a href="{{route('user.bill.destroy',base64_encode($bill->id))}}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="delete bill">
                          Delete
                        </a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="5" class="text-center">No Bills found. Start by adding one!</td>
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
@endsection
