<!DOCTYPE html>
<html>
<!-- lang="{{ str_replace('_', '-', app()->getLocale()) }}" -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="theme-color" content="#6777ef"/>
    <link rel="shortcut icon" href="{{ asset('afrohuila_1.svg') }}">
    
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
  
</head>

<body>
    @inertia
    <script src="{{ asset('sw.js') }}"></script>
    <script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
    </script>   
</body>

</html>
