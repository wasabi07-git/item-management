@extends('adminlte::page')

@section('title', '更新履歴')

@section('content_header')
    <h1>{{ $item->name }} の更新履歴</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">更新履歴</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ユーザー名</th>
                        <th>更新日</th>
                        <th>更新内容</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td>{{ $history->user->name }}</td>  <!-- ユーザー名 -->
                            <td>{{ $history->created_at }}</td>  <!-- 更新日 -->
                            <td>{{ $history->changes }}</td>     <!-- 更新内容 -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
