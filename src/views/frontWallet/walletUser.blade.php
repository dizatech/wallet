@component('home.layouts.component', ['title' => 'صفحه حساب کاربری (جزییات کیف پول)'])

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
                            <div class="alert alert-success">
                                <span>
                                    <p class="mb-0">مقدار موجود در کیف پول شما {{number_format($balance / 10)  }} تومان می باشد.</p>
                                </span>
                            </div>
                            <div class="payment_table mt-4">
                                <a href="{{ route('account.wallet.withdraw.index') }}" class="btn btn-primary mb-3">درخواست‌های برداشت وجه</a>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-hover table-striped">
                                        <thead class="bg-secondary text-light">
                                        <tr class="border-bottom ">
                                            <th class="text-center" colspan="6">کیف پول‌های شما</th>
                                        </tr>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>عنوان</th>
                                            <th>مانده</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($wallets as $wallet)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $wallet->wallet->title }}</td>
                                                <td>{{ digitsToEastern(number_format($wallet->balance / 10)) }}</td>
                                                <td>
                                                    <a href="{{route('account.wallet', $wallet->id)}}" class="btn btn-sm btn-success" type="submit">مشاهده</a>
                                                    @if( $wallet->balance >= Setting::get('wallet_min_withdraw_amount', 0) )
                                                        <a href="{{route('account.wallet.withdraw.create', $wallet->id)}}" class="btn btn-sm btn-primary" type="submit">برداشت وجه</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">موردی برای نمایش وجود ندارد.</td>
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

