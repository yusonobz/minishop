@extends('products.main')

@section('main-content')
<div class="container">
    <div class="panel panel-success">
      <div class="panel-heading">
      	Create New Product
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
	 	 <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
	 	 	{{ csrf_field() }}
	 	 	{{ method_field('PATCH') }}
			  <div class="container">
			  	<div class="form-group">
				    <label for="title">Product Name</label>
				    <input type="text" class="form-control" placeholder="Product Name" required name="product" value="{{ $product->product_name }}">
				 </div>
         <div class="form-group">
            <label for="title">Quantity</label>
            <input type="text" class="form-control" placeholder="Quantity" required name="quantity" value="{{ $product->quantity }}">
         </div>
			  
                 <div class="form-group">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="photo" accept=".png, .jpg, .jpeg"> 
                            <label class="custom-file-label" for="inputGroupFile02">Product Photo</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="preview">Product Photo Preview</label>
                    <img src="{{ asset('/images/') }}/{{ $product->photo }}" id="preview" class="mx-auto d-block" width="50px" height="50px" />
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Category</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="category" >
                          @foreach($categories as $category)
                            <option value="{{ $category->id }}" <?php if($category->id == $product->category_id) echo 'selected'?> 
                            >{{ $category->category_name }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
              <br>
			  <button type="submit" class="btn btn-primary">Update</button>
			  <a href="{{ route('product.index') }}" class="btn btn-danger">Back</a>
			</form> 
   	  </div>
    </div>
</div>
@endsection



@section('extra-scripts')
<script>

function readURL(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#preview').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}

$("#inputGroupFile02").change(function() {
readURL(this);
});

</script>
@endsection