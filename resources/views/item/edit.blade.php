@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
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
                        <input type="text" name="product_number" id="product_number" value="{{ old('product_number', $item->product_number) }}"required>
                        </div>

                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="size">サイズ</label>
                            <input type="text" class="form-control" id="size" name="size" value="{{ old('size', $item->size) }}">
                        </div>

                        <div class="form-group">
                        <label for="category">カテゴリ</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $item->category) }}">
                        </div>

                        <div class="form-group">
                            <label for="type">タイプ</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $item->type) }}">
                        </div>

                        <div class="form-group">
                        <label for="sale_start_date">販売開始日:</label>
                        <input type="date" name="sale_start_date" id="sale_start_date" value="{{ old('sale_start_date', $item->sale_start_date) }}">
                        </div>
                        
                        <div class="form-group">
                        <label for="price">価格:</label>
                        <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $item->price) }}"required>
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
