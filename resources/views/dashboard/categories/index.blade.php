@extends('layouts.dashbard')
@section('title')
    sttings
@endsection
@section('contentheader')
    categories
@endsection
@section('contentheaderlink')
    <a href="{{ route('categories.index') }}">الاقسام </a>
@endsection
@section('contentheaderactive')
    view
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center"> categories detlis </h3>
                    <br>


                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success  " style="">new
                        categorie</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('info'))
                        <div class="alert alert-info">
                            {{ session('info') }}
                        </div>
                    @endif
                    <div id="ajax_responce_serarchDiv">
                        <form action="{{ URL::current() }}" method="GET" class="d-flex justify-content-between mb-4">
                            <input type="text" name="name" placeholder="Name" class="form-control mx-2">
                            <select name="status" id="" class="form-control mx-2">
                                <option value="">All</option>
                                <option value="active">Active</option>
                                <option value="archived">archive</option>
                            </select>
                            <button class="btn btn-dark mx-2">Filter</button>
                        </form>

                        @if (@isset($data) && !@empty($data))
                            @php
                                $i = 1;
                            @endphp
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="custom_thead">
                                    <th>Image</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th> action </th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $info)
                                        <tr>
                                            <td><img src="{{ asset('storage/' . $info->image) }}" alt=""
                                                    height="50"></td>
                                            <td>{{ $i }}</td>
                                            <td>{{ $info->name }}</td>
                                            <td>{{ $info->parent_id }}</td>
                                            <td>
                                                {{ $info->status }}
                                            <td>


                                                <a href="{{ route('categories.edit', $info->id) }}"
                                                    class="btn btn-sm  btn-primary">edit</a>
                                                <a href="{{ route('categories.destroy', $info->id) }}"
                                                    class="btn btn-sm  btn btn-danger"> delet</a>

                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7"> data not found</td>
                                    </tr>
                        @endif


                        </tbody>

                        </table>
                        <br>



                    </div>





                </div>
            </div>
        </div>
    </div>



    <div class="d-felx justify-content-center">

            {{ $data->links() }}

        </div>
    </div>

@endsection
