@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1 class="text-center">商品情報編集</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品情報を編集する</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="product_number">商品番号:</label>
                            <input type="text" name="product_number" id="product_number" value="{{ old('product_number', $item->product_number) }}" class="form-control form-control-sm" required>
                            @error('product_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" class="form-control form-control-sm" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="size">サイズ</label>
                            <input type="text" class="form-control form-control-sm" id="size" name="size" value="{{ old('size', $item->size) }}">
                            @error('size')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                        <label for="category">カテゴリ</label>
                        <input type="text" id="category" name="category" value="{{ old('category', $item->category) }}" class="form-control form-control-sm">                      
                            @error('category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">タイプ</label>
                            <select name="type" id="type" class="form-control form-control-sm">
                                <option value="レディース" {{ old('type', $item->type) == 'レディース' ? 'selected' : '' }}>レディース</option>
                                <option value="メンズ" {{ old('type', $item->type) == 'メンズ' ? 'selected' : '' }}>メンズ</option>
                                <option value="指定なし" {{ old('type', $item->type) == '指定なし' ? 'selected' : '' }}>指定なし</option>
                           </select>
                           @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sale_start_date">販売開始日:</label>
                            <input type="date" name="sale_start_date" id="sale_start_date" value="{{ old('sale_start_date', $item->sale_start_date) }}" class="form-control form-control-sm">
                            @error('sale_start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="price">価格:</label>
                            <input type="number" name="price" id="price" step="1" value="{{ old('price', $item->price) }}" class="form-control form-control-sm" required>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control form-control-sm" id="detail" name="detail">{{ old('detail', $item->detail) }}</textarea>
                            <small id="detailCount" class="form-text text-muted">残り文字数: 255</small> <!-- 文字数表示 -->
                            @error('detail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">更新する</button>
                        <a href="{{ route('items.index') }}" class="btn btn-secondary">戻る</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
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
@stop
