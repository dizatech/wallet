@component('home.layouts.component', ['title' => 'صفحه حساب کاربری (لیست کیف پول)'])

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
                            <div class="alert alert-success ">
                                <span>
                                   <p class="mb-0">مقدار موجود در کیف پول {{$user_wallet->wallet->title}} {{number_format($user_wallet->balance / 10)  }} تومان می باشد.</p>
                                </span>
                            </div>
                            <div class="payment_table mt-4">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-hover table-striped">
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
                                                <td>{{ digitsToEastern(number_format($transaction->CreditorLabel / 10)) }}</td>
                                                <td>{{ digitsToEastern(number_format($transaction->DebtorLabel / 10)) }}</td>
                                                <td>{{ $transaction->description }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">موردی برای نمایش وجود ندارد.</td>
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
        </div>
    @endslot

    @slot('script')
    @endslot

@endcomponent

