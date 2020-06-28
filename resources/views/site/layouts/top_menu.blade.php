<body>

    <div class="super_container">
        
        <!-- Header -->
    
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header_content d-flex flex-row align-items-center justify-content-start trans_400">
                            <a href="{{route('index')}}">
                                <div class="logo d-flex flex-row align-items-center justify-content-start">
                                    <img src="{{asset('site/images/logo/logo.png')}}" alt="logo" width="130px" class="mt-5">
                                </div>
                            </a>
                            <nav class="main_nav">
                                <ul class="d-flex flex-row align-items-center justify-content-start">
                                    <li class="active"><a href="{{route('index')}}">Inicio</a></li>
                                    <li><a href="{{route('sobre-nos')}}">Sobre nós</a></li>
                                    <li><a href="{{route('aulas')}}">Aulas</a></li>
                                    <li><a href="{{route('acao-social')}}">Ação Social</a></li>
                                    <li><a href="{{route('contato')}}">Contato</a></li>
                                    <li><a href="{{route('admin_index')}}">Aluno</a></li>
                                </ul>
                            </nav>
                            <div class="phone d-flex flex-row align-items-center justify-content-start ml-auto">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                <div>11 96327-2733</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

<!-- Hamburger -->
	
	<div class="hamburger_bar trans_400 d-flex flex-row align-items-center justify-content-start">
		<div class="hamburger">
			<div class="menu_toggle d-flex flex-row align-items-center justify-content-start">
				<span>menu </span>
				<div class="hamburger_container">
					<div class="menu_hamburger">
						<div class="line_1 hamburger_lines" style="transform: matrix(1, 0, 0, 1, 0, 0);"></div>
						<div class="line_2 hamburger_lines" style="visibility: inherit; opacity: 1;"></div>
						<div class="line_3 hamburger_lines" style="transform: matrix(1, 0, 0, 1, 0, 0);"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Menu -->
    
    
	<div class="menu trans_800">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<ul>
				<li><a href="{{route('index')}}">Inicio</a></li>
				<li><a href="{{route('sobre-nos')}}">Sobre nós</a></li>
				<li><a href="{{route('aulas')}}">Aulas</a></li>
				<li><a href="{{route('acao-social')}}">Ação Social</a></li>
                <li><a href="{{route('contato')}}">Contato</a></li>
                <li><a href="{{route('admin_index')}}">Aluno</a></li>
			</ul>
		</div>
		<div class="menu_phone d-flex flex-row align-items-center justify-content-start">
			<i class="fa fa-whatsapp" aria-hidden="true"></i>
				<span>11 96327-2733</span>
		</div>
	</div>
