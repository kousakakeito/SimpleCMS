<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.1/css/all.css">
    <title>{{ $user->name }}</title>
    @include('users.show_styles')
    @yield('users.show_styles')
</head>
<body>
    <header>
        <div class="header-content">
            <h1>CMS</h1>
            <nav class="header-nav">
                <ul>
                    <li class="tab" data-content="list">一覧</li>
                    <li class="tab" data-content="details">詳細</li>
                    <li class="tab" data-content="contact">お問い合わせ</li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="show-content">
    </div>
    @include('users.show_scripts') 
    @yield('users.show_scripts')
</body>
</html>