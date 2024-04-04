<div class="notice-container">
    <i class="fa-solid fa-xmark"></i>
    <form method="post" action="/notice-update" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="notice_id" value="{{ $notice->id }}">
        <div class="notice-group">
            <label for="post-date">投稿日：</label>
            <input type="date" id="post-date" name="post_date" value="{{ $notice->post_date->format('Y-m-d') }}" required>
        </div>
        <div class="notice-group">
            <label for="title">タイトル：</label>
            <input type="text" id="title" name="title" value="{{ $notice->title }}" required>
        </div>
        <div class="notice-group">
            <label>カテゴリ：</label>
            <select name="category" required>
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $notice->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="notice-group">
            <label for="editor">本文：</label>
            <textarea name="content" id="editor" required>{{ $notice->content }}</textarea>
        </div>
        <div class="notice-group">
         <label for="image">イメージ画像：</label>
          @if($notice->image_path)
           <p><img src="{{ Storage::url($notice->image_path) }}" alt="Notice Image" ></p>
          @else
           <p>ファイルが選択されていません。</p>
          @endif
           <input type="file" id="image" name="image">
        </div>
        <div class="notice-group">
            <label>
                <input type="checkbox" name="display_flag" value="1" {{ $notice->display_flag ? 'checked' : '' }}> 非公開として登録
            </label>
        </div>
        <div class="notice-group">
            <button type="submit">更新</button>
        </div>
    </form>
</div>
