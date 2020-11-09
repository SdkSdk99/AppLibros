<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="main.html"><i class="icon-speedometer"></i> Escritorio</a>
            </li>
            <li class="nav-title">
                Maestras
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> General</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=1" class="nav-item" >
                        <a class="nav-link" href="#"><i class="icon-user"></i> Autores</a>
                    </li>
                    <li @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-cube"></i> Categorias</a>
                    </li>
                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-bookmark"></i> Editoriales</a>
                    </li>
                    <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Idiomas</a>
                    </li>
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-map-pin"></i> Paises</a>
                    </li>
                    <li @click="menu=8" class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-group"></i> Personas</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-cog"></i> Registro</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=6" class="nav-item">
                        <a class="nav-link" href="i#"><i class="	fa fa-book"></i> Libros</a>
                    </li>
                    <li @click="menu=7" class="nav-item">
                        <a class="nav-link" href="i#"><i class="fa fa-mouse-pointer"></i> Solicitud Libro</a>
                    </li>
                </ul>
            </li>                    
            <li class="nav-item">
                <a class="nav-link" href="main.html"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main.html"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>