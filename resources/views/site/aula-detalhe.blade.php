@extends('site.layouts.site')
@section('content')

<body>
<br><br>



@isset($aula)
 @if($aula)    
<br><br>
	<div class="mt-5 mb-5"><br>

		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="">
						<div class="section_title_container">
							<div class="section_subtitle">Aula de:</div>
							<div class="section_title"><span>{!!$aula->titulo!!}</span></div>
						</div>
						<div class="">
							{!!$aula->texto!!}
						</div>
					 
					</div>
				</div>
			</div>
		</div>

    </div>

@endif
@endisset

    
@endsection