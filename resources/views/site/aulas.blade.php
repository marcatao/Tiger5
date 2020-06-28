
@extends('site.layouts.site')



@section('estilos')
<link rel="stylesheet" type="text/css" href="{{asset('site/styles/services.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('site/styles/services_responsive.css')}}">
@endsection

@section('content')



	<!-- Home -->

	<div class="home">
		<div class="background_image" style="background-image:url({{asset('site/images/services.jpg')}})"></div>
		<div class="overlay"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">Aulas</div>
							<div class="home_subtitle">
                                @foreach ($aulas as $aula)
                                    {{$aula->desc}} , 
                                @endforeach
                                e muito mais
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Services -->

	<div class="services">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container">
						<div class="section_subtitle">Bem vindo a Tiger Thai</div>
						<div class="section_title">Nossas Aulas</div>
					</div>
				</div>
			</div>
			<div class="row services_row">
                
                @foreach ($aulas as $aula)
                    
   
				<!-- Service -->
				<div class="col-xl-4 col-md-6 service_col">
					<div class="service">
						<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
							<div><div class="service_icon"><img src="images/icon_4.png" alt=""></div></div>
							<div class="service_title">  {{$aula->desc}}</div>
						</div>
						<div class="service_text">
							<p> {{$aula->resumo}}</p>
						</div>
					</div>
				</div>

                @endforeach


			</div>
		</div>
	</div>




<!-- Timetable -->

<div class="timetable">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{asset('site/images/timetable.jpg')}}" data-speed="0.8"></div>
    <div class="tt_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container">
                    <div class="section_subtitle">Fique de olho em</div>
                    <div class="section_title">Grade de aulas</div>
                </div>
                <div class="timetable_filtering">
                    <ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">
                        <li class="active item_filter_btn" data-filter="*">Todos</li>
                        @foreach ($aulas as $aula)
                             <li class="item_filter_btn" data-filter=".{{  str_replace(' ', '',$aula->desc) }}">{{  str_replace(' ', '',$aula->desc) }}</li>
                        @endforeach

                    </ul>
                </div>
                <div class="timetable_container d-flex flex-sm-row flex-column align-items-start justify-content-sm-between justify-content-start">

                    <!-- Monday -->
                    <div class="tt_day">
                        <div class="tt_title">Segunda</div>
                        <div class="tt_day_content grid">
                        @foreach ($segunda as $s)
                            <!-- Class -->
                            <div class="tt_class grid-item {{  str_replace(' ', '',$s->aula->desc) }}">
                                <div class="tt_class_title">{{$s->aula->desc}}</div>
                                <div class="tt_class_instructor">{{$s->professor->user->name}}</div>
                                <div class="tt_class_time">{{$s->hora_ini}}</div>
                            </div>
                        @endforeach                            
                        </div>
                    </div>

                    <!-- Tuesday -->
                    <div class="tt_day">
                        <div class="tt_title">Terça</div>
                        <div class="tt_day_content grid">
                        @foreach ($terca as $s)
                            <!-- Class -->
                            <div class="tt_class grid-item {{  str_replace(' ', '',$s->aula->desc) }}">
                                <div class="tt_class_title">{{$s->aula->desc}}</div>
                                <div class="tt_class_instructor">{{$s->professor->user->name}}</div>
                                <div class="tt_class_time">{{$s->hora_ini}}</div>
                            </div>
                        @endforeach                            
                        </div>
                    </div>

                    <!-- Wednesday -->
                    <div class="tt_day">
                        <div class="tt_title">Quarta</div>
                        <div class="tt_day_content grid">
                        @foreach ($quarta as $s)
                            <!-- Class -->
                            <div class="tt_class grid-item {{  str_replace(' ', '',$s->aula->desc) }}">
                                <div class="tt_class_title">{{$s->aula->desc}}</div>
                                <div class="tt_class_instructor">{{$s->professor->user->name}}</div>
                                <div class="tt_class_time">{{$s->hora_ini}}</div>
                            </div>
                        @endforeach                            
                        </div>
                    </div>

                    <!-- Thursday -->
                    <div class="tt_day">
                        <div class="tt_title">Quinta</div>
                        <div class="tt_day_content grid">
                        @foreach ($quinta as $s)
                            <!-- Class -->
                            <div class="tt_class grid-item {{  str_replace(' ', '',$s->aula->desc) }}">
                                <div class="tt_class_title">{{$s->aula->desc}}</div>
                                <div class="tt_class_instructor">{{$s->professor->user->name}}</div>
                                <div class="tt_class_time">{{$s->hora_ini}}</div>
                            </div>
                        @endforeach                            
                        </div>
                    </div>

                    <!-- Friday -->
                    <div class="tt_day">
                        <div class="tt_title">Sexta</div>
                        <div class="tt_day_content grid">
                        @foreach ($sexta as $s)
                            <!-- Class -->
                            <div class="tt_class grid-item {{  str_replace(' ', '',$s->aula->desc) }}">
                                <div class="tt_class_title">{{$s->aula->desc}}</div>
                                <div class="tt_class_instructor">{{$s->professor->user->name}}</div>
                                <div class="tt_class_time">{{$s->hora_ini}}</div>
                            </div>
                        @endforeach                            
                        </div>
                    </div>

                    <!-- Saturday -->
                    <div class="tt_day">
                        <div class="tt_title">Sabado</div>
                        <div class="tt_day_content grid">
                        @foreach ($sabado as $s)
                            <!-- Class -->
                            <div class="tt_class grid-item {{  str_replace(' ', '',$s->aula->desc) }}">
                                <div class="tt_class_title">{{$s->aula->desc}}</div>
                                <div class="tt_class_instructor">{{$s->professor->user->name}}</div>
                                <div class="tt_class_time">{{$s->hora_ini}}</div>
                            </div>
                        @endforeach                            
                        </div>
                    </div>

                    <!-- Sunday -->
                    <div class="tt_day">
                        <div class="tt_title">Domingo</div>
                        <div class="tt_day_content grid">
                        @foreach ($domingo as $s)
                            <!-- Class -->
                            <div class="tt_class grid-item {{  str_replace(' ', '',$s->aula->desc) }}">
                                <div class="tt_class_title">{{$s->aula->desc}}</div>
                                <div class="tt_class_instructor">{{$s->professor->user->name}}</div>
                                <div class="tt_class_time">{{$s->hora_ini}}</div>
                            </div>
                        @endforeach                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Extra -->    

	

@endsection


@section('scripts')
<script src="{{asset('site/plugins/Isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('site/js/services.js')}}"></script>

@endsection