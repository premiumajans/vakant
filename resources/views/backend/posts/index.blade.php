@extends('master.backend')
@section('title',__('backend.posts'))
@section('styles')
<link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">@lang('backend.posts')</h4>
                            @can('posts create')
                            <a href="{{ route('backend.posts.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> &nbsp;@lang('backend.add-new')
                            </a>
                            @endcan
                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('backend.photo'):</th>
                                <th>@lang('backend.title')(az):</th>
                                <th>@lang('backend.categories'):</th>
                                <th>@lang('backend.status'):</th>
                                {{-- <th>@lang('backend.status'):</th>--}}
                                @canany(['posts edit','posts delete'])
                                <th>@lang('backend.actions'):</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td><img src="{{ asset($post->photo) }}" width="100px" height="50px"></td>
                                <td>{{ $post->translate('az')->title }}</td>
                                <td>{{ category($post->category_id)[0]->translate('az')->name }}</td>
                                <td><span class="btn btn-{{ ($post->admin_status == 0 ? 'danger' : 'success') }}">{{ ($post->admin_status == 0 ? __('backend.pending') : __('backend.approved')) }}</span></td>
                                @canany(['posts edit','posts delete'])
                                <td class="text-center">
                                    @can('posts edit')
                                    <a class="btn btn-primary" href={{ route('backend.posts.edit',['post'=>$post->id]) }}>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('posts delete')
                                    <a class="btn btn-danger" href="{{ route('backend.delPost',['id'=>$post->id]) }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endcan
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('backend/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('backend/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/datatables.init.js') }}"></script>
@endsection