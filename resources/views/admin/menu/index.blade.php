@extends('layouts.admin')

@section('title', 'Admin Dashboard - Menus')
@section('page_title', 'Menus')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Menu ID</th>
                                    <th>Label</th>
                                    <th>Slug</th>
                                    <th>Type</th>
                                    <th>Route Name</th>
                                    <th>Url</th>
                                    <th>Icon</th>
                                    <th>Bage</th>
                                    <th>Parent ID</th>
                                    <th>Position</th>
                                    <th>Is Active </th>
                                    <th>Updated Time</th>
                                    <th>Updated Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td>{{ $menu->id }}</td>
                                        <td>{{ $menu->label }}</td>
                                        <td>{{ $menu->slug  }}</td>
                                        <td>{{ $menu->type  }}</td>
                                        <td>{{ $menu->route_name  }}</td>
                                        <td>{{ $menu->url }}</td>
                                        <td>{{ $menu->icon }}</td>
                                        <td>{{ $menu->badge }}</td>
                                        <td>{{ $menu->parent_id  }}</td>
                                        <td>{{ $menu->position  }}</td>
                                        <td>{{ $menu->is_active  }}</td>
                                        <td>{{ $menu->created_at }}</td>
                                        <td>{{ $menu->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection
