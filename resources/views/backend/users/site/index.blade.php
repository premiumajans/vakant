@extends('master.backend')
@section('title',__('backend.site-users'))
@section('styles')
    @include('backend.templates.components.dt-styles')
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@lang('backend.site-users'):</h4>
                                @can('users create')
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModalScrollable"
                                            class="btn btn-primary"><i class="fas fa-plus"></i>
                                        &nbsp;@lang('backend.add-new')</button>
                                @endcan
                            </div>
                        </div>
                        <table id="datatable-buttons"
                               class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('backend.name'):</th>
                                <th>@lang('backend.email'):</th>
                                <th>@lang('backend.time')</th>
                                @can('users delete')
                                    <th>@lang('backend.actions'):</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($siteUsers as $user)
                                <tr>
                                    <td class="text-center">{{ $user->id }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td>{{ date('d.m.Y H:i:s',strtotime($user->created_at))}}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                <a class="dropdown-item edit-button" href="{{ route('backend.userCompany',$user->id) }}">
                                                    <i class="fas fa-briefcase"></i>&nbsp;@lang('backend.my-company')
                                                </a>
                                                <a class="dropdown-item edit-button"  target="_blank" href="{{ route('backend.site-users.edit',$user->id) }}">
                                                    <i class="fas fa-pen"></i>&nbsp;@lang('backend.edit')
                                                </a>
                                                <a class="dropdown-item text-danger delete-button" href="{{ route('backend.site-usersDelete',$user->id) }}"><i class="fas fa-trash"></i>&nbsp;@lang('backend.delete')</a>
                                                <a class="dropdown-item text-red"><i
                                                        class="fas fa-clock"></i>&nbsp;{{ date('d.m.Y H:i:s',strtotime($user->created_at))}}</a>
                                            </div>
                                        </div>
                                        @include('backend.templates.items.modals.system-delete-modal',['value' => $user, 'variable' => 'site-users'])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.users.site.create')
@endsection
@section('scripts')
    @include('backend.templates.components.dt-scripts')
@endsection
