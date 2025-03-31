@extends('adminlte::page')

@section('title', '商品情報一括登録')

@section('content_header')
    <h1 class="text-center">商品情報一括登録</h1>
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

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card card-primary">
                <form action="{{ route('items.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="csv_file">CSVファイル</label>
                            <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <!-- アップロードボタン -->
                        <button type="submit" class="btn btn-primary">アップロード</button>
                        <!-- テンプレートボタン -->
                        <a href="{{ asset('downloads/items_template.xlsx') }}" class="btn btn-secondary ml-3" download>
                            Excelフォーマット
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
