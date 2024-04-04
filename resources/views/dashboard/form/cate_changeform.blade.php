<div id="changeModal" class="change-container">
    <div class="change-modal-content">
        <i class="fa-solid fa-xmark modal-xmark"></i>
        <form action="/cate-change" method="POST">
    @csrf
    <div class="category-list">
        <ul id="sortable">
        @foreach ($categories as $category)
            <li class="ui-state-default" data-id="{{ $category->id }}"><input type="hidden" name="order[]" value="{{ $category->id }}">{{ $category->name }}</li>
        @endforeach
        </ul>
    </div>
    <button type="submit" class="submit-btn">適用</button>
</form>
    </div>
</div>