<div class="contact-cancel"><i class="fa-solid fa-xmark fa-xmark3"></i></div>
<div class="contacts-container">
    @forelse ($contacts as $contact)
        <div class="contact-item">
            <div class="contact-info">
                <span class="contact-date">{{ $contact->created_at->format('Y-m-d H:i') }}</span>
                <span class="contact-name">{{ $contact->name }}</span>
                <span class="contact-subject">{{ $contact->subject }}</span>
            </div>
            <form class="contact-action">
                <button type="submit" class="btn-delete">消去</button>
            </form>
        </div>
    @empty
        <div class="no-contacts">現在お問い合わせはありません</div>
    @endforelse
</div>
<div class="delete-modal"></div>