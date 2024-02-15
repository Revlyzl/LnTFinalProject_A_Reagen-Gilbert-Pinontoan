@extends('layouts.main')

@section('container')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Category Information</strong>
                </div>
                <div class="pull-right">
                    <a href="/adminProduct" class="btn btn-success btn-sm">
                        <i class="fa fa-undo"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="/store-category" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name">
                      @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
            
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                  </form>



            </div>
        </div>
        
    </div>

</div>


@endsection