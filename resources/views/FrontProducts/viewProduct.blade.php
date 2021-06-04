@extends('layouts.main')
@section('mainContent')
<div class="container">
    <div class="row pt120">
        <div class="col-sm-12 col-md-12">
            @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{session('message')}}
                            </div>
                            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Product price</th>
                        <th>Product description</th>
                        <th>Product Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                      <tr>
                          <td>{{$item->id}}</td> 
                          <td>{{$item->pro_name}}</td>
                          <td>{{$item->pro_price}}</td> 
                          
                          <td>{{Str::substr($item->pro_description,0,25)}}</td>
                          <td>{{$item->pro_image}}</td>
                          <td>
                        <a href="{{route('product.edit', $item->id)}}" class="btn btn-primary">Edit</a>      
                        </td> 
                          <td>
                              <form action="{{route('product.destroy',$item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                          </td>
                    @empty
                     <td>No data Is here</td>   
                    @endforelse
                </tr> 
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection