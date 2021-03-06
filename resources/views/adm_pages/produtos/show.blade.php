@extends('home')

@section('title', 'Produto')

@section('content')
	
			<div class="col-md-8 offset-md-2">
				<h1 class="text-center black-font">Produto</h3>
				<hr>												
			</div>
			<div class="col-md-8 offset-md-2">
				<div class="card">
					<div class="card-heading">
						<div class="card">
							<div class="container">
								<div class="row">
								    <h3 class="col card-header">Produto: {{ucwords($produto->name)}} </h3><h3 class="text-right col card-header"> Cod: {{$produto->id}}</h3>
							    </div>
						    </div>
						    <div class="card-block">
							   <table class="table mb-0 table-sm text-sm-center">
								  <thead>
								    <tr>
								      @if(isset($produto->marca))	
								      <th class="text-center">Marca</th>
								      @endif 
								      <th class="text-center">Categoria</th>								     
								      @if(isset($produto->valor_venda))
								      	<th class="text-center">Preço Venda</th>
								      @endif
								    </tr>
								  </thead>
								  <tbody>
								    <tr>
								      @if(isset($produto->marca))	
								      <td class="pt-2 pb-2">{{ucwords($produto->marca)}}</td>
								      @endif
								      <td class="pt-2 pb-2">
								     {{ ucwords($produto->categories->categoria) }}
								      	
								      </td>								      
								      @if(isset($produto->valor_venda))
								      	<td class="text-center">R$ {{ number_format($produto->valor_venda, 2) }}</td>
								      @endif
								    </tr>							    								  	
								    @if(isset($produto->descricao))
								    @if(isset($produto->valor_venda))
								    	<tr>
									      <th class="text-center" colspan="3">Descrição</th>
									    </th>
								    	<tr>
									      <td class="text-center pt-2" colspan="3">{{ucfirst($produto->descricao)}}</td>
									    </tr>							    

								    @else
								    	<tr>
									      <th class="text-center" colspan="2">Descrição</th>
									    </th>
									    <tr>
									      <td class="text-center pt-2" colspan="2">{{$produto->descricao}}</td>
									    </tr>							    
								    @endif
								    @endif
								  </tbody>
								</table>
															  
						    </div>
						    <div class="card-footer text-muted">
						    	<div class="row">
						    		<div class="text-center col"><a href="{{ route('produto.edit',$produto->id) }}" class="btn btn-primary btn-block">Editar</a></div>	
									<div class="text-center col">
										{!! Form::open(['route'=>['produto.destroy',$produto->id], 'method'=>'DELETE']) !!}
						    				{{ Form::submit('Deletar',['class'=>'btn btn-danger btn-block']) }}
						    			{!! Form::close() !!}
									</div>
						    	</div>						    	
						    	<div class="row mt-3">
						    		<div class="text-center col"><a href="{{ route('produto.index') }}" class="btn btn-outline-secondary btn-block" ><< Voltar aos produtos</a></div>
						    	</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
		
@endsection