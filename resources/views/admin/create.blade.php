@extends('adminlte::page')

@section('title', '新しい管理者を作成')

@section('content_header')
    <h1 class="text-center">新しい管理者を作成</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">管理者情報を作成する</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" id="name" name="name" class="form-control form-control-sm" required>
                            @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" id="email" name="email" class="form-control form-control-sm" required>
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" id="password" name="password" class="form-control form-control-sm" required>
                            @if ($errors->has('password'))
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">パスワード確認</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-sm" required>
                            @if ($errors->has('password_confirmation'))
                                <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">作成</button>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">戻る</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
