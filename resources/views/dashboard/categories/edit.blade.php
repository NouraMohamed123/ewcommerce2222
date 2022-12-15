@extends('layouts.dashbard')

@section('title')
    edit category
@endsection

@section('contentheader')
    category
@endsection

@section('contentheaderlink')
    <a href="{{ route('categories.index') }}"> category </a>
@endsection

@section('contentheaderactive')
    edit
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">edit categories </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form method="post" action="{{ route('categories.update', $data->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif



                        <div class="form-group">
                            <label>category name</label>
                            <input name="name" id="name" class="form-control" placeholder="enter category name"
                                oninvalid="setCustomValidity('enter category name')" value="{{ $data->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> parent</label>
                            <select name="parent_id" id="parent_id" class="form-control">

                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"
                                        @php $data->parent_id ==$parent->id ?'selected' :  '' @endphp>{{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>description </label>
                            <textarea name="description" id="description" class="form-control" placeholder="enter name "
                                oninvalid="setCustomValidity('enter name ')">{{ $data->description }}</textarea>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>imag</label>
                            <input type="file" id="image" name="image" class="form-control">
                            @if ($data->image)
                                <img src="{{ asset('storage/' . $data->image) }}" alt="" height="50">
                            @endif
                            @error('imag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label> status </label>
                            <select name="status" id="active" class="form-control">

                                {{-- <option {{  old('active',$data['active'])==1 ? 'selected' : ''}}   value="1"> active</option>
                                 <option {{ old('active',$data['active'])==0 ? 'selected' : ''}}  value="0"> archived</option> --}}
                                <option {{ $data['status'] == 'active' ? 'selected' : '' }} value="active"> active</option>
                                <option {{ $data['status'] == 'archive' ? 'selected' : '' }} value="archive"> archived
                                </option>
                            </select>

                            @error('active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-sm"> edit category</button>

                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-danger">categories</a>

                        </div>


                    </form>
                </div>


            </div>
        </div>
    </div>
    </div>
@endsection
