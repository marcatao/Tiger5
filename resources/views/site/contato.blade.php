@extends('site.layouts.site')
 

@section('estilos')
<link rel="stylesheet" type="text/css" href="{{ asset('site/styles/contact.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('site/styles/contact_responsive.css')}}">
@endsection

@section('content')


<div class="home">
		<div class="background_image" style="background-image:url({{ asset('site/images/banner/banner2.jpg')}})"></div>
		<div class="overlay"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">Contato</div>
							<div class="home_subtitle">				@foreach ($aulas as $aula)
                                {{$aula->desc}},    
                            @endforeach
                             e muito mais</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->

	<div class="contact">
		<div class="container">
			<div class="row">

				<!-- Contact Content -->
				<div class="col-lg-4">
					<div class="contact_content">
						<div class="contact_logo">
							<div class="logo d-flex flex-row align-items-center justify-content-start"><div>Tiger<span>Thai</span></div></div>
						</div>
						<div class="contact_text">
							<p>Para duvidas, sugestões agendamento de aula experimental utilize nosso formulario para contato.</p>
						</div>
						<div class="contact_list">
							<ul>
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div><i class="fa fa-map-marker" aria-hidden="true"></i></div></div>
									<div>Francisco Alves, 918 <br>01º andar - Pauliceia - SBC</div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div><i class="fa fa-whatsapp" aria-hidden="true"></i></div></div>
									<div>11 96327-2733</div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div><i class="fa fa-envelope" aria-hidden="true"></i></div></div>
									<div>contato@tigerthai.com.br</div>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Contact Form -->
				<div class="col-lg-8 contact_col">
					<div class="contact_title">Mantenha Contato</div>
					<div class="contact_form_container">
						<form action="{{route('contato')}}" id="contact_form" class="contact_form" method="POST">
                            {{  csrf_field() }}
							<div class="row">
								<div class="col-lg-6">
									<div class="input_item">
                                        <input type="text" id="name" name="name" class="contact_input trans_200" placeholder="Nome" required="required">
                                    </div>
								</div>
								<div class="col-lg-6">
									<div class="input_item">
                                        <input type="email"  id="email" name="email" class="contact_input trans_200" placeholder="E-mail" required="required">
                                    </div>
								</div>
								<div class="col-lg-12">
									<div class="input_item">
                                        <select  id="assunto" name="assunto" class="contact_input trans_200" placeholder="Assunto" required="required">
											<option value="contato">Contato</option>
											<option value="Aula Experimental">Aula Experimental</option>
											<option value="Matricule-se">Matricule-se</option>
										</select>		
                                    </div>
								</div>
							</div>
							<div class="input_item">
                                <textarea id="message" name="message" class="contact_input contact_textarea trans_200" placeholder="Messagem" required="required"></textarea>
                                </div>
							<button class="contact_button button">Enviar<span></span></button>
						</form>
					</div>
				</div>

			</div>
			<div class="row google_map_row">
				<div class="col">
					


				</div>
			</div>
		</div>
	</div>



@endsection

@section('scripts')
<script>
$(function () {
	$('#assunto').val(_GET('assunto'));
	
});
function _GET(name)
{
  var url   = window.location.search.replace("?", "");
  var itens = url.split("&");

  for(n in itens)
  {
    if( itens[n].match(name) )
    {
      return decodeURIComponent(itens[n].replace(name+"=", ""));
    }
  }
  return null;
}
</script>
@endsection