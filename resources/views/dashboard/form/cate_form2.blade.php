<form method="POST" action="/categories" class="cate-container">
<i class="fa-solid fa-xmark"></i>
    @csrf
    <label for="name">カテゴリ名：</label>
    <input type="text" id="name" name="name" required class="category-input">

    <label for="description">説明：</label>
    <textarea id="description" name="description" required class="category-textarea"></textarea>

    <button type="submit" class="submit-btn">登録</button>
</form>