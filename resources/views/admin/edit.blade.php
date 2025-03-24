@extends('layouts.app')

@section('content')
<div class="container">
    <h1>管理者情報を編集</h1>

    <form action="{{ route('admin.update', $admin->id) }}" method="POST" class="col-md-7">
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
    </form>
</div>
@endsection
