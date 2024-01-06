<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Buku | @yield('title')</title>
    <!-- Judul halaman default "Rental Buku" jika tidak diubah di view -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

</head>

<body>
    <div class="main d-flex flex-column justify-content-between">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Rental Buku</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar bg-secondary col-lg-2 collapse d-lg-block " id="navbarTogglerDemo02">
                    <ul class="nav">
                        <a href="/dashboard"
                            class="{{ request()->route()->uri == 'dashboard' ? 'active' : '' }}">Dashboard</a>
                        <a href="/books"
                            class="{{ in_array(request()->route()->uri, ['books', 'book-add', 'book-delete/{book_code}', 'book-edit/{book_code}', 'book-deleted']) ? 'active' : '' }}">Books</a>
                        <a href="/categories"
                            class="{{ in_array(request()->route()->uri, ['categories', 'category/add', 'category/delete/{slug}', 'category/edit/{slug}', 'category/deleted']) ? 'active' : '' }}">Categories</a>
                        <a href="/users"
                            class="{{ in_array(request()->route()->uri, ['users', 'registered-users', 'user-detail/{username}', 'user-ban/{username}']) ? 'active' : '' }}">Users</a>
                        <a href="/rent-log" class="{{ request()->route()->uri == 'rent-log' ? 'active' : '' }}">Rent
                            Log</a>
                        <a href="/" class="{{ request()->route()->uri == '/' ? 'active' : '' }}">Book List</a>
                        <a href="/book-rent" class="{{ request()->route()->uri == 'book-rent' ? 'active' : '' }}">Book
                            Rent</a>
                        <a href="/book-return"
                            class="{{ request()->route()->uri == 'book_return' ? 'active' : '' }}">Book Return</a>
                        <a href="/logout">Logout</a>
                    </ul>


                </div>
                <div class="content p-3 col-lg-10 col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>

</html>
