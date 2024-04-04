<div class="contact-form-container">
    <form class="contact-form">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">名前:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">メールアドレス:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="subject" class="form-label">件名:</label>
            <input type="text" id="subject" name="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="message" class="form-label">本文:</label>
            <textarea id="message" name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn-submit">送信確認</button>
    </form>
</div>