@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1 class="text-center">商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <!-- レフトナビ（左側メニュー） -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">絞り込み</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.index') }}" method="GET">
                    <!-- 商品名の検索フォーム -->
                    <div class="form-group">
                            <label for="search">商品名</label>
                            <input type="text" name="search" class="form-control" placeholder="商品名で検索" value="{{ request('search') }}">
                        </div>    
                    <!-- カテゴリの絞り込み -->
                        <div class="form-group">
                            <label for="category">カテゴリ</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">カテゴリで絞り込み</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- タイプの絞り込み -->
                        <div class="form-group">
                            <label for="type">タイプ</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">タイプで絞り込み</option>
                                @foreach($types as $type)
                                <option value="{{ $type->type }}" {{ request('type') == $type->type ? 'selected' : '' }}>
                                    {{ $type->type }}
                                </option>
                                @endforeach
                            </select>
                        </div>
 
                        <!-- 価格の絞り込み -->
                         <div class="form-group">
                            <label for="price_range">価格範囲</label>
                            <div class="input-group">
                                <input type="number" name="min_price" class="form-control" value="{{ request('min_price')}}" placeholder="最小価格">
                                <span class="input-group-text">〜</span>
                                <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="最大価格">
                            </div>
                         </div>

                        <button type="submit" class="btn btn-primary btn-block mt-3">検索</button>
                        
                        <!-- クリアボタン -->
                        <a href="{{ route('items.index') }}" class="btn btn-secondary btn-block mt-2">リセット</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- 商品一覧表示エリア -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <!-- 商品番号の検索フォーム -->
                        <form action="{{ route('items.index') }}" method="GET" class="mt-3">
                            <div class="input-group input-group-sm">
                                <input type="text" name="product_number" class="form-control" placeholder="商品番号で検索" value="{{ request('product_number') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">検索</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <form action="{{ route('items.bulkDelete') }}" method="POST" id="bulkDeleteForm">
                        @csrf
                        @method('DELETE')
                        <!-- 一括削除ボタンの表示領域 -->
                        <div class="form-group mb-3" id="bulkDeleteContainer" style="display: none;">
                            <span id="selectedCount"></span>
                            <button type="submit" class="btn btn-default btn-sm" id="bulkDeleteButton" disabled>一括削除</button>
                        </div>
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"> 全選択</th>
                                    <th>商品番号</th>
                                    <th>商品名</th>
                                    <th>販売開始日</th>
                                    <th>価格</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td><input type="checkbox" name="selected_ids[]" value="{{ $item->id }}" class="itemCheckbox"></td>
                                        <td>
                                            @if (is_numeric($item->product_number))
                                                {{ number_format($item->product_number) }}
                                            @else
                                                {{ $item->product_number }}
                                            @endif
                                        </td>
                                        <td><a href="{{ route('items.show', $item->id) }}">
                                            @if (is_string($item->name))
                                                {{ $item->name }}
                                            @else
                                                {{ '未設定' }}
                                            @endif
                                        </a></td>
                                        <td>
                                            @if ($item->sale_start_date && strtotime($item->sale_start_date))
                                                {{ \Carbon\Carbon::parse($item->sale_start_date)->format('Y-m-d') }}
                                            @else
                                                {{ '未設定' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (is_numeric($item->price))
                                                {{ number_format($item->price) }} 円
                                            @else
                                                {{ $item->price }} 円
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>

                    <!-- ページネーション情報を下部に追加 -->
                    <div class="d-flex justify-content-between mt-3">
                        <!-- 表示件数 -->
                        <span>表示件数: {{ $items->count() }} </span>
                        <!-- ページネーション -->
                        <div class="text-center w-50">
                            {{ $items->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
<script>
    // 全選択/解除ボタンの処理
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.itemCheckbox');
        const isChecked = this.checked;
        checkboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateSelectedCount();
        toggleBulkDeleteButton();
    });

    // 個別のチェックボックスが変更されたとき
    document.querySelectorAll('.itemCheckbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectedCount();
            toggleBulkDeleteButton();
        });
    });

    // 選択されたチェックボックスの数を更新
    function updateSelectedCount() {
        const selectedItems = document.querySelectorAll('.itemCheckbox:checked');
        const selectedCount = selectedItems.length;
        document.getElementById('selectedCount').textContent = `${selectedCount} 件を選択中`;
    }

    // 一括削除ボタンの状態を切り替える
    function toggleBulkDeleteButton() {
        const checkedItems = document.querySelectorAll('.itemCheckbox:checked');
        const bulkDeleteButton = document.getElementById('bulkDeleteButton');
        const bulkDeleteContainer = document.getElementById('bulkDeleteContainer');
        
        // チェックが1つでもあれば表示、なければ非表示
        if (checkedItems.length > 0) {
            bulkDeleteContainer.style.display = 'block';
            bulkDeleteButton.disabled = false;
        } else {
            bulkDeleteContainer.style.display = 'none';
            bulkDeleteButton.disabled = true;
        }
    }
</script>
@stop
