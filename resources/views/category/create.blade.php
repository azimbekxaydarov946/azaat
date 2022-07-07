@extends('layouts.base')
@section('content')
<title>Category</title>
    <section class="content" style="width: 20%; margin: auto; margin-top: 5%">
        <div class="body">
            <h2 class="card-inside-title">Create</h2>
            <form action="{{ route('category.store') }}"  method="post">
                @csrf
                @method('post')
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title" name="name" />
                        </div>

                    </div>
                </div>
        </div>
        <button class="btn btn-raised btn-primary btn-round waves-effect" type="submit">Create</button>
        </form>
        <a href="{{ route('home') }}" class="btn btn-raised btn-danger btn-round waves-effect"
            style="color: white">Back</a>
    </section>
@endsection
