@extends('adminlte::page')

@section('title', '管理者一覧')

@section('content_header')
    <h1 class="text-center">管理者一覧</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">管理者情報</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">新しい管理者を作成</a>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>名前</th>
                                <th>メールアドレス</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-default btn-sm">編集</a>
                                        
                                        <!-- 削除フォーム -->
                                        <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当にこの管理者を削除しますか？');">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- ページネーション -->
                    <div class="d-flex justify-content-center">
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
