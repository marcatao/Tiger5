	<!-- Services -->
	@php
	$vitrines = App\vitrine::where('ativo',1)->get();	
	@endphp
	
	@if(count($vitrines) > 0)
		<div class="services">
			<div class="container">
				<div class="row">
				 
						<div class="mt-5">
							<div class="section_subtitle">Conheça</div>
							<div class="section_title">Nossa vitrine</div>
						</div>
				 
				</div>
				<div class="row">
					@foreach ($vitrines as $item)
					<div class="col-md-3 mt-5 text-center">
						<div class="servicos text-center">
							@if ($item->imagens)
								@foreach ($item->imagens as $img)
									<img src="{{asset($img->src)}}" class="img-fluid"/>
									@break
								@endforeach	
							@endif
							<div class="mt-2">
								<h4>{{$item->produto}}</h4>
							</div>
						
						 
								<h4 class="mt-3">
									@if($item->exibe_valor == 1)
										<p>R$ {{ number_format($item->valor,2,',','.')}}</p> 
									@else
										<p>Valores sob consulta</p>                                 
									@endif
                                </h4>
							<div class="button about_button"><a href="{{route('produto_'.$item->id)}}"> Detalhes </a></div>
                                
							
						</div>
					</div>
					@endforeach
				</div>	
				
	
	
			</div>
		</div>
	
	@endif


