<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{route('a691jmmk69866ef77e7b8719892ac8d64efde',$usuario->pass)}}"><img class="align-content" src="{{asset('images/iconopg.png')}}" width="120px" height="120px"></a>
            <a class="navbar-brand hidden" href="{{route('a691jmmk69866ef77e7b8719892ac8d64efde',$usuario->pass)}}"><img src="{{asset('images/iconopg.png')}}" alt="Logo"></a>
        </div>


        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    @if($usuario->tipo=='3')
                    <a href="{{route('estado')}}"> <i class="menu-icon fa fa-dashboard"></i>Escritorio</a>
                    @else
                    <a href="{{route('a691jmmk69866ef77e7b8719892ac8d64efde',$usuario->pass)}}"> <i class="menu-icon fa fa-dashboard"></i>Escritorio</a>
                    @endif
                </li>

                <h3 class="menu-title">{{$datos->nombre}}</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Administracion</a>
                    <ul class="sub-menu children dropdown-menu">
                        @if($usuario->tipo=='0')
                        <li><i class="fa fa-id-card-o"></i><a href="{{route('formulario_usuario')}}">Crear Usuario</a></li>
                        <li><i class="fa fa-id-card-o"></i><a href="{{route('formulario_docente')}}">Crear Docente</a></li>
                        @endif
                        @if($usuario->tipo<'3')
                            <li><i class="fa fa-id-badge"></i><a href="{{route('formulario_curso')}}">Crear Cursos</a></li>
                            <li><a href="{{route('formulario_Region')}}"><i class="fa fa-flag-checkered"></i> Crear Regiones</a></li>
                            <li><a href="{{route('listaRegion')}}"><i class="fa fa-tags"></i> Listar Regiones</a></li>
                        @endif
                        @if($usuario->tipo=='3')
                            <li><i class="fa fa-folder-open-o"></i><a href="{{route('estado')}}">Curso Actual</a></li>
                            <li><i class="fa fa-folder-open-o"></i><a href="{{route('listaCursos')}}">Mis Cursos</a></li>
                        @endif
                        @if($usuario->tipo=='4')
                        <li><i class="fa fa-folder-open-o"></i><a href="{{route('listaModulo')}}">Mis Modulos</a></li>
                    @endif
                    </ul>
                </li>
                @if($usuario->tipo<'3')
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Listas</a>
                    <ul class="sub-menu children dropdown-menu">
                        @if($usuario->tipo=='0')
                        <li><i class="fa fa-id-badge"></i><a href="{{route('lista_usuario')}}">Lista de Usuarios</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="{{route('lista_docente')}}">Lista de Docentes</a></li>
                        @endif
                        
                        <li><i class="fa fa-id-badge"></i><a href="{{route('lista_curso')}}">Lista de Cursos</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="{{route('lista_estudiante',0)}}">Lista de Estudiantes</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Reportes</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Pagos realizados</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-calendar"></i><a href="{{route('formulario_por_fechas')}}">Por Fechas</a></li>
                        <li><i class="menu-icon fa fa-cloud-download"></i><a href="{{route('pagos_bob')}}">Todos Los pagos BOB</a></li>
                        <li><i class="menu-icon fa fa-cloud-download"></i><a href="{{route('pagos_usd')}}">Todos Los pagos USD</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-calendar"></i>Historial</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-table"></i><a href="{{route('lista_cursohistorial')}}">Lista de Cursos</a></li>
                    </ul>
                </li>
                @endif
                @if($usuario->tipo=='3')
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-clipboard"></i>Oferta Académica</a>
                    <ul class="sub-menu children dropdown-menu">
                        @foreach($matricula as $value)
                        <li><i class="menu-icon fa fa-folder-open-o"></i><a href="{{route('oferta',$value->id)}}">{{$value->nombre}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endif
                
                
                
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->