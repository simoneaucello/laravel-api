<header>

    <nav class="navbar bg-dark navbar-dark text-white">
        <div class="container-fluid">
            <div class="d-flex">
                <a href=" {{ route('admin.home') }} " class="navbar-brand">HOME</a>
                <a href=" {{ route('home') }} " target="_blank" class="nav-link pt-2 me-3 btn "><span class="me-1"><i
                            class="fa-solid fa-globe"></i></span>Vai al
                    sito</a>
                <a href=" {{ route('admin.projects.index') }} " target="_blank" class="nav-link pt-2 "><span
                        class="me-1"><i class="fa-regular fa-folder-open"></i></span>I miei
                    progetti</a>
            </div>
            <div class="d-flex align-items-center">
                <form action=" {{ route('admin.projects.index') }} " method="GET" class="d-flex me-3" role="search">
                    <input name="toSearch" class="form-control me-2" type="search" placeholder="Cerca"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Cerca</button>
                </form>
                <p class="pt-3 me-3"> {{ Auth::user()->name }} </p>

                <form action=" {{ route('logout') }} " method="POST"> @csrf
                    <button type="submit" class="btn btn-danger"><i
                            class="fa-solid fa-right-from-bracket"></i></button>
                </form>
            </div>
        </div>
    </nav>

</header>
