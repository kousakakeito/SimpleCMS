<div class="cate-container">
 <i class="fa-solid fa-xmark"></i>
  <button id="category-btn">カテゴリ作成</button>
  @if($categories->isNotEmpty())
  <button class="cate-changebtn">並び替え</button>
  @endif
  <div class="cate-content">
  @if($categories->isNotEmpty())
      <ul>
        @foreach($categories as $category)
        <li class="category-item">
         <span class="category-name">{{ $category->name }}</span>
         <div class="category-buttons">
          <button class="cate-editbtn">編集</button>
          <button class="cate-deletebtn">削除</button>
         </div>
        </li>
        @endforeach
      </ul>
    @else
      <p>カテゴリが登録されていません。</p>
    @endif
  </div>
</div>
<div class="delete-modal"></div>
