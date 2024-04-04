<div id="deleteModal" class="delete-container">
    <div class="delete-modal-content">
        <i class="fa-solid fa-xmark modal-xmark"></i>
        @if(isset($contacts))
         <div class="contact-detail-container">
             <div class="contact-email">Email: {{ $contacts->email }}</div>
             <div class="contact-email">名前: {{ $contacts->name }}</div>
             <div class="contact-message">本文: {{ $contacts->message }}</div>
         </div>
        @else
         <p>指定されたお問い合わせが見つかりませんでした。</p>
        @endif
    </div>
</div>