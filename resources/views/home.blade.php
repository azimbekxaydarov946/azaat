@extends('layouts.base')
@section('content')
    <title>Home</title>
    <!-- Main Content -->
    <section class="content" style="margin-left: 2%; margin-right: 1%">
        <div class="">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
                        @if (auth()->user()->is_role == 1)
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i> Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('category')}}"> Category</a>
                                </li>
                            </ul>
                        @endif

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
     <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2">
                    <div class="body">
                        <h6>Total document</h6>
                        <h2>{{ $total }}</h2>
                        <div class="progress">
                            <div class="progress-bar l-amber" role="progressbar" aria-valuenow="{{ $total }}"
                                aria-valuemin="0" aria-valuemax="100" style="width: {{ $total }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 ">
                    <div class="body">
                        <h6>Start document</h6>
                        <h2>{{ $start }}</h2>
                        <div class="progress">
                            <div class="progress-bar l-blue" role="progressbar" aria-valuenow="{{ $start }}"
                                aria-valuemin="0" aria-valuemax="100" style="width: {{ $start }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 ">
                    <div class="body">
                        <h6>Process document</h6>
                        <h2>{{ $process }}</h2>
                        <div class="progress">
                            <div class="progress-bar l-purple" role="progressbar" aria-valuenow="{{ $process }}"
                                aria-valuemin="0" aria-valuemax="100" style="width: {{ $process }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 ">
                    <div class="body">
                        <h6>Finish document</h6>
                        <h2>{{ $finish }}</h2>
                        <div class="progress">
                            <div class="progress-bar l-green" role="progressbar" aria-valuenow="{{ $finish }}"
                                aria-valuemin="0" aria-valuemax="100" style="width: {{ $finish }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <div class="row clearfix" style="margin-left: 1%;margin-top: -4%">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                </div>
                <div class="body">
                    @if (auth()->user()->is_role==false)
                    <a href="{{ route('home.create') }}" class="btn btn-raised btn-primary btn-round waves-effect"
                    style="color: white">Create</a>
                    @endif
                    <form action="{{ route('home') }}" style="display:inline-block; width: 30%;  {{(auth()->user()->is_role==true)? 'margin-left: 0%; margin-bottom: 0.4%;' : 'margin-left: 1%' }} ">
                        <div style="display: flex; justify-content: space-between">
                            @csrf
                            <select  class="form-control" style="height: 1%; width: 40%;" name="sort">
                                <option value=""></option>
                                @foreach ($category as $item)

                                <option value="{{$item->id}}" @selected($item->id==$sort)>{{$item->name}}</option>

                                @endforeach
                            </select>
                            <select  class="form-control" style="height: 1%; width: 40%;" name="condition">
                                <option value="" ></option>
                                <option value="1" {{($condition==1?"selected":"")}}>Start</option>
                                <option value="2" {{($condition==2?"selected":"")}}>Process</option>
                                <option value="3" {{($condition==3?"selected":"")}}>Finish</option>
                            </select>
                           {{--  <input type="search" class="form-control" style="height: 1%; width: 60%;" name="search"
                                value="{{ isset($search) ? $search : old('search') }}"> --}}
                            <button class="btn btn-raised btn-primary btn-round waves-effect" style="margin: 0"
                                type="submit">Search</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Tite</th>
                                    <th>Date</th>
                                    <th>File Size</th>
                                    <th>File Type</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($home as $key => $item)
                                @if ($item->status > 1 && auth()->user()->is_role==true)

                                    <tr align="center">
                                        <th>{{ ++$key }}</th>
                                        <td>{{ $item->user->last_name }} {{ $item->user->first_name }}</td>
                                        <td>{{ $item->title ?? 'no title' }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->size ?? '0' }} KB</td>
                                        <td>{{ $item->type ?? 'no file' }}</td>
                                        <td>{{ $item->category->name ?? '' }}</td>
                                        <td>
                                            <div class="badge badge-@php if($item->status == 1){
                                                echo('primary');} else if($item->status==2){ echo('warning');} else if($item->status==4){ echo('danger');} else{ echo('success');};
                                                @endphp badge-shadow" >@php if($item->status == 1){
                                                echo('Start');} else if($item->status==2){ echo('Process');}  else if($item->status==4){ echo('Canceled');}else{ echo('Finish');};
                                                @endphp</div>
                                        </td>
                                        <td style="width: 240px; display: flex; justify-content: space-between">
                                            @if ( $item->status<2)
                                            <a href="{{ route('home.edit', ['id' => $item->id]) }}"
                                                class="btn btn-raised btn-success ">Update</a>
                                                @endif
                                                @if ($item->status<3 && auth()->user()->is_role==false)

                                                <form action="{{ route('home.delete', ['id' => $item->id]) }}" method="POST"
                                                    style="{{ $item->file ? '' : 'margin-right: 23%' }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-raised btn-danger" type="submit">Delete</button>
                                                </form>

                                                @endif
                                                @if ($item->file && $item->status==2)
                                                    <a class="btn btn-raised btn-warning  btn-icon float-right"
                                                        href="{{ route('home.dowload', ['id' => $item->id]) }}"><span
                                                            class="ti-import"></span></a>
                                                @endif
                                                @if($item->status==2)
                                                <a href="{{ route('home.canceled', ['id' => $item->id]) }}"
                                                    class="btn btn-raised btn-{{($item->status==2)? 'secondary':'info'}}"
                                                    style="{{ $item->status ? '' : 'margin-left: -22%' }}">Canceled</a>
                                                    @endif
                                                <a href="{{ route('home.status', ['id' => $item->id]) }}"
                                                    class="btn btn-raised btn-{{($item->status==2)? 'info':'secondary'}}"
                                                    style="{{ $item->status ? '' : 'margin-left: -22%' }}">{{($item->status==2)? 'Accepted':'Back'}}</a>

                                        </td>
                                    </tr>
                                    @elseif(auth()->user()->is_role==false)
                                    <tr align="center">
                                        <th>{{ ++$key }}</th>
                                        <td>{{ $item->user->last_name }} {{ $item->user->first_name }}</td>
                                        <td>{{ $item->title ?? 'no title' }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->size ?? '0' }} KB</td>
                                        <td>{{ $item->type ?? 'no file' }}</td>
                                        <td>{{ $item->category->name ?? '' }}</td>
                                        <td>
                                            <div class="badge badge-@php if($item->status == 1){
                                                echo('primary');} else if($item->status==2){ echo('warning');} else if($item->status==4){ echo('danger');} else{ echo('success');};
                                                @endphp badge-shadow" >@php if($item->status == 1){
                                                echo('Start');} else if($item->status==2){ echo('Process');}  else if($item->status==4){ echo('Canceled');}else{ echo('Finish');};
                                                @endphp</div>
                                        </td>
                                        <td style="width: 240px; display: flex; justify-content: space-between">
                                            @if ( $item->status<2)
                                            <a href="{{ route('home.edit', ['id' => $item->id]) }}"
                                                class="btn btn-raised btn-success ">Update</a>
                                                @endif
                                                @if ($item->status<3 && auth()->user()->is_role==false)

                                                <form action="{{ route('home.delete', ['id' => $item->id]) }}" method="POST"
                                                    style="{{ $item->file ? '' : 'margin-right: 23%' }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-raised btn-danger" type="submit">Delete</button>
                                                </form>

                                                @endif
                                                @if ($item->file )
                                                    <a class="btn btn-raised btn-warning  btn-icon float-right"
                                                        href="{{ route('home.dowload', ['id' => $item->id]) }}"><span
                                                            class="ti-import"></span></a>
                                                @endif
                                            @if ($item->status<3 && auth()->user()->is_role==false)

                                            <a href="{{ route('home.status', ['id' => $item->id]) }}"
                                                class="btn btn-raised btn-{{($item->status==1)? 'info':'secondary'}}"
                                                style="{{ $item->status ? '' : 'margin-left: -22%' }}">{{($item->status==1)? 'Shipping':'Cancel'}}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
