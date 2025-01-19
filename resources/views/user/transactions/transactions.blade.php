@extends('user.layouts.default')
@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                <h6 class="text-white text-capitalize ps-3">Transactions</h6>
                <a href="{{route('user.transaction.create')}}" class="btn btn-primary mx-3 float-end">Add new</a>
            </div>
            {{-- <a href="" class="btn btn-primary mt-2 float-end">Add new</a> --}}
        </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- example --}}
                    @forelse($transactions as $transaction)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            @if($transaction->type == 'expense')
                                <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-symbols-rounded text-lg">expand_more</i></button>
                            @else
                            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-symbols-rounded text-lg">expand_less</i></button>
                            @endif
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$transaction->description}}</h6>
                            <p class="text-xs text-secondary mb-0">{{$transaction->category->name}}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">&#8377; {{number_format($transaction->amount,2)}}</p>
                        <p class="text-xs text-secondary mb-0"> {{$transaction->attachment->name ?? ''}} </p>
                      </td>
                      <td class="align-middle text-center text-sm">
                            @if($transaction->type == 'expense')
                            <span class="badge badge-sm bg-gradient-danger">{{ucfirst($transaction->type)}}</span>
                            @else
                            <span class="badge badge-sm bg-gradient-success">{{ucfirst($transaction->type)}}</span>
                            @endif
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$transaction->date}}</span>
                      </td>
                      <td class="align-middle">
                        <a href="{{route('user.transaction.edit',base64_encode($transaction->id))}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="5" class="text-center">No Transaction found. Start by adding one!</td>
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
