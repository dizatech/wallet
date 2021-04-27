@component('panel.layouts.component',['title'=>'ویرایش کیف پول'])
    @slot('style')
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i>ویرایش کیف پول </h1>
        <p> این بخش برای ویرایش کیف پول است.</p>
    @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('wallet.index') }}">همه کیف پول‌ها</a></li>
        <li class="breadcrumb-item">ویرایش کیف پول </li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'new-wallet', 'show' => 'show','title' => 'ویرایش کیف پول '])
                            @slot('body')
                                <form action="{{ route('wallet.update' , $wallet) }}" method="POST" autocomplete="off">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="name"><strong>نام</strong></label>
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                       type="text" name="name" id="name" value="{{ old('name', $wallet->name)}}" disabled>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="title"><strong>عنوان</strong></label>
                                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title' , $wallet->title) }}">
                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="is_active">وضعیت کیف پول</label>
                                                <select name="is_active" id="is_active"
                                                        class="form-control select2 @error('is_active') is-invalid @enderror">
                                                    <option value="">انتخاب کنید</option>
                                                    <option
                                                        value="1" @if( old('is_active', $wallet->is_active) == '1' ) selected="selected" @endif>
                                                        فعال
                                                    </option>
                                                    <option
                                                        value="0" @if( old('is_active', $wallet->is_active) == '0' ) selected="selected" @endif>
                                                        غیرفعال
                                                    </option>
                                                </select>
                                                @error('is_active')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3">
                                        <button class="btn btn-success" type="submit">ویرایش</button>
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
            $(".select2").select2({
                theme: "bootstrap"
            });
        </script>
    @endslot
@endcomponent
