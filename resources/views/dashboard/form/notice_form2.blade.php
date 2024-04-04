<div class="notice-container">
<i class="fa-solid fa-xmark"></i>
        <form method="post" action="/notices" enctype="multipart/form-data">
            @csrf
            <div class="notice-group">
                <label for="post-date">投稿日：</label>
                <input type="date" id="post-date" name="post_date" required>
            </div>
            <div class="notice-group">
                <label for="title">タイトル：</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="notice-group">
                <label>カテゴリ：</label>
                <select name="category" required>
                 <option value="">選択してください</option>
                 @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                 @endforeach
                </select>
            </div>
            <div class="notice-group">
                <label for="editor">本文：</label>
                <textarea name="content" id="editor"></textarea>
            </div>
            <div class="notice-group">
                <label for="image">イメージ画像：</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="notice-group">
                <label>
                    <input type="checkbox" name="display_flag" value="1"> 非公開として登録
                </label>
            </div>
            <div class="notice-group">
                <button type="submit">公開</button>
            </div>
        </form>
    </div>
