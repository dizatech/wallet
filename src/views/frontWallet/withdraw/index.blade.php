@component('home.layouts.component', ['title' => 'درخواست‌های برداشت وجه'])

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
                            @component('components.flash_message_handler')@endcomponent

                            <div class="payment_table mt-4">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-hover table-striped">
                                        <thead class="bg-secondary text-light">
                                        <tr class="border-bottom ">
                                            <th class="text-center" colspan="6">درخواست‌های برداشت وجه</th>
                                        </tr>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>کیف پول</th>
                                            <th>مبلغ (تومان)</th>
                                            <th>تاریخ ثبت</th>
                                            <th>وضعیت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($withdraws as $withdraw)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $withdraw->user_wallet->wallet->title }}</td>
                                                <td>{{ JUtils::convertNumbers( number_format( $withdraw->amount / 10 ) ) }}</td>
                                                <td>{{ JUtils::convertNumbers( Jalalian::forge( $withdraw->created_at )->format('Y/m/d') ) }}</td>
                                                <td>{{ $withdraw->status_label }}</td>
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
