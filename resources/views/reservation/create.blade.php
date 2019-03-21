@extends('reservation.main')

@section('main-content')
<div class="container">
    <div class="panel panel-success">
      <div class="panel-heading">
      	Create New Reservation
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
	 	 <form action="{{ route('reservation.store') }}" method="post" enctype="multipart/form-data">
	 	 	{{ csrf_field() }}
			  <div class="container">
			    <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Product</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="product_id" required>
                          @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
         <div class="form-group">
            <label for="title">Reserved Quantity<span class="required">*</span></label>
            <input type="text" class="form-control" placeholder="Quantity" required name="reserved_quantity">
         </div>
			  
              <br>
			  <button type="submit" class="btn btn-primary">Add</button>
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