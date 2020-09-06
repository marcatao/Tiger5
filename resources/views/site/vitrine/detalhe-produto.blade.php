@extends('site.layouts.site')
@section('content')

<body>



    <div class="services">
        <div class="container">

            <div class="row mt-5">
                    <div class="col-md-5">
                        <div class="row">
                            @php
                                $cont = 1;
                                $fotos = App\vitrine_img::where('vitrine_id',$produto->id)->get();
                            @endphp
                                @foreach ($fotos as $foto)
                                    @if($cont == 1)
                                             <img src="{{asset($foto->src)}}" id="foto-principal" class="img-fluid foto-produto" alt="">
                                     @endif
                                    <img 
                                        src="{{asset($foto->src)}}"  
                                        class="img-fluid foto-produto" 
                                        width="120px" 
                                        alt=""
                                        onclick="changeFoto(this.src)">    
                                @php $cont++; @endphp
                                @endforeach

                        </div>
                    </div>
                    <div class="col-md-7 lado-descricao">
                        <div class="row">
                            <div class="mt-5">
                                <div class="section_subtitle">Produto</div>
                                <div class="section_title">{{$produto->produto}}</div>
                            </div>
                        </div>

                        <div class="descricao-produto mt-5">
                            {!! $produto->descritivo !!}
                            <h4 class="mt-3">
                                @if($produto->exibe_valor == 1)
                                    <p class="v-preco">R$ {{ number_format($produto->valor,2,',','.')}}</p> 
                                @else
                                    <p>Valores sob consulta</p>                                 
                                @endif
                            </h4>
                        </div>

                        <div class="button about_button"><a href="{{route('contato')}}?assunto=Produtos da vitrine&mensagem=Gostaria de informações sobre o produto: {{$produto->produto}}.">Consultar</a></div>


                    </div>    
                
            </div>
        </div>
    </div>



    @include('site.vitrine.produtos')
@endsection

@section('scripts')
<script>
    function changeFoto(src){
        $('#foto-principal').attr('src',src).fadeIn(2000);
    }

</script>
@endsection