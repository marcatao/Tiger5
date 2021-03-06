
@extends('site.layouts.site')
@section('content')


	<!-- Home -->

	<div class="home">
		<div class="background_image" style="background-image:url({{asset('site/images/banner/banner2.jpg')}})"></div>
		<div class="overlay"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content text-center">

							<div class="home_title">Tiger Thai</div>
							<div class="home_subtitles mt-3">
								@foreach ($aulas as $aula)
                             	   <l class="mr-1">{{$aula->desc}}</l>,    
                           		 @endforeach
							 e muito mais<br>
							 	<div class="row mt-2">
									<div class="col-md-4">  
									<a href="https://www.instagram.com/tigerthaibr" class="rede-social mr-2">
										 <i class="fa fa-instagram" ></i> tigerthaibr 
									</a>
									</div>
									<div class="col-md-4"> 
									<a href="https://www.facebook.com/tigerthaibrasil" class="rede-social mr-2">
										<i class="fa fa-facebook" ></i> tigerthaibrasil 
									</a>
									</div>
									<div class="col-md-4"> 
						  			<a href="https://www.google.com/search?sxsrf=ALeKk02jP_zmyZaL624-yioTidacGh67PA%3A1599344518449&source=hp&ei=hg9UX9__GMnW5OUP5uqKoAE&q=tigerthai&oq=tigerthai&gs_lcp=CgZwc3ktYWIQAzIQCC4QxwEQrwEQChDLARCTAjIECAAQCjIECAAQCjIECAAQCjIKCC4QxwEQrwEQCjIKCC4QxwEQrwEQCjIKCC4QxwEQrwEQCjIECAAQCjIECAAQCjIECAAQCjoECCMQJzoFCAAQkQI6AggAOgIILjoHCAAQRhD5AToHCAAQChDLAToHCC4QChDLAToECC4QCjoICC4QxwEQowI6BQguEJMCOgUIABDLAToFCC4QywE6CAguEMsBEJMCUO8NWLg8YMtAaAVwAHgAgAG2AYgB6Q2SAQQxLjEzmAEAoAEBqgEHZ3dzLXdpeg&sclient=psy-ab&ved=0ahUKEwjf2pLPhtPrAhVJK7kGHWa1AhQQ4dUDCAc&uact=5" class="rede-social">
									  <i class="fa fa-google" ></i> tigerthai
									 </a>
									</div>
								</div>
							</div>
							<!--<div class="button home_button ml-auto mr-auto"><a href="{{ route('contato') }}?assunto=Matricule-se">Matricule-se</a></div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Boxes -->

	<div class="boxes">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="boxes_container d-flex flex-lg-row flex-column align-items-start justify-content-start">
						
						<!-- Box -->
						@foreach ($unidades as $unidade)
							
						
						<div class="box">
							<div class="d-flex flex-column align-items-center justify-content-center">
                            </div>
							<div class="box_title">{{$unidade->titulo}}</div>
							<div class="box_text">
								<p>{{$unidade->sub_titulo}}<br>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{$unidade->end1}}<br>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{$unidade->end2}}<br>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{$unidade->end3}}<br>
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>  {{$unidade->whats}}<br>
                                    <i class="fa fa-male" aria-hidden="true"></i> {{$unidade->responsavel}}<br>
									<a href="https://www.instagram.com/{{str_replace('@','',$unidade->insta)}}/" target="_blank">
										<i class="fa fa-instagram" aria-hidden="true"></i> {{$unidade->insta}}
									</a>	
                                </p>
							</div>
				
						</div>
						@endforeach
						<!-- Box -->
		 

			 

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- About -->

	<div class="about">
		<div class="container about_container">
			<div class="row">
				<div class="col-lg-6">
					<div class="about_content">
						<div class="section_title_container">
							<div class="section_subtitle">Um pouco sobre:</div>
							<div class="section_title">A <span>TIGER THAI</span></div>
						</div>
						<div class="text_highlight">Desde 2009 impactando resultados no grande ABCD.</div>
						<div class="about_text">
							<p>Centro de Treinamento Tiger Thai possui a melhor estrutura do ABCD, são 2 andares com mais de 600 metros quadrados com o melhor das Artes Marciais entre outras modalidades. 1º andar sendo Recepção, Sala de Espera, Secretária, Tiger Shop, Espaço Zen e Banheiro, 2º andar sendo Sala de Treinamento Marcial com Área de Saco de Pancada, Tatame, Ringue para Combate ou Treinamento Especifico e Um Estúdio de Treinamento Funcional, Calistenia, Lê Parkour e Pilates Solo e Acessórios.
                            
							</p>
						</div>
						<div class="button about_button mb-5 text-center">
							<a href="{{ route('contato') }}?assunto=Aula Experimental">Fazer uma aula</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="about_background d-none d-sm-block">
			<div class="container fill_height">
				<div class="row fill_height">
					<div class="col-lg-6 offset-lg-6 fill_height">
						<div class="about_image mb-3"><img src="{{asset('site/images/sobrenos/bg2.jpg')}}" alt=""></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Testimonials -->

	<div class="testimonials">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{asset('site/images/depoimentos/bg1.jpg')}}" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section_title_container">
						<div class="section_subtitle">Bem vindo a Tiger Thai</div>
						<div class="section_title">Depoimentos</div>
					</div>

					<!-- Testimonial -->
					<div class="test test_1 d-flex flex-row align-items-start justify-content-start">
						<div><div class="test_image"><img src="{{asset('site/images/depoimentos/1.png')}}" alt=""></div></div>
						<div class="test_content">
							<div class="test_name"><a href="#">Gilberto Lisboa Alves Junior</a></div>
							<div class="test_title">Aluno</div>
							<div class="test_text">
								<p>Para quem procura um lugar onde possa se exercitar, ficar em forma e treinar, um esporte de alta performance. Academia Tiger Thai–BRASIL é o lugar onde aprendi arte marcial, dentro de varias modalidades que academia possui, minha grande paixão, é o Muay Thai esporte que agregou muitos benefícios a minha vida principalmente a saúde, as amizades o carinho e respeito de todos, uma grande família.
                                   Agradeço ao Mestre Lael por todos os ensinamentos.</p>
							</div>
							<div class="rating rating_4 test_rating"><i></i><i></i><i></i><i></i><i></i></div>
						</div>
                    </div>
                    
                    <div class="test test_1 d-flex flex-row align-items-start justify-content-start">
						<div><div class="test_image"><img src="{{asset('site/images/depoimentos/4.png')}}" alt=""></div></div>
						<div class="test_content">
							<div class="test_name"><a href="#">Catia Lee</a></div>
							<div class="test_title">Aluno</div>
							<div class="test_text">
								<p>Comecei a treinar na Academia Tiger Thai – BRASIL em 2010 e por vir de outra Arte Marcial, o Kung fu, era muito criteriosa para escolher uma outra academia ou Arte Marcial. Em meses, a rotina de treinos me trouxe a certeza do lugar certo: disciplina e ambiente! Não sou atleta e nem pretendo ser, trabalho com algo fora dessa área, e esse respeito pelo meu limite, meu objetivo, minha busca, eu tive na Academia Tiger Thai – BRASIL.</p>
							</div>
							<div class="rating rating_4 test_rating"><i></i><i></i><i></i><i></i><i></i></div>
						</div>
                    </div>
                    

				</div>
				<div class="col-lg-6">
					
					<!-- Testimonial -->
					<div class="test d-flex flex-row align-items-start justify-content-start">
						<div><div class="test_image"><img src="{{asset('site/images/depoimentos/2.png')}}" alt=""></div></div>
						<div class="test_content">
							<div class="test_name"><a href="#">Ricardo Naoki Nakada Apolinário</a></div>
							<div class="test_title">Aluno</div>
							<div class="test_text">
								<p>A academia Tiger Thai não é simplesmente uma academia. É uma escola, onde aprendemos a lidar com nosso corpo e nossa mente; é nossa segunda casa, com uma família que está sempre pronta para nos ajudar.</p>
							</div>
							<div class="rating rating_5 test_rating"><i></i><i></i><i></i><i></i><i></i></div>
						</div>
					</div>

					<!-- Testimonial -->
					<div class="test d-flex flex-row align-items-start justify-content-start">
						<div><div class="test_image"><img src="{{asset('site/images/depoimentos/3.png')}}" alt=""></div></div>
						<div class="test_content">
							<div class="test_name"><a href="#">Fernanda Pessolato</a></div>
							<div class="test_title">Massagista</div>
							<div class="test_text">
								<p>Uma Academia com uma SUPER INFRAESTRUTURA, com Profissionais altamente qualificados. Somos muito bem tratados, com muita atenção e equidade. O Professor Lael é disciplinado e correto, sempre se atualizando e fazendo novos cursos. Cada aula é diferente uma da outra e com varias técnicas especificas para cada dia de treino e sempre procura observar os alunos para ver se os mesmos estão aplicando os golpes e fazendo os exercícios de forma correta caso algo esteja errado ele orienta e corrige. Super indico esta Academia que também é extensão de nossa Casa.</p>
							</div>
							<div class="rating rating_5 test_rating"><i></i><i></i><i></i><i></i><i></i></div>
						</div>
					</div>
					<div class="test d-flex flex-row align-items-start justify-content-start">
						<div><div class="test_image"><img src="{{asset('site/images/depoimentos/5.png')}}" alt=""></div></div>
						<div class="test_content">
							<div class="test_name"><a href="#">Erick Placides</a></div>
							<div class="test_title">Aluno</div>
							<div class="test_text">
								<p>Eu já havia treinado em outras academias e modalidades, mas foi na Tiger Thai que encontrei mas do que uma academia, são uma família, quero parabenizar todos envolvidos por esse excelente trabalho.</p>
							</div>
							<div class="rating rating_5 test_rating"><i></i><i></i><i></i><i></i><i></i></div>
						</div>
                    </div>
                    

				</div>
			</div>
			<div class="row test_button_row">
				<div class="col text-center">
					<div class="button test_button"><a href="#">Junte-se a nós</a></div>
				</div>
			</div>
		</div>
	</div>

	<!-- Gallery -->

