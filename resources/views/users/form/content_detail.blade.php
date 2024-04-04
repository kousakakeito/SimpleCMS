<div class="title-detail">
    <div class="sub">投稿日: {{ $currentNotice->post_date->format('Y-m-d') }}</div>
    <div class="sub">カテゴリ: {{ $currentNotice->category->name }}</div>
    <div class="title">{{ $currentNotice->title }}</div>
</div>
<div class="notice-item">
@if ($currentNotice->image_path)
  <img src="{{ Storage::url($currentNotice->image_path) }}" alt="{{ $currentNotice->title }}">
@else
  <img src="{{ asset('images/noimage.png') }}" alt="No Image"> 
@endif
</div>            
<div class="content-item" data-id="{{ $currentNotice->id }}">
    <div class="content">{!! $currentNotice->content !!}</div>
</div>

@if ($previousNotice)
    <div class="detail-previous">前のページ: {{ $previousNotice->title }}</div>
@endif

@if ($nextNotice)
    <div class="detail-more">次のページ: {{ $nextNotice->title }}</div>
@endif