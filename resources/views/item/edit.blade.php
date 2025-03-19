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
                        </div>

                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name) }}" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group">
                            <label for="size">サイズ</label>
                            <input type="text" class="form-control" id="size" name="size" value="{{ old('size', $item->size) }}">
                        </div>

                        <div class="form-group">
                        <label for="category">カテゴリ</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $item->category) }}" class="form-control form-control-sm">
                        </div>

                        <div class="form-group">
                            <label for="type">タイプ</label>
                            <select name="type" id="type" class="form-control">
                                <option value="レディース" {{ old('type', $item->type) == 'レディース' ? 'selected' : '' }}>レディース</option>
                                <option value="メンズ" {{ old('type', $item->type) == 'メンズ' ? 'selected' : '' }}>メンズ</option>
                                <option value="指定なし" {{ old('type', $item->type) == '指定なし' ? 'selected' : '' }}>指定なし</option>
                           </select>
                        </div>

                        <div class="form-group">
                        <label for="sale_start_date">販売開始日:</label>
                        <input type="date" name="sale_start_date" id="sale_start_date" value="{{ old('sale_start_date', $item->sale_start_date) }}" class="form-control form-control-sm">
                        </div>
                        
                        <div class="form-group">
                        <label for="price">価格:</label>
                        <input type="number" name="price" id="price" step="1000" value="{{ old('price', $item->price) }}" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail">{{ old('detail', $item->detail) }}</textarea>
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
@stop
