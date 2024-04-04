<x-app-layout>
<meta name="csrf-token" content="{{ csrf_token() }}">    
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.1/css/all.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/super-build/ckeditor.js"></script>
@include('dashboard.dashboard_styles')
@yield('dashboard.dashboard_styles')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div id="url-container">
        @if(isset($username))
         <p>{{ $username }}さんのURL：<a href="http://localhost/CMS/{{ $username }}">http://localhost/CMS/{{ $username }}</a></p>
        @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div id="dashboard-container">
    </div>
@include('dashboard.dashboard_scripts')
@yield('dashboard.dashboard_scripts')
</x-app-layout>
