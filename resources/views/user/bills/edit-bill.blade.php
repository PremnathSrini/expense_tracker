@extends('user.layouts.default')
@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div
                        class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Edit Bill</h6>
                        <a href="{{ route('user.bills') }}" class="btn btn-secondary mx-3 px-3 float-end"><i
                                class="material-symbols-rounded text-lg">close</i></a>
                    </div>
                </div>
                @if(Session::has('error'))
                    <script>
                        $(document).ready(function(){
                            toastr.error("{{Session::get('error')}}");
                        });
                    </script>
                @endif
                <div class="card-body px-0 pb-2">
                    <form action="{{route('user.bill.update',base64_encode($bill->id))}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col-md-11">
                                @error('name')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3 is-filled">
                                    <label class="form-label">Bill Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{$bill->name}}">
                                </div>
                                @error('amount')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3 is-filled">
                                    <label class="form-label">Amount<span class="text-danger">*</span></label>
                                    <input type="text" name="amount" id="amount" class="form-control" value="{{$bill->amount}}">
                                </div>
                                @error('date')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3 is-filled">
                                    <label class="form-label">Due Date<span class="text-danger">*</span></label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{$bill->due_date}}">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        @error('paid')
                                        <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                        @enderror
                                        <div class="input-group-outline">
                                            <label class="form-label mx-4 text-sm text-primary">Is Paid?<span
                                                class="text-danger">*</span>
                                            </label>
                                            <label for="paid_yes">
                                                <input type="radio" name="paid" id="paid_yes"
                                                value="1" {{ $bill->is_paid == "1" ? "checked='checked'" : '' }}> Yes
                                            </label>
                                            <label for="paid_no">
                                                <input type="radio" name="paid" id="paid_no"
                                                value="0" {{ $bill->is_paid == "0" ? "checked='checked'" : '' }}> No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        @error('recurring')
                                        <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                        @enderror
                                        <div class="input-group-outline">
                                            <label class="form-label mx-3 text-sm text-primary">Is Recurring?<span
                                                class="text-danger">*</span>
                                            </label>
                                            <label for="yes">
                                                <input type="radio" name="recurring" id="yes"
                                                value="1" {{ $bill->is_recurring == '1' ? "checked='checked'" : '' }}> Yes
                                            </label>
                                            <label for="no">
                                                <input type="radio" name="recurring" id="no"
                                                value="0" {{ $bill->is_recurring == '0' ? "checked='checked'" : '' }}> No
                                            </label>
                                        </div>
                                    </div>                                    
                                </div>
                                @error('recurring_period')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3 recurring_section d-none is-filled">
                                    <label for="recurring_period" class="form-label">Recurring period<span
                                            class="text-danger">*</span></label>                                    
                                    <select name="recurring_period" id="recurring_period" class="form-control px-3 py-3">
                                        <option value=""></option>
                                        <option value="1" {{$bill->recurring_interval == '1' ? 'Selected="selected' : ''}}>Weekly</option>
                                        <option value="2" {{$bill->recurring_interval == '2' ? 'Selected="selected' : ''}}>Monthly</option>
                                        <option value="3" {{$bill->recurring_interval == '3' ? 'Selected="selected' : ''}}>Quarterly</option>
                                        <option value="4" {{$bill->recurring_interval == '4' ? 'Selected="selected' : ''}}>Annually</option>
                                    </select>
                                </div>                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mx-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
    <script>
        $(document).ready(function() {
            const toggleRecurringSection = function(){
                if($('#yes').is(':checked')){
                    $('.recurring_section').removeClass('d-none');
                }else{
                    $('.recurring_section').addClass('d-none');
                }
            };
            $('input[name="recurring"]').on('change',toggleRecurringSection);
            toggleRecurringSection();         
        });
        $('select[name="recurring_period"]').on('change',function(){
            $('.recurring_section').addClass('is-filled');
            if($(this).val() === ''){
                $('.recurring_section').removeClass('is-filled');
            }else{
                $('.recurring_section').addClass('is-filled');
            }
        });
    </script>
    @endpush
    @endsection