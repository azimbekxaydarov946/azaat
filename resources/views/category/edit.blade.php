@extends('layouts.base')
@section('content')
<title>Category</title>
    <section class="content" style="width: 20%; margin: auto; margin-top: 5%">
        <div class="body">
            <h2 class="card-inside-title">Update</h2>
            <form action="{{ route('category.update',['id'=>$category->id]) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('put')
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title" name="name"  value="{{$category->name}}"/>
                        </div>
                    </div>
                </div>
        </div>
        <button class="btn btn-raised btn-primary btn-round waves-effect" type="submit">Update</button>
        </form>
        <a href="{{ route('category') }}" class="btn btn-raised btn-danger btn-round waves-effect"
            style="color: white">Back</a>
    </section>
@endsection
