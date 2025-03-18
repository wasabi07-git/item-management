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
                            <input type="text" name="product_number" id="product_number" class="form-control form-control-sm">
                        </div>

                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="商品名">
                        </div>

                        <div class="form-group">
                            <label for="size">サイズ</label>
                            <input type="text" class="form-control form-control-sm" id="size" name="size" placeholder="サイズ">
                        </div>

                        <div class="form-group">
                            <label for="category">カテゴリ</label>
                            <input type="text" class="form-control form-control-sm" id="category" name="category" placeholder="カテゴリ">
                        </div>

                        <div class="form-group">
                            <label for="type">タイプ</label>
                            <select id="type" name="type" class="form-control form-control-sm" required>
                                <option value="">選択してください</option>
                                <option value="レディース">レディース</option>
                                <option value="メンズ">メンズ</option>
                                <option value="指定なし">指定なし</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sale_start_date">販売開始日:</label>
                            <input type="date" name="sale_start_date" id="sale_start_date" class="form-control form-control-sm">
                        </div>
                        
                        <div class="form-group">
                            <label for="price">価格:</label>
                            <input type="number" name="price" id="price" class="form-control form-control-sm" step="1000">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control form-control-sm" id="detail" name="detail" placeholder="詳細説明">
                        </div>

                    </div>

                    <div class="card-footer text-cente">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
