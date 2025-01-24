@extends('user.layouts.default')
@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div
                        class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Add Transaction</h6>
                        <a href="{{ route('user.transactions') }}" class="btn btn-secondary mx-3 px-3 float-end"><i
                                class="material-symbols-rounded text-lg">close</i></a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <form action="{{route('user.transaction.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                @error('description')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3">
                                    <label class="form-label">Description<span class="text-danger">*</span></label>
                                    <input type="text" name="description" id="description" class="form-control" value="{{old('description')}}">
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
                                <div class="input-group input-group-outline mb-3 mx-3 date-class">
                                    <label class="form-label">Date<span class="text-danger">*</span></label>
                                    <input type="text" name="date" id="date" class="form-control" value="{{old('date')}}">
                                </div>
                                @error('type')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group-outline">
                                    <label class="form-label mx-3 text-md">Type<span
                                            class="text-danger">*</span></label>
                                    <label for="income">
                                        <input type="radio" name="type" id="income"
                                            value="1" {{ old('type') == 'income' ? "checked='checked'" : '' }}> Income
                                    </label>
                                    <label for="expense">
                                        <input type="radio" name="type" id="expense"
                                            value="2" {{ old('type') == 'expense' ? "checked='checked'" : '' }}> Expense
                                    </label>
                                </div>
                                @error('category')
                                <span class="text-danger text-sm mx-3"> {{$message}} </span>
                                @enderror
                                <div class="input-group input-group-outline mb-3 mx-3 category-class">
                                    {{-- <div class="col-sm-2"> --}}
                                    <label for="category" class="form-label">Category <span
                                            class="text-danger">*</span></label>
                                    {{-- </div> --}}
                                    {{-- <div class="col-md-10"> --}}
                                    <select name="category" id="category" class="form-control px-3 py-3">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{old('category') == $category->id ? "selected='selected'" : ''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- </div> --}}
                                </div>
                                <div class="input-group input-group-outline mb-3 mx-3 other-text d-none">
                                    <label class="form-label">Category If Others</label>
                                    <input type="text" name="other_text" id="other_text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card h-100 mx-3">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                        <label for="fileInput" class="d-flex flex-column align-items-center">
                                            <i class="material-symbols-rounded mb-3" style="font-size: 3rem;">add</i>
                                            <h4>Upload an Invoice</h4>
                                        </label>
                                        <input type="file" id="fileInput" name="invoice" class="d-none" />
                                        <div id="filePreview" class="mt-3 text-secondary"></div>
                                    </div>
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
            $('#category').on('change', function() {
                $('.category-class').addClass('is-filled');
                if ($(this).val() === '13') {
                    $('.other-text').removeClass('d-none');

                } else {
                    $('.other-text').addClass('d-none');
                }
            });
            $('#fileInput').on('change', function() {
                const file = this.files[0];
                console.log(file);
                console.log(1);
                const $filePreview = $('#filePreview');

                if (file) {
                    $filePreview.text(`Selected file: ${file.name}`);
                } else {
                    $filePreview.text('');
                }
            });
            $('#date').on('focus', function () {
                $(this).attr('type', 'date');
            });
            $('#date').on('blur', function () {
                $(this).attr('type', 'text');
                $('.date-class').removeClass('is-focused');
            });
        });
    </script>
    @endpush
    @endsection
