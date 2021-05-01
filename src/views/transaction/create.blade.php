@component('panel.layouts.component',['title'=>'ثبت تراکنش جدید'])
    @slot('style')
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i>ثبت تراکنش جدید</h1>
        <p> این بخش برای ثبت تراکنش جدید است.</p>
    @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">همه تراکنش‌ها</a></li>
        <li class="breadcrumb-item"> تراکنش جدید</li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'new-transaction', 'show' => 'show','title' => ' تراکنش جدید '])
                            @slot('body')
                                <form action="{{ route('transaction.store') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="name"><strong>نام کاربر</strong></label>
                                                <select name="user_id" id="user_id"
                                                        class="form-control select2 select2-user @error('user_id') is-invalid @enderror">
                                                    @if( old('user_id', request('user_id')) )
                                                        <option value="{{ old('user_id', request('user_id') ) }}" selected="selected">
                                                            {{ \App\Models\User::find( old('user_id', request('user_id')) )->full_name }}
                                                        </option>
                                                    @endif
                                                </select>
                                                @error('user_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="wallet_id">کیف پول</label>
                                                <select name="wallet_id" id="wallet_id"
                                                        class="form-control select2 @error('wallet_id') is-invalid @enderror">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($wallets as $wallet)
                                                        <option value="{{$wallet->id}}"
                                                                @if( old('wallet_id',( isset($wallet->name) ? "{$wallet->name}" : '') ) == $wallet->id)  selected="selected" @endif>
                                                            {{( isset($wallet->title) ? "{$wallet->title}" : '')}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('wallet_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="amount"><strong>مبلغ</strong></label>
                                                <input type="text"
                                                       class="form-control number_format @error('amount') is-invalid @enderror"
                                                       value="{{old('amount')}}" id="amount" name="amount">
                                                @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="status_transaction"><strong>نوع تراکنش</strong></label>
                                                <select name="status_transaction" id="status_transaction"
                                                        class="form-control select2 @error('status_transaction') is-invalid @enderror">
                                                    <option value="">انتخاب کنید</option>
                                                    <option
                                                        value="increase" {{ old('status_transaction') == 'increase' ? 'selected' : '' }}>
                                                        افزایش
                                                    </option>
                                                    <option
                                                        value="dec" {{ old('status_transaction') == 'dec' ? 'selected' : '' }}>
                                                        کاهش اعتبار
                                                    </option>
                                                </select>
                                                @error('status_transaction')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="description"><strong>بابت</strong></label>
                                                <textarea type="text"
                                                          class="form-control @error('description') is-invalid @enderror"
                                                          id="description"
                                                          name="description">{{old('description')}}</textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3">
                                        <button class="btn btn-success" type="submit">ثبت</button>
                                    </div>
                                </form>
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
