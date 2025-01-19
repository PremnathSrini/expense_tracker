@extends('user.layouts.default')
@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div
                        class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Add Bill</h6>
                        <a href="{{ route('user.bills') }}" class="btn btn-secondary mx-3 px-3 float-end"><i
                                class="material-symbols-rounded text-lg">close</i></a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <form action="{{route('user.bill.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-11">
                                @error('name')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3">
                                    <label class="form-label">Bill Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('description')}}">
                                </div>
                                @error('amount')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3">
                                    <label class="form-label">Amount<span class="text-danger">*</span></label>
                                    <input type="text" name="amount" id="amount" class="form-control" value="{{old('amount')}}">
                                </div>
                                @error('date')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3">
                                    <label class="form-label">Due Date<span class="text-danger">*</span></label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{old('date')}}">
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
                                                value="1" {{ old('paid') == "1" ? "checked='checked'" : '' }}> Yes
                                            </label>
                                            <label for="paid_no">
                                                <input type="radio" name="paid" id="paid_no"
                                                value="0" {{ old('paid') == "2" ? "checked='checked'" : '' }}> No
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
                                                value="1" {{ old('recurring') == 'yes' ? "checked='checked'" : '' }}> Yes
                                            </label>
                                            <label for="no">
                                                <input type="radio" name="recurring" id="no"
                                                value="0" {{ old('recurring') == 'no' ? "checked='checked'" : '' }}> No
                                            </label>
                                        </div>
                                    </div>                                    
                                </div>
                                @error('recurring_period')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3 recurring_section d-none">
                                    <label for="recurring_period" class="form-label">Recurring period<span
                                            class="text-danger">*</span></label>                                    
                                    <select name="recurring_period" id="recurring_period" class="form-control px-3 py-3">
                                        <option value=""></option>
                                        <option value="1">Weekly</option>
                                        <option value="2">Monthly</option>
                                        <option value="3">Quarterly</option>
                                        <option value="4">Annually</option>
                                    </select>
                                </div>                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mx-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('input[name="recurring"]').on('change',function(){
                if($('#yes').is(':checked')){
                    $('.recurring_section').removeClass('d-none');
                }else{
                    $('.recurring_section').addClass('d-none');
                }
            });    
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