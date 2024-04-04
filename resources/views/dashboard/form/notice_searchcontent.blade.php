<i class="fa-solid fa-xmark fa-xmark2"></i>
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
   <p>該当する検索結果はありませんでした。</p>
  @endif