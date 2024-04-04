<div class="all-list">All 一覧</div>
@foreach ($notices as $notice)
        <div class="notice-item" data-id="{{ $notice->id }}">
            <div class="notice-date">{{ date('Y-m-d', strtotime($notice->post_date)) }}</div>
            <div class="notice-category">{{ $notice->category->name }}</div>
            <div class="notice-description">{{ $notice->category->description }}</div>
            <div class="notice-title">{{ $notice->title }}</div>
            @if ($notice->image_path)
                <img src="{{ Storage::url($notice->image_path) }}" alt="{{ $notice->title }}">
            @else
                <img src="{{ asset('images/noimage.png') }}" alt="No Image"> 
            @endif
            <div class="notice-content">{{ Str::limit(strip_tags($notice->content), 100, '...') }}</div>
        </div>
@endforeach
@if ($moreExists)
    <div class="notice-more" data-page="{{ $currentPage + 1 }}">次のページを表示</div>
@endif
@if ($previousExists)
    <div class="notice-previous" data-page="{{ $currentPage - 1 }}">前のページに戻る</div>
@endif