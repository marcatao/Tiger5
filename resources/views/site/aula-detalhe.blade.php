@extends('site.layouts.site')
@section('content')

<body>
<br><br>



@isset($aula)
 @if($aula)    

    <div class="about">
		<div class="container about_container">
			<div class="row">
				<div class="col-lg-6">
					<div class="about_content">
						<div class="section_title_container">
							<div class="section_subtitle">Aula de:</div>
							<div class="section_title"><span>{!!$aula->titulo!!}</span></div>
						</div>
						<div class="about_text">
							{!!$aula->texto!!}
						</div>
					 
					</div>
				</div>
			</div>
		</div>
		<div class="about_background">
			<div class="container fill_height">
				<div class="row fill_height">
					<div class="col-lg-6 offset-lg-6 fill_height">
						
					</div>
				</div>
			</div>
		</div>
    </div>

@endif
@endisset

    
@endsection