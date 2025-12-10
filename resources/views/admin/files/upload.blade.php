@extends('layouts.admin')

@section('title', 'Manual File Upload')
@section('page_title', 'Manual File Upload')

@section('content')
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3>Upload File</h3>
        </div>
        <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
          @csrf
          <div class="card-body">
            @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
                @if(session('file_url'))
                  <br>
                  <strong>File URL:</strong> <a href="{{ session('file_url') }}" target="_blank">{{ session('file_url') }}</a>
                @endif
              </div>
            @endif
            @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif  

            <div class="form-group mb-3">
              <label class="form-label" for="disk">Disk</label>
              <select name="disk" id="disk" class="form-control">
                <option value="local">Local</option>
                <option value="s3">S3</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label class="form-label" for="path">Path</label>
              <input 
                type="text" 
                class="form-control @error('path') is-invalid @enderror" 
                name="path" 
                id="path" 
                placeholder="Enter path"
              >
              @error('path')
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </div>
              @enderror
            </div>
            <div class="form-group mb-3"></div>
              <label class="form-label" for="file">Select File</label>
              <input 
                type="file" 
                class="form-control @error('file') is-invalid @enderror" 
                name="file" 
                id="file" 
                required
              >
              @error('file')
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </div>
              @enderror
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
