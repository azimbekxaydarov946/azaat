@extends('layouts.base')
@section('content')
<title>Home</title>
    <section class="content" style="width: 20%; margin: auto; margin-top: 5%">
        <div class="body">
            <h2 class="card-inside-title">Create</h2>
            <form action="{{ route('home.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('post')
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title" name="title" />
                        </div>
                        <div class="form-group">
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <select name="category_id" id="" class="form-control">
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
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
