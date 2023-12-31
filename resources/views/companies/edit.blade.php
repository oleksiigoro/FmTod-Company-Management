@extends('layouts.app')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Edit Company</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('companies.update',$company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 py-1">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $company->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 py-1">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $company->email }}" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 py-1">
                <div class="form-group">
                    <strong>Logo:</strong>
                    <div class="thumbnail"><img src="{{ url('storage/'.$company->logo.'') }}" alt="" title="" class="img-fluid img-thumbnail"  /></div>
                    <input type="file" name="image" class="form-control" placeholder="Logo">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 py-1">
                <div class="form-group">
                    <strong>Website:</strong>
                    <input type="text" name="website" value="{{ $company->website }}" class="form-control" placeholder="Website">
                </div>
            </div>                        
            <div class="col-xs-12 col-sm-12 col-md-12 text-center py-1">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection
