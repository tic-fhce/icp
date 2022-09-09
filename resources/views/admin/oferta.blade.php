@extends('front.front_admin')

@section('label1')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

        	@foreach($curso as $value)
				<div class="col-md-4">
                        <section class="card">
                            <div class="twt-feed bg-flat-color-3">
                                <div class="corner-ribon black-ribon">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <div class="fa fa-user-plus wtt-mark"></div>

                                <div class="media">
                                    <a href="#">
                                        <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{asset('storage/'.$datos->foto)}}">
                                    </a>
                                    <div class="media-body">
                                        <h2 class="text-white display-6">{{$value->codigo}}</h2>
                                        <p class="text-light">{{$value->tipo}}</p>
                                    </div>
                                </div>
                            </div>

                            <footer class="twt-footer">
                                {{$value->detalle}}
                            </footer>
                            <a href="{{route('perfil_curso_oferta',$value->id)}}" class="btn btn-outline-danger btn-sm">Detalles </a>
                        </section>
                </div>
            @endforeach
		</div>
	</div>
</div>


@endsection