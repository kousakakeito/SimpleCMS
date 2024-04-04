<div class="notice-container">
 <i class="fa-solid fa-xmark"></i>
  <button id="notice-btn">お知らせ作成</button>
  <form class="search-form" action="/notices/search" method="post">
    <input type="text" id="search" name="search" placeholder="検索...">
    <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
  <div class="notice-content">
  @if($notices->isNotEmpty())
   <ul>
     @foreach($notices as $notice)
     <li class="notice-item">
       <span class="notice-name">{{ $notice->title }}</span>
       <div class="notice-buttons">
       <button class="notice-editbtn">編集</button>
       <button class="notice-deletebtn">削除</button>
       </div>
     </li>
     @endforeach
   </ul>
  @else
   <p>お知らせが登録されていません。</p>
  @endif
  </div>
</div>
<div class="delete-modal"></div>