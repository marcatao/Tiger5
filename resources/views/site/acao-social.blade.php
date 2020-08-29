@extends('site.layouts.site')
@section('content')

<body>

	<div class="about mt-5">
		<div class="container about_container">
			<div class="row">
			@foreach (App\parcerias::all() as $p)
				<div class="col-md-6 mt-3 parcerias_item">
					<div class="row">
					<div class="section_title_container col-md-6">
						<div class="section_subtitle">{{$p->sub_titulo}}:</div>
						<div class="section_title"><span>{{$p->titulo}}</span></div>
					</div>
					<div class="col-md-6">
						<img src="{{$p->img_capa}}" class="img-fluid" />
					</div>
					<div class="about_text">
						{!! $p->texto !!}
					</div>
					</div>
				</div>
			@endforeach
		</div>
		</div>
	</div>







    
@endsection