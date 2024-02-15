@extends('layouts.main')

@section('container')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>User Information</strong>
                </div>
            </div>
            

            <div class="card-body">
                <form action="/register-store" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name = "name" value="{{ old('name') }}">
                        {{-- maksudnya 'name="title"' itu memasukkan input title kedalam variabel title --}}
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name = "email" value="{{ old('email') }}">
                        {{-- maksudnya 'name="title"' itu memasukkan input title kedalam variabel title --}}
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    
                
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name = "password" value="{{ old('password') }}">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" name = "phone" value="{{ old('phone') }}">
                        {{-- maksudnya 'name="title"' itu memasukkan input title kedalam variabel title --}}
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

    
                    <button type="submit" class="btn btn-danger">Register</button>
                      
                    
                </form>
            </div>
            

        </div>
        
    </div>

</div>
@endsection