@extends('layouts.base')
@section('content')
<title>Category</title>
<!-- Main Content -->
<section class="content" style="margin-left: 2%; margin-right: 1%">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>{{auth()->user()->first_name}}  {{auth()->user()->last_name}}</h2>
                    @if (auth()->user()->is_role==1)
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('category')}}"> Category</a>
                        </li>
                    </ul>
                    @endif
                    {{-- <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button> --}}

                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <form action="{{ asset('logout') }}" method="POST">
                        @csrf
                        @method('post')
                        <button class="btn btn-primary btn-icon float-right " type="submit"><i
                                class="zmdi zmdi-power"></i></button>
                    </form>
                </div>
            </div>
        </div>

    </div>


                <div class="body">
                    <a href="{{ route('category.create') }}" class="btn btn-raised btn-primary btn-round waves-effect"
                        style="color: white">Create</a>
                        <form action="{{route('category')}}" style="display:inline-block; width: 20%;">
                            <div style="display: flex; justify-content: space-between">
                                @csrf
                                <input type="search" class="form-control" style="height: 1%; width: 60%;" name="search"  value="{{isset($search) ? $search : old('search')}}">
                                <button class="btn btn-raised btn-primary btn-round waves-effect" style="margin: 0" type="submit">Search</button>
                            </div>
                        </form>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $key=>$item)
                                    <tr align="center">
                                        <th>{{ ++$key}}</th>
                                        <td>{{ $item->name}}</td>
                                        <td style="width: 240px; display: flex; justify-content: space-between">
                                            <a href="{{route('category.edit',['id'=>$item->id])}}" class="btn btn-raised btn-success ">Update</a>
                                            <form action="{{route('category.delete',['id'=>$item->id])}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-raised btn-danger" type="submit">Delete</button>
                                            </form>
                                            @if ($item->file)

                                            <a class="btn btn-raised btn-warning  btn-icon float-right"
                                            href="{{ route('home.dowload',['id'=>$item->id]) }}"><span class="ti-import"></span></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

@endsection
