<form action="/cate-update" method="POST" class="cate-container">
<i class="fa-solid fa-xmark"></i>
    @csrf
    <input type="hidden" name="category_id" value="{{ $category->id }}">
    <label for="name">カテゴリ名：</label>
    <input type="text" id="name" name="name" value="{{ $category->name }}" required class="category-input">
    <label for="description">説明：</label>
    <textarea id="description" name="description" required class="category-textarea">{{ $category->description }}</textarea>
    <button type="submit" class="submit-btn">更新</button>
</form>