@isset($midias)
@if($midias)
	<div class="gallery">
		
		<!-- Gallery Slider -->
		<div class="gallery_slider_container">
			<div class="owl-carousel owl-theme gallery_slider">
				@foreach ($midias as $midia)
			
				 @if($midia->gettypeName())
				 @if($midia->gettypeName()<>'GraphVideo')
	               <div class="owl-item">
					 <img src="{{$midia->getthumbnails()[4]->src}}" class="img-fluid" alt="">
				   </div>
				  @endif
				@endif
		
			    @endforeach


			</div>
		</div>

	</div>
@endif
@endisset



@include('site.vitrine.produtos')


	<div class="services">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container">
						<div class="section_subtitle">Conheça</div>
						<div class="section_title">Nossa estrutura</div>
					</div>
				</div>
			</div>
			<div class="row services_row">
				
				<!-- Service -->
				<div class="col-xl-4 col-md-6 service_col">
					<div class="service">
						<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
							<div><div class="service_icon"><img src="site/images/icon_10.png" alt=""></div></div>
							<div class="service_title">Centro de Treinamento</div>
						</div>
						<div class="service_text">
							<p>São 2 andares com mais de 600 metros quadrados com o melhor das artes marciais entre outras modalidades.</p>
						</div>
					</div>
				</div>

				<!-- Service -->
				<div class="col-xl-4 col-md-6 service_col">
					<div class="service">
						<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
							<div><div class="service_icon"><img src="site/images/icon_13.png" alt=""></div></div>
							<div class="service_title">Estúdio de Treinamento</div>
						</div>
						<div class="service_text">
							<p>Estúdio de Treinamento Funcional, Calistenia, Lê Parkour e Pilates solo e acessorios.</p>
						</div>
					</div>
				</div>

 

				<!-- Service -->
				<div class="col-xl-4 col-md-6 service_col">
					<div class="service">
						<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
							<div><div class="service_icon"><img src="site/images/icon_8.png" alt=""></div></div>
							<div class="service_title">Aréas comuns </div>
						</div>
						<div class="service_text">
							<p>Secretaria , Salas de esperas,mesa para reuniões e loja de artigos esportivos.</p>
						</div>
					</div>
				</div>

				<!-- Service -->
				<div class="col-xl-4 col-md-6 service_col">
					<div class="service">
						<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
							<div><div class="service_icon"><img src="site/images/icon_5.png" alt=""></div></div>
							<div class="service_title">Espaço Zen</div>
						</div>
						<div class="service_text">
							<p>Os benefícios da massagem, além do relaxamento do corpo e da sensação de bem-estar.</p>
						</div>
					</div>
				</div>

				<!-- Service -->
				<div class="col-xl-4 col-md-6 service_col">
					<div class="service">
						<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
							<div><div class="service_icon"><img src="site/images/icon_11.png" alt=""></div></div>
							<div class="service_title">Sala de treinamento Marcial</div>
						</div>
						<div class="service_text">
							<p>área de Saco de Pancada, Tatame e Ringue para combate ou treinamento especifico.</p>
						</div>
					</div>
				</div>

			</div>
		</div>
<br>
		<div class="gallery_slider_container">
			<div class="owl-carousel owl-theme gallery_slider">
			 @for ($i = 1; $i < 30; $i++)
				 <div class="owl-item">
					 <img src="{{ asset('site/images/estrutura/'.$i.'.jpg') }}" class="img-fluid" alt="">
				 </div>
			@endfor	
		 </div>
		 


	</div>


	

@endsection
