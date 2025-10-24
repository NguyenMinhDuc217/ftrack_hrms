@extends('layouts.admin')

@section('title', $page_title)
@section('page_title', $page_title)

@section('content')
	<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ $heading_title }}</h3>
            </div>
            <form action="{{ $form_url }}" method="POST" class="form-horizontal">
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
                        <label class="form-label" for="form-role-name">Role name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter role name" id="form-role-name" maxlength="255" value="{{ !empty($role) ? $role['name'] : '' }}">
                        <small>maxlength set to 255 characters</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success me-2">@lang('default.btn_submit')</button>
                    <button type="reset" class="btn btn-light">@lang('default.btn_reset')</button>
                </div>
            </form>
        </div>
    </div>
    @if($action === 'edit' && isset($role) && !empty($can_edit_permission))
        <hr>
        <x-admin.permission-assign 
            :role="$role" 
            :allPermissions="$all_permissions" 
            :assignedPermissions="$assigned_permissions" 
        />
    @endif
    <!-- [ sample-page ] end -->
	</div>
@endsection

