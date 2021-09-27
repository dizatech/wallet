@component('home.layouts.component', ['title' => 'درخواست برداشت وجه از کیف پول'])

    @slot('style')
    @endslot

    @slot('content_top')
    @endslot

    @slot('content')
        <div class="container-fluid account-user">
            <div class="row">
                <div class="col-lg-3">
                    @component('components.account.right-side-menu-account')
                    @endcomponent
                </div>
                <div class="col-lg-9">
                    <div class="content-section">
                        <div class="contest-account-table">
                            <div class="alert alert-secondary">
                                <div class="d-flex justify-content-between">
                                    <div>کیف پول: <strong>{{ $user_wallet->wallet->title }}</strong></div>
                                    <div>موجودی: {{ JUtils::convertNumbers(number_format($user_wallet->balance / 10)) }}
                                        تومان</div>
                                    <div>حداقل برداشت:
                                        {{ JUtils::convertNumbers(number_format(Setting::get('wallet_min_withdraw_amount') / 10)) }}
                                        تومان</div>
                                </div>
                            </div>
                            @if ($user_wallet->balance == 0 || $user_wallet->balance < Setting::get('wallet_min_withdraw_amount'))
                                <div class="alert alert-danger">
                                    <p class="mb-0">موجودی شما قابل برداشت نیست.</p>
                                </div>
                            @else
                                <form action="" method="post">
                                    @csrf

                                    <h6 class="text-primary">درخواست برداشت وجه</h6>
                                    <div class="row">
                                        <div class="col">
                                            <div class="alert alert-info">
                                                واریز وجه تنها به حسابی انجام می‌شود که نام دارنده آن با مشخصات حساب کاربری درخواست
                                                کننده تطابق داشته باشد.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span class="text-danger">*</span>
                                                    <label for="amount">مبلغ برداشت (تومان)</label>
                                                    <input type="text" name="amount" id="amount"
                                                        class="form-control ltr number_format @error('amount') is-invalid @enderror"
                                                        value="{{ old('amount') }}">

                                                    @error('amount')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span class="text-danger">*</span>
                                                    <label for="bank_name">نام بانک</label>
                                                    <input type="text" name="bank_name" id="bank_name"
                                                        class="form-control @error('bank_name') is-invalid @enderror"
                                                        value="{{ old('bank_name') }}">

                                                    @error('bank_name')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <span class="text-danger">*</span>
                                                    <label for="iban">شماره شبا</label>
                                                    <div class="input-group ltr">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">IR</div>
                                                        </div>
                                                        <input type="text" name="iban" id="iban"
                                                            class="form-control @error('iban') is-invalid @enderror"
                                                            value="{{ old('iban') }}">
                                                    </div>

                                                    @error('iban')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="description">توضیحات (اختیاری)</label>
                                                    <textarea name="description" id="description"
                                                        class="form-control @error('description') is-invalid @enderror"
                                                        >{{ old('description') }}</textarea>

                                                    @error('description')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <button class="btn btn-primary" type="submit">تایید و ثبت درخواست</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            @endif

                            <div class="payment_table mt-4">
                                <div class="table-responsive">
                                    {{-- <table class="table table-sm table-bordered table-hover table-striped">
                                        <thead class="bg-secondary text-light">
                                        <tr class="border-bottom ">
                                            <th class="text-center" colspan="6">تراکنش‌های شما</th>
                                        </tr>
                                        <tr>
                                            <th>شناسه تراکنش</th>
                                            <th>تاریخ تراکنش</th>
                                            <th>بدهکار</th>
                                            <th>بستانکار</th>
                                            <th>توضیحات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($transactions as $transaction)
                                            <tr>
                                                <td>{{ digitsToEastern($transaction->id) }}</td>
                                                <td>{{ digitsToEastern(jdate($transaction->created_at)->format('H:i:s - Y/m/d')) }}</td>
                                                <td>{{ digitsToEastern(number_format($transaction->CreditorLabel)) }}</td>
                                                <td>{{ digitsToEastern(number_format($transaction->DebtorLabel)) }}</td>
                                                <td>{{ $transaction->description }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">موردی برای نمایش وجود ندارد.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endslot

    @slot('script')
    @endslot

@endcomponent
