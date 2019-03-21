@extends('category.main')

@section('main-content')
<div class="container">
    <div class="panel panel-success">
      <div class="panel-heading">
      	Create New Category
      </div>
      <div class="panel-body">
      	@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
	 	 <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
	 	 	{{ csrf_field() }}
			  <div class="container">
			  	<div class="form-group">
				    <label for="title">Category Name<span class="required">*</span></label>
				    <input type="text" class="form-control" placeholder="Category Name" required name="category_name">
				 </div>
              <br>
			  <button type="submit" class="btn btn-primary">Add</button>
			  <a href="{{ route('category.index') }}" class="btn btn-danger">Back</a>
			</form> 
   	  </div>
    </div>
</div>
@endsection

