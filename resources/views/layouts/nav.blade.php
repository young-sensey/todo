<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href='{{ route("auth-view") }}'>Авторизация</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='{{ route("registration-view") }}'>Регистрация</a>
            </li>
        </ul>
    </div>
</nav>
