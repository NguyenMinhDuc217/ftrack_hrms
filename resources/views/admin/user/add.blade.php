@extends('layouts.admin')

@section('title', 'Admin Dashboard - Users')
@section('page_title', 'Edit Users')

@section('content')
 <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h3>Add User</h3>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="form-horizontal">
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <label class="form-label" for="username">Username</label>
                  <input 
                    type="text" 
                    class="form-control @error('username') is-invalid @enderror" 
                    name="username" 
                    placeholder="Enter username" 
                    id="username"
                    value="{{ old('username') }}"
                  >
                  @error('username')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                  <small>maxlength set to 100 characters</small>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="example-max-length">Firstname</label>
                  <input 
                    type="text" 
                    class="form-control @error('first_name') is-invalid @enderror" name="first_name" 
                    placeholder="Enter firstname" 
                    id="first_name"
                    value="{{ old('first_name') }}"
                  >
                  @error('first_name')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                  <small>maxlength set to 50 characters</small>
                </div>

                 <div class="form-group">
                  <label class="form-label" for="last_name">Lastname</label>
                  <input 
                    type="text" 
                    class="form-control @error('last_name') is-invalid @enderror" 
                    name="last_name" 
                    placeholder="Enter lastname" 
                    id="last_name"
                    value="{{ old('last_name') }}"
                  >
                  @error('last_name')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                  <small>maxlength set to 50 characters</small>
                </div>

                <div class="form-group">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" id="email" value="{{ old('email') }}">
                  @error('email')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                  <small>dinhcaotang12@gmail.com</small>
                </div>

                <div class="form-group">
                  <label class="form-label" for="example-max-length">Phone number</label>
                  <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="tel" pattern="^(?:\d{3}\d{3}\d{4})$" aria-describedby="bouncer-error_tel" aria-invalid="true" value="{{ old('phone_number') }}">
                  @error('phone_number')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                  <small class="form-text text-muted">09xxxxxxxx</small>
                  <small>maxlength set to 10 numbers</small>
                </div>

                <div class="form-group d-flex gap-2">
                  <label class="col-form-label text-lg-end">Gender</label>
                  <div class="">
                    @foreach ($genders as $gender)
                    <div class="form-check">
                      <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="{{ $gender }}" @checked(old('gender') == $gender) id="{{$gender}}">
                      <label class="form-check-label" for="{{$gender}}"> {{ $gender->getLabel()['label'] }} </label>
                    </div>
                    @endforeach
                    @error('gender')
                      <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </div>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-label" for="date_of_birth">Date of birth</label>
                  <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" min="1950-01-02" value="{{ old('date_of_birth') }}">
                  @error('date_of_birth')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                  <small>Enter a date after 1950-01-01</small>
                </div>

                <div class="form-group">
                  <label class="form-label" for="hire_date">Hire date</label>
                  <input type="date" class="form-control @error('hire_date') is-invalid @enderror" id="hire_date" name="hire_date" min="2000-01-02" value="{{ old('hire_date') }}">
                  @error('hire_date')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                  <small>Enter a date after 2000-01-01</small>
                </div>

                <div class="form-group">
                  <label class="form-label">Department</label>
                  <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" onchange="changeDepartment(this.value)">
                    <option label="--Department--"></option>
                    @foreach ($departments as $department)
                    <option value="{{$department->department_id}}" @selected(old('department_id') == $department->department_id)>
                      {{$department->department_name}}
                    </option>
                    @endforeach
                  </select>
                  @error('department_id')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="form-label">Manager</label>
                  <select class="form-control @error('manager_id') is-invalid @enderror" name="manager_id">
                    <option label="--Manager--"></option>
                    @foreach($users as $usera)
                    <option value="{{$usera->user_id}}" @selected(old('manager_id') == $usera->user_id)>
                      {{$usera->username}}
                    </option>
                    @endforeach
                  </select>
                  @error('manager_id')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="form-label">Document</label>
                  <select class="form-control @error('document_id') is-invalid @enderror" name="document_id">
                    <option label="--Document--"></option>
                    @for($i=1; $i<=10; $i++)
                    <option value="{{$i}}" @selected(old('document_id') == $i)>{{$i}}</option>
                    @endfor
                  </select>
                  @error('document_id')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="form-label">Employment Type</label>
                  <select name="employment_type" class="form-control @error('employment_type') is-invalid @enderror">
                    <option value="*">--Employment Type--</option>
                    @foreach($employment_types as $key => $value)
                      <option value="{{ $key }}" @selected(old('employment_type') == $key)>
                          {{ $value }}
                      </option>
                    @endforeach`
                  </select>
                  @error('employment_type')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="form-label">Applicant</label>
                  <input type="number" class="form-control @error('applicant') is-invalid @enderror" name="applicant" placeholder="Enter Aplicant" value ="{{ old('applicant') }}">
                  @error('applicant')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                  <small>Enter a number</small>
                </div>

                <div class="form-group">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="*">--Status--</option>
                    @foreach($statuses as $key => $value)
                      <option value="{{ $key }}" @selected(old('status') == $key)>
                          {{ $value }}
                      </option>
                    @endforeach
                  </select>
                  @error('status')
                    <div class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-success me-2">Submit</button>
                <button type="reset" class="btn btn-light">Reset</button>
              </div>
            </form>
          </div>

        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
<script>
  function changeDepartment(department_id) {
    $.ajax({
      url: "{{ route('admin.users.changeDepartment', ['department_id' => '']) }}/" + department_id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        var managerSelect = $('select[name="manager_id"]');
        managerSelect.empty();
        managerSelect.append('<option label="--Manager--"></option>');
        $.each(response, function(index, manager) {
          managerSelect.append('<option value="' + manager.user_id + '">' + manager.username + '</option>');
        });
      }
    })
  }
</script>
@endsection
