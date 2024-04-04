<div id="deleteModal" class="delete-container">
    <div class="delete-modal-content">
        <i class="fa-solid fa-xmark modal-xmark"></i>
        <p>"{{ $name }}"を本当に削除しますか？</p>
        <form action="/cate-delete" method="POST">
            @csrf
            <input type="hidden" name="name" value="{{ $name }}">
            <button type="submit" class="submit-btn">削除する</button>
        </form>
    </div>
</div>