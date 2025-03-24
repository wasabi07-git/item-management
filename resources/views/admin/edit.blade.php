@extends('adminlte::page')

@section('title', '管理者情報編集')

@section('content_header')
    <h1 class="text-center">管理者情報を編集</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">管理者情報を編集する</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" id="name" name="name" class="form-control form-control-sm" value="{{ old('name', $admin->name) }}" required>
                            @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" id="email" name="email" class="form-control form-control-sm" value="{{ old('email', $admin->email) }}" required>
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">更新</button>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">戻る</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
