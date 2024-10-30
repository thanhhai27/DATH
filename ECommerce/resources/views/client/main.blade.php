<!DOCTYPE html>
<html lang="en">
<head>
    @include('client.parts.head')
</head>
<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                @include('client/parts/sidebar')
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    @include('client/parts/header')
                </div>
                <div class="admin-content-main">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    <footer>
        @include('client/parts/footer')
    </footer>
</body>
</html>