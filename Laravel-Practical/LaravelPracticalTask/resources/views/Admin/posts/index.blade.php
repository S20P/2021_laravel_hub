@extends('layouts.mainlayout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Posts Management</h2>
            </div>
            <div class="pull-right">
                @can('post-create')
                <a class="btn btn-success" href="{{ route('admin.posts.create') }}"> Create New Posts</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered" id="datatablesSimple">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($posts as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
            <td><img src="{{asset('/posts-Images')}}/{{ $product->image }}" width="100px"></td>
	        <td>{{ $product->title }}</td>
	        <td>{{ $product->description }}</td>
	        <td>
                <form action="{{ route('admin.posts.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('admin.posts.show',$product->id) }}">Show</a>
                    @can('post-edit')
                    <a class="btn btn-primary" href="{{ route('admin.posts.edit',$product->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('post-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


<p class="text-center text-primary"><small>Practical by Devloperr</small></p>
@endsection
