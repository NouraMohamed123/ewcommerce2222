@extends('layouts.dashbard')

@section('title')
    add new category
@endsection

@section('contentheader')
    category
@endsection

@section('contentheaderlink')
    <a href="{{ route('categories.index') }}"> category </a>
@endsection

@section('contentheaderactive')
    add
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">add new categories </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @csrf

                        <div class="form-group">
                            <label>category name</label>
                            <input name="name" id="name" class="form-control" value="{{ old('name') }}"
                                placeholder="enter category name" oninvalid="setCustomValidity('enter category name')">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> parent</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">primry category </option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                           
                            @error('parent_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>description </label>
                            <input name="description" id="description" class="form-control" value="{{ old('description') }}"
                                placeholder="enter name " oninvalid="setCustomValidity('enter name ')">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>imag</label>
<input type="file" id="img" name="image" accept="image/*">
                            @error('imag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> status </label>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected> status</option>
                                <option value="active"> active
                                </option>
                                <option  value="archive"> archive
                                </option>
                            </select>

                            @error('active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-sm"> add category</button>

                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-danger">categories</a>

                        </div>


                    </form>
                </div>


            </div>
        </div>
    </div>
    </div>
@endsection
