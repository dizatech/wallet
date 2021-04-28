@component('panel.layouts.component', ['title' => 'لیست کیف پول'])

    @slot('style')
        <link rel="stylesheet" href="{{ asset('modules/css/mahamax-order.css') }}">
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i> لیست کیف پول‌ها </h1>
        <p>این بخش برای لیست کیف پول‌ها است.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('wallet.index') }}">همه کیف پول‌ها</a></li>
        <li class="breadcrumb-item">لیست کیف پول‌ها</li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'wallet_list', 'show' => 'show', 'title' => ' لیست کیف پول‌ها '])
                            @slot('body')
                                <div class="mt-4">
                                    <a href={{ route('wallet.create') }} type="button" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> ثبت کیف پول </a>
                                </div>

                                @component('components.table')
                                    @slot('thead')
                                        <tr>
                                            <th>شناسه</th>
                                            <th>نام</th>
                                            <th>عنوان</th>
                                            <th>وضعیت کیف پول</th>
                                            <th>عملیات</th>
                                        </tr>
                                    @endslot

                                    @slot('tbody')
                                        @forelse($wallets as $wallet)
                                            <tr>
                                                <td>{{ $wallet->id }}</td>
                                                <td>{{ $wallet->name }}</td>
                                                <td>{{ $wallet->title }}</td>
                                                <td>{{ $wallet->IsActiveLabel }}</td>
                                                <td><a href="{{route('wallet.edit', $wallet)}}" class="btn btn-sm btn-warning">ویرایش</a></td>
                                            </tr>

                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">موردی برای نمایش وجود ندارد.</td>
                                            </tr>
                                        @endforelse
                                    @endslot
                                @endcomponent

                                {{ $wallets->withQueryString()->links('vendor.pagination.bootstrap-4') }}

                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
    @endslot

    @slot('script')
    @endslot
@endcomponent
