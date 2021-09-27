@component('panel.layouts.component', ['title' => 'لیست درخواست‌های برداشت وجه'])

    @slot('style')
        <link rel="stylesheet" href="{{ asset('modules/css/mahamax-order.css') }}">
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i> درخواست‌های برداشت وجه </h1>
        <p>این بخش برای مدیریت درخواست‌های برداشت وجه است.</p>
    @endslot

    @slot('breadcrumb')
        {{-- <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">همه تراکنش‌ها</a></li>
        <li class="breadcrumb-item">لیست تراکنش‌ها</li> --}}
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'withdraw_list', 'show' => 'show', 'title' => ' لیست درخواست‌های برداشت وجه'])
                            @slot('body')
                                @component('components.collapse-search')
                                    @slot('form')
                                        {{-- <form class="clearfix" method="get">
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                    <label for="id">شناسه تراکنش‌</label>
                                                    <input type="text" class="form-control" id="id" name="id" value="{{ request('id') }}"
                                                           placeholder="شناسه تراکنش‌">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="user_id">کاربر</label>
                                                    <select name="user_id" id="user_id"
                                                            class="form-control select2 select2-user">

                                                        @if( request('user_id') )
                                                            <option value="{{ request('user_id') }}" selected="selected">
                                                                {{ \App\Models\User::find( request('user_id') )->full_name }}
                                                            </option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="creator_id">ایجاد کننده</label>
                                                    <select name="creator_id" id="creator_id"
                                                            class="form-control select2 select2-user">

                                                        @if( request('creator_id') )
                                                            <option value="{{ request('creator_id') }}" selected="selected">
                                                                {{ \App\Models\User::find( request('creator_id') )->full_name }}
                                                            </option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="created_at">تاریخ تراکنش‌</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-group datepicker">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">از</span>
                                                                </div>
                                                                <input type="hidden" class="dp_date" id="transaction_date_transaction_dp_date"
                                                                       name="transaction_date_from" value="">
                                                                <input type="text" class="form-control dp_text"
                                                                       id="transaction_date_created_dp_text" name="transaction_date_created_date_dp" dir="ltr" placeholder="از تاریخ " value="{{ request('transaction_date_created_dp_text') }}">
                                                                <div class="input-group-prepend">
                                                <span class="input-group-text cursor-pointer dp_handle"
                                                      id="transaction_date_created_date_dp"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <span class="invalid-feedback d-none" role="alert">
                                            <strong></strong>
                                            </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group datepicker">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">تا</span>
                                                                </div>
                                                                <input type="hidden" class="dp_date" id="transaction_date_transaction_until_dp_date"
                                                                       name="transaction_date_until" value="">
                                                                <input type="text" class="form-control dp_text"
                                                                       id="transaction_date_created_until_dp_text"
                                                                       name="transaction_date_created_until_date_dp"
                                                                       dir="ltr" placeholder="تا تاریخ "
                                                                       value="{{ request('transaction_date_created_until_dp_text') }}">
                                                                <div class="input-group-prepend">
                                                <span class="input-group-text cursor-pointer dp_handle"
                                                      id="transaction_date_created_until_date_dp"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <span class="invalid-feedback d-none" role="alert">
                                            <strong></strong>
                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="amount">مبلغ تراکنش‌</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">مبلغ از</span>
                                                                    </div>
                                                                    <input type="text" class="form-control number_format ltr" id="from_amount" name="from_amount" value="{{ request('from_amount') }}" placeholder="از مبلغ">

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">مبلغ تا</span>
                                                                    </div>
                                                                    <input type="text" class="form-control number_format ltr" id="until_amount" name="until_amount" value="{{ request('until_amount') }}" placeholder="تا مبلغ">
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                    <label for="wallet_id">کیف پول‌</label>
                                                    <select name="wallet_id" id="wallet_id"
                                                            class="form-control select2 @error('wallet_id') is-invalid @enderror">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach($wallets as $wallet)
                                                            <option value="{{$wallet->id}}" value="{{ request('wallet_id') }}"
                                                            @if( request('wallet_id') == $wallet->id)  selected="selected" @endif>
                                                                {{( isset($wallet->title) ? "{$wallet->title}" : '')}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="description">بابت‌</label>
                                                    <input type="text" class="form-control" id="description" name="description" value="{{ request('description') }}"
                                                           placeholder="بابت‌‌">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-left">جستجو</button>
                                        </form> --}}
                                    @endslot
                                @endcomponent

                                @component('components.table')
                                    @slot('thead')
                                        <tr>
                                            <th>شناسه</th>
                                            <th>کاربر</th>
                                            <th>کیف پول</th>
                                            <th>مبلغ (ریال)</th>
                                            <th>حساب بانکی</th>
                                            <th>تاریخ درخواست</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    @endslot

                                    @slot('tbody')
                                        @forelse( $withdraws as $withdraw )
                                            <tr>
                                                <td>{{ digitsToEastern($withdraw->id) }}</td>
                                                <td>{{ $withdraw->user_wallet->user->display_name }}</td>
                                                <td>{{ $withdraw->user_wallet->wallet->title }}</td>
                                                <td>{{ digitsToEastern( number_format( $withdraw->amount ) ) }}</td>
                                                <td>{{ $withdraw->bank_name }}: {{ $withdraw->iban }}</td>
                                                <td>{{ digitsToEastern( Jalalian::forge( $withdraw->created_at )->format('Y/m/d') ) }}</td>
                                                <td>{{ $withdraw->status_label }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">فعالیت</button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            {{-- <a class="dropdown-item" href="#">مشاهده</a> --}}
                                                            <a class="dropdown-item confirm_complete" href="#" data-id="{{ $withdraw->id }}">تکمیل</a>
                                                            <a class="dropdown-item confirm_cancel" href="#" data-id="{{ $withdraw->id }}">لغو</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">موردی برای نمایش وجود ندارد.</td>
                                            </tr>
                                        @endforelse
                                    @endslot
                                @endcomponent

                                {{ $withdraws->withQueryString()->links('vendor.pagination.bootstrap-4') }}

                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
    @endslot

    @slot('script')
        <script>
            $(".select2:not(.select2-user)").select2({
                theme: "bootstrap"
            });

            $('table').on('click', '.confirm_cancel', function(){
                const id = $(this).data('id');
                Swal.fire({
                    'icon': 'question',
                    'title': 'تایید لغو',
                    'text': 'آیا از لغو این درخواست اطمینان دارید؟',
                    'confirmButtonText': 'تایید و لغو',
                    'showCancelButton': true,
                    'cancelButtonText': 'انصراف'
                }).then(function(response){
                    if( response.isConfirmed ){
                        Swal.fire({
                            title: 'در حال اجرای درخواست ...'
                        });
                        Swal.showLoading();

                        $.ajax({
                            type: 'patch',
                            url: baseUrl + '/panel/wallet/withdraw/' + id + '/ajax_cancel',
                            dataType: 'json',
                            success: function(response){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'درخواست با موفقیت انجام شد.'
                                }).then(function(){
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });

            $('table').on('click', '.confirm_complete', function(){
                const id = $(this).data('id');
                Swal.fire({
                    'icon': 'question',
                    'title': 'تایید لغو',
                    'text': 'آیا از تکمیل این درخواست اطمینان دارید؟',
                    'confirmButtonText': 'تایید و تکمیل',
                    'showCancelButton': true,
                    'cancelButtonText': 'انصراف'
                }).then(function(response){
                    if( response.isConfirmed ){
                        Swal.fire({
                            title: 'در حال اجرای درخواست ...'
                        });
                        Swal.showLoading();

                        $.ajax({
                            type: 'patch',
                            url: baseUrl + '/panel/wallet/withdraw/' + id + '/ajax_complete',
                            dataType: 'json',
                            success: function(response){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'درخواست با موفقیت انجام شد.'
                                }).then(function(){
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });

            $(".select2-user").select2({
                theme: "bootstrap",
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route("user.search_ajax") }}',
                    dataType: 'json'
                }
            });
        </script>
    @endslot
@endcomponent
