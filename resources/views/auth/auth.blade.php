<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.1/css/all.css">
 <title>CMS</title>
</head>
<body>
 <div id="form-container">
 </div>
 @include('auth.auth_scripts')
 @yield('auth.auth_scripts')
</body>
</html>
