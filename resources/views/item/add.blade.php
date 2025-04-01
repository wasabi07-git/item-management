@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1 class="text-center">商品登録</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="{{ route('items.store') }}">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="product_number">商品番号:</label>
                            <input type="text" name="product_number" id="product_number" class="form-control form-control-sm" value="{{ old('product_number') }}">
                            @if($errors->has('product_number'))
                                <div class="text-danger">{{ $errors->first('product_number') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="商品名" value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                       </div>

                        <div class="form-group">
                            <label for="size">サイズ</label>
                            <input type="text" class="form-control form-control-sm" id="size" name="size" placeholder="サイズ" value="{{ old('size') }}">
                            @if($errors->has('size'))
                                <div class="text-danger">{{ $errors->first('size') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="category">カテゴリ</label>
                            <input type="text" class="form-control form-control-sm" id="category" name="category" placeholder="カテゴリ" value="{{ old('category') }}">
                            @if($errors->has('category'))
                                <div class="text-danger">{{ $errors->first('category') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="type">タイプ</label>
                            <select id="type" name="type" class="form-control form-control-sm" required>
                                <option value="">選択してください</option>
                                <option value="レディース" {{ old('type') == 'レディース' ? 'selected' : '' }}>レディース</option>
                                <option value="メンズ" {{ old('type') == 'メンズ' ? 'selected' : '' }}>メンズ</option>
                                <option value="指定なし" {{ old('type') == '指定なし' ? 'selected' : '' }}>指定なし</option>
                            </select>
                            @if($errors->has('type'))
                                <div class="text-danger">{{ $errors->first('type') }}</div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="sale_start_date">販売開始日:</label>
                            <input type="date" name="sale_start_date" id="sale_start_date" class="form-control form-control-sm" value="{{ old('sale_start_date') }}">
                            @if($errors->has('sale_start_date'))
                                <div class="text-danger">{{ $errors->first('sale_start_date') }}</div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="price">価格:</label>
                            <input type="number" name="price" id="price" class="form-control form-control-sm" step="1" value="{{ old('price') }}">
                            @if($errors->has('price'))
                                <div class="text-danger">{{ $errors->first('price') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control form-control-sm" id="detail" name="detail" placeholder="詳細説明" value="{{ old('detail') }}">
                            @if($errors->has('detail'))
                                <div class="text-danger">{{ $errors->first('detail') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // 文字数カウント機能
            document.getElementById('detail').addEventListener('input', function() {
                var maxLength = 255;  // 最大文字数
                var currentLength = this.value.length; // 現在の文字数
                var remainingLength = maxLength - currentLength; // 残り文字数

                // 文字数表示を更新
                document.getElementById('detailCount').textContent = '残り文字数: ' + remainingLength;

                // 文字数が255を超えた場合は警告
                if (remainingLength < 0) {
                    document.getElementById('detailCount').style.color = 'red';
                } else {
                    document.getElementById('detailCount').style.color = 'green';
                }
            });
        </script>
    @endpush
@stop
