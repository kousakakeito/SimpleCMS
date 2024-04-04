<div id="deleteModal" class="delete-container">
    <div class="delete-modal-content">
        <i class="fa-solid fa-xmark modal-xmark"></i>
        <p>本当に削除しますか？</p>
        <form action="/contact-delete" method="POST">
            @csrf
            <input type="hidden" name="name" value="{{ $name }}">
            <input type="hidden" name="subject" value="{{ $subject }}">
            <button type="submit" class="submit-btn">削除する</button>
        </form>
    </div>
</div>