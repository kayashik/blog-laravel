@extends('main')

@section('title', '| All Categories')

@section('content')
 
 	<div class="row">
 		<div class="col-md-8">
 			<h1>Categories</h1>
 			<table class="table">
 				<thead>
 					<tr>
 						<th>#</th>
 						<th>Name</th>
 						<th></th>
 					</tr>
 				</thead>

 				<tbody>
 				@foreach ($categories as $category)
 					<tr>
 						<th>{{ $category->id }}</th>
 						<td>{{ $category->name }}</td>
 						<td>{!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) !!}
 						{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
						{!! Form::close() !!}</td>
 					</tr>
 				@endforeach
 				</tbody>
 			</table>
 		</div> <!-- end col-md-8 -->

 		<div class="col-md-3">
 			<div class="well">
 				{!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
	 				<h2>New Category</h2>
	 				{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}

					{{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}

 			</div>
 		</div>
 	</div>

@endsection