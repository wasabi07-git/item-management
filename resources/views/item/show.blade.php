@extends('adminlte::page')

@section('title', '商品詳細')

@section('content_header')
    <h1>商品詳細</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品情報</h3>
                </div>
                <div class="card-body">
                    <!-- 商品詳細情報の表示 -->
                    <div class="form-group">
                        <label for="product_id">商品番号</label>
                        <p id="product_id">{{ $item->product_number }}</p>
                    </div>

                    <div class="form-group">
                        <label for="product_name">商品名</label>
                        <p id="product_name">{{ $item->name }}</p>
                    </div>

                    <div class="form-group">
                        <label for="sale_start_date">販売開始日</label>
                        <p id="sale_start_date">{{ $item->sale_start_date }}</p>
                    </div>

                    <div class="form-group">
                        <label for="price">価格</label>
                        <p id="price">{{ number_format($item->price) }} 円</p>
                    </div>

                    <div class="form-group">
                        <label for="size">サイズ</label>
                        <p id="size">{{ $item->size }}</p>
                    </div>

                    <div class="form-group">
                        <label for="category">カテゴリ</label>
                        <p id="category">{{ $item->category }}</p>
                    </div>

                    <div class="form-group">
                        <label for="type">タイプ</label>
                        <p id="type">{{ $item->type }}</p>
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <p id="detail">{{ $item->detail }}</p>
                    </div>

                    <!-- 編集ボタン -->
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">編集</a>

                    <!-- 戻るボタン -->
                    <a href="{{ route('items.index') }}" class="btn btn-secondary">戻る</a>
                </div>
            </div>
        </div>    
        <!-- 更新履歴セクション -->
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">更新履歴</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>更新日</th>
                                <th>更新内容</th>
                                <th>更新者</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histories as $history)
                                <tr>
                                    <td>{{ $history->created_at }}</td>
                                    <td>{{ $history->changes }}</td>
                                    <td>{{ $history->user->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop