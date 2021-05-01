@component('home.layouts.component', ['title' => 'کیف پول'])

    @slot('style')
    @endslot

    @slot('content_top')
        @component('home.layouts.breadcrumb')
        @endcomponent
    @endslot

    @slot('content')
        <div class="container-fluid">
            <!--page title-->
            <div class="row shadow">
                <div class="col-12 pt-3 pb-3 pb-1 page-title">
                    <div class="d-flex justify-content-between">
                        <h1 class="d-inline text-secondary font-weight-bold">
                            کیف پول
                        </h1>
                    </div>
                </div>
            </div>
            <!--End of header-->

            <!--main-->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="page-content">
                        <div class="main-text">
                            <div class="row">
                                <div class="col">
                                    <div class="w-100 p-0 m-0 user_account_page">
                                        <div class="row mb-4">
                                            @component('home.account.layouts.account_links')
                                            @endcomponent
                                            <div class="col-lg-9 col-md-8 col-sm-12 col-12">
                                                @component('home.account.layouts.page_btns')
                                                @endcomponent
                                                <hr class="mt-3 mb-4">
                                                <div class="message green">
                                                    <p>مقدار موجود در کیف پول شما {{number_format($user_wallet->balance)  }} تومان می باشد.</p>
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
                                                            @foreach($transactions as $transaction)
                                                                <tr>
                                                                    <td>{{ digitsToEastern($transaction->id) }}</td>
                                                                    <td>{{ digitsToEastern(jdate($transaction->created_at)->format('H:i:s - Y/m/d')) }}</td>
                                                                    <td>{{ digitsToEastern(number_format($transaction->CreditorLabel)) }}</td>
                                                                    <td>{{ digitsToEastern(number_format($transaction->DebtorLabel)) }}</td>
                                                                    <td>{{ $transaction->description }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of main page-->
        </div>
    @endslot

    @slot('script')
    @endslot

@endcomponent
