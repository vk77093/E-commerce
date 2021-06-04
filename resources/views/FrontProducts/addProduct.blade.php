@extends('layouts.main')
@section('mainContent')
    <div class="conatiner">
        
        <div class="row pt120">
            <div class="ml-2 mr-2 col-sm-8 col-md-8">
               <div class="card">
                   <div class="card-header">
                    <p class="display-3">Add Products</p>
                   </div>
                   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                   @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{session('message')}}
                            </div>
                            @endif
                   <div class="card-body">
<form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
@csrf
<label for="pro_name" class="form-label">Name</label>
<input type="text" class="form-control" name="pro_name" value="{{old('pro_name')}}">
<label for="pro_price" class="form-label">Price</label>
<input type="number" class="form-control" name="pro_price" id="pro_price" value="{{old('pro_price')}}">
<label for="pro_image" class="form-label">Product Image</label>
<input type="file" class="form-control" name="pro_image" id="pro_image">
<label for="pro_description" class="form-label">Description</label>
<textarea class="form-control" name="pro_description" id="pro_description" value="{{old('pro_description')}}"></textarea>
<br>
<button type="submit" class="btn btn-primary">Add IT</button>
</form>
                   </div>
               </div>
            </div>
        </div>
    </div>
    
@endsection