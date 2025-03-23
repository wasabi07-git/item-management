@extends('layouts.app')

@section('content')
<div class="container">
    <h1>管理者一覧</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">新しい管理者を作成</a>

    <table class="table">
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
                        <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning">編集</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $admin->id }}">削除</button>
                        
                        <!-- 削除モーダル -->
                        <div class="modal fade" id="deleteModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">削除確認</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        本当にこの管理者を削除しますか？
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('admin.destroy', $admin->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                            <button type="submit" class="btn btn-danger">削除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $admins->links() }}
</div>
@endsection
