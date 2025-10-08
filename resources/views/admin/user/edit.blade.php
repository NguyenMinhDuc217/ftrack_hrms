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
              <h3>Edit User</h3>
            </div>
            <form action="{{ route('admin.users.update', ['user_id' => $user->user_id]) }}" method="POST" class="form-horizontal">
              @csrf
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <div class="card-body">
                <div class="form-group">
                  <label class="form-label" for="example-max-length">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Enter username" id="example-max-length" maxlength="4" value="{{$user->username}}">
                  <small>maxlength set to 4 characters</small>
                </div>
                <div class="form-group">
                  <label class="form-label" for="example-max-length">Firstname</label>
                  <input type="text" class="form-control" name="username" placeholder="Enter firstname" id="example-max-length" maxlength="4" value="{{$user->first_name}}">
                  <small>maxlength set to 4 characters</small>
                </div>
                 <div class="form-group">
                  <label class="form-label" for="example-max-length">Lastname</label>
                  <input type="text" class="form-control" name="username" placeholder="Enter firstname" id="example-max-length" maxlength="4" value="{{$user->last_name}}">
                  <small>maxlength set to 4 characters</small>
                </div>
                <div class="form-group">
                  <label class="form-label" for="example-max-length">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Enter Email" id="example-max-length" maxlength="4" value="{{$user->email}}">
                </div>
                <div class="form-group">
                  <label class="form-label" for="example-max-length">Phone number</label>
                  <input type="text" class="form-control error" name="phone_number" id="tel" pattern="^(?:\d{3}\d{3}\d{4})$" required="" aria-describedby="bouncer-error_tel" aria-invalid="true" value="{{$user->phone_number}}">
                  <small class="form-text text-muted">123-456-7890</small>
                </div>
                <div class="form-group d-flex gap-2">
                  <label class="col-form-label text-lg-end">Gender</label>
                  <div class="">
                    @foreach ($genders as $gender)
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" value="{{$gender}}" id="{{$gender}}" @checked($user->gender == $gender) required="">
                      <label class="form-check-label" for="{{$gender}}"> {{ $gender->getLabel()['label'] }} </label>
                    </div>
                    @endforeach
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="date_of_birth">Date of birth</label>
                  <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" min="1950-01-02" value="{{ \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') }}">
                  <small>Enter a date after 1950-01-01</small>
                </div>
                <div class="form-group">
                  <label class="form-label" for="hire_date">Hire date</label>
                  <input type="date" class="form-control" id="hire_date" name="hire_date" min="2000-01-02" value="{{ \Carbon\Carbon::parse($user->hire_date)->format('Y-m-d') }}">
                  <small>Enter a date after 2000-01-01</small>
                </div>
                <div class="form-group">
                  <label class="form-label">Derpartment</label>
                  <select class="form-control" name="derpartment_id" id="select" onchange="changeDepartment(this.value)" required>
                    <option label="--Department--"></option>
                    @foreach ($departments as $department)
                    <option value="{{$department->department_id}}" @selected($user->department_id == $department->department_id)>{{$department->department_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Manager</label>
                  <select class="form-control" name="manager_id" id="select" required>
                    <option label="--Manager--"></option>
                    @foreach($users as $usera)
                    <option value="{{$user->user_id}}">{{$usera->username}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Document</label>
                  <select class="form-control" name="document_id" id="select" required>
                    <option label="--Document--"></option>
                    @foreach ($departments as $department)
                    <option value="{{$department->department_id}}">{{$department->department_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Employment Type</label>
                  <select name="status" class="form-control">
                    <option value="*">--Employment Type--</option>
                    @foreach($employment_types as $type)
                      <option value="{{ $type }}" @selected($user->employment_type == $type)>
                          {{ $type }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Aplicant</label>
                  <input type="number" class="form-control" name="aplicant" placeholder="Enter Aplicant" value="{{$user->aplicant}}">
                </div>
                <div class="form-group">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-control">
                    <option value="*">--Status--</option>
                    @foreach($statuses as $status)         
                      <option value="{{ $status }}" @selected($user->status->value == $status)>
                          {{ $status }}
                      </option>
                    @endforeach
                  </select>
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