@extends('site.layouts.site')
@section('content')

<body>

	<div class="about mt-5">
		<div class="container about_container">
			<div class="row">
			@foreach (App\parcerias::orderBy('id','desc')->get() as $p)
				<div class="col-md-12 mt-3 parcerias_item">
					<div class="row">
					<div class="col-md-8">
						<div class="section_title_container">
							<div class="section_subtitle">{{$p->sub_titulo}}:</div>
							<div class="section_title"><span>{{$p->titulo}}</span></div>
						</div>
						<div class="about_text">
							{!! $p->texto !!}
						</div>
						</div>
					<div class="col-md-4">
						<img src="{{$p->img_capa}}" class="img-fluid" />
					</div>

					</div>
					<div style="border-bottom-style: dotted; margin-top:35px; border-color: coral;"></div>
				</div>
				
			@endforeach
		</div>
		</div>
	</div>







    
@endsection