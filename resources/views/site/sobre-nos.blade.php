@extends('site.layouts.site')

@section('estilo')
<link rel="stylesheet" type="text/css" href="{{ asset('site/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('site/styles/about_responsive.css')}}">
@endsection

@section('content')


<div class="home">
    <div class="background_image" style="background-image:url({{ asset('site/images/about_page.jpg')}})"></div>
    <div class="overlay"></div>
    <div class="home_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="home_title">Sobre nós</div>
                        <div class="home_subtitle">
                            @foreach ($aulas as $aula)
                                {{$aula->desc}},    
                            @endforeach
                             e muito mais</div>
                    </div>
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
                        <div class="section_subtitle">Um pouco sobe:</div>
                        <div class="section_title">A <span>TIGER THAI</span></div>
                    </div>
                    <div class="text_highlight">Desde 2009 impactando resultados no grande ABCD.</div>
                    <div class="about_text">
                        <p>Centro de Treinamento Tiger Thai possui a melhor estrutura do ABCD,  são 2 andares com mais de 600 metros quadrados com o melhor das artes marciais entre outras modalidades.
                            1º andar sendo Recepção, Estúdio de Treinamento Funcional, Calistenia e Lê Parkour, Sala de Espera, Secretária, Tiger Shop, Espaço Zen e Banheiro, 2º andar Sala de treinamento Marcial com área de Saco de Pancada, Tatame e Ringue para combate ou treinamento especifico e Sala de Cinema.</p>
                    </div>
                    <div class="button about_button"><a href="{{ route('contato') }}">Fazer uma aula</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="about_background">
        <div class="container fill_height">
            <div class="row fill_height">
                <div class="col-lg-6 offset-lg-6 fill_height">
                    <div class="img-fluid"><img src="{{asset('site/images/sobrenos/bg1.jpg')}}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team -->

<div class="team">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('site/images/blog.jpg')}}" data-speed="0.8"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section_title_container">
                    <div class="section_subtitle">Bem vindo a Tiger Thai</div>
                    <div class="section_title">O TIME</div>
                </div>
            </div>
        </div>
        <div class="row team_row">
          @foreach ($professores as $professor)

          <div class="col-lg-4 team_col mb-5 mt-2">
            <div class="team_item">
                <div class="team_image"><img src="{{ asset($professor->foto)}}" alt=""></div>
                <div class="team_panel d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="team_name"><a href="#">{{ $professor->user->ShortName }}</a></div>
                    <div class="team_title">{{$professor->habilidades}}</div>
                </div>
            </div>
        </div>

           @endforeach
        </div>



    </div>
</div>

<!-- Skills -->

<div class="skills">
    <div class="container">
        <div class="row row-lg-eq-height">
            
            <!-- Extra -->
            <div class="col-md-12">
                <div class="extra d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="background_image" style="background-image:url({{ asset('site/images/extra.jpg')}})"></div>
                    <div class="extra_title">1° Aula Grátis</div>
                    <div class="extra_text">
                        <p>Venha realizar nossa aula experimental, conhcer nossa estrutura e professores</p>
                    </div>
                    <div class="button extra_button"><a href="{{ route('contato') }}">Aula experimental</a></div>
                </div>
            </div>

            <!-- Skills -->
        
        </div>
    </div>
</div>



@endsection