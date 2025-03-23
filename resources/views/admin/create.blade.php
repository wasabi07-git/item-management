@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新しい管理者を作成</h1>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" id="name" name="name" class="form-control form-control-sm" required>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-control form-control-sm" required>
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" class="form-control form-control-sm" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-sm" required>
        </div>

        <button type="submit" class="btn btn-success">作成</button>
    </form>
</div>
@endsection
