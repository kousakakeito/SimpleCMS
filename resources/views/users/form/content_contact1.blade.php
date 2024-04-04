@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<div class="form-data-container">
    <i class="fa-solid fa-xmark close-icon"></i>
    <div class="form-data">
        <p>名前: <span>{{ $validatedData['name'] }}</span></p>
        <p>メールアドレス: <span>{{ $validatedData['email'] }}</span></p>
        <p>件名: <span>{{ $validatedData['subject'] }}</span></p>
        <p>メッセージ: <span>{{ $validatedData['message'] }}</span></p>
    </div>
    <div class="confirmation">
        <p>上記内容で送信しますか？</p>
        <form class="confirmation-form">
            @csrf
            <input type="hidden" name="name" value="{{ $validatedData['name'] }}">
            <input type="hidden" name="email" value="{{ $validatedData['email'] }}">
            <input type="hidden" name="subject" value="{{ $validatedData['subject'] }}">
            <input type="hidden" name="message" value="{{ $validatedData['message'] }}">
            <button type="submit" class="btn-send">送信</button>
        </form>
    </div>
</div>