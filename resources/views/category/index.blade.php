@extends('reservation.main')

@section('main-content')
<div class="container">
     @if(Session::has('message'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
     @endif
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a href="{{ route('reservation.create') }}" class="btn btn-primary btn-sm">Add New</a>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Count</th>
                    <th>Category</th>
                    <th style="width:200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <form  method="post" action="{{ route('category.destroy',$category->id) }}" class="delete_form">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-xs btn-primary">Edit</a>
                                <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Are You Sure? Want to Delete It.');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $reservations->links() }}
        </div>
    </div>
</div>
@endsection