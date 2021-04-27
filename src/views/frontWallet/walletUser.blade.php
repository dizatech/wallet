@component('home.layouts.component', ['title' => 'کیف پول کاربر'])

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
                            کیف پول کاربر
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
                                                    <p>مقدار موجود در کیف پول شما {{number_format($balance)  }} تومان می باشد.</p>
                                                </div>
                                                <div class="payment_table mt-4">
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
                                                                    <th>مشاهده</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($wallets as $wallet)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $wallet->wallet->title }}</td>
                                                                    <td>{{ digitsToEastern(number_format($wallet->balance)) }}</td>
                                                                    <td><a href="{{route('account.wallet', $wallet->id)}}" class="btn btn-sm btn-success" type="submit">مشاهده</a></td>
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
