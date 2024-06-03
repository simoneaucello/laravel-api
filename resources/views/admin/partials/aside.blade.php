<aside class="bg-dark navbar-dark text-white">
    <nav>
        <ul>
            <li>
                <a href="{{ route('admin.home') }}"><i class="fa-solid fa-house"></i>
                    Home</a>
            </li>
            <li>
                <a href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-list-ul"></i>
                    Elenco progetti</a>
            </li>
            <li>
                <a href="{{ route('admin.projects.create') }}"><i class="fa-solid fa-circle-plus"></i>
                    Nuovo progetto</a>
            </li>
            <li>
                <a href="{{ route('admin.technologies.index') }}"><i class="fa-solid fa-list-check"></i>
                    Gestione tecnologie</a>
            </li>
            <li>
                <a href="{{ route('admin.types.index') }}"><i class="fa-solid fa-list-check"></i>
                    Gestione tipologie</a>
            </li>
            <li>
                <a href="{{ route('admin.type_projects') }}"><i class="fa-solid fa-list-check"></i>
                    Tipologie/Progetti</a>
            </li>
        </ul>
    </nav>
</aside>
