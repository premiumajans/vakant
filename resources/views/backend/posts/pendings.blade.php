@extends('master.backend')
@section('title',__('backend.pending-posts'))
@section('styles')
    <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@lang('backend.pending-posts'):</h4>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                               style="border-collapse: collapse; border-spacing: 0;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('backend.photo'):</th>
                                <th>@lang('backend.title')(az):</th>
                                <th>@lang('backend.categories'):</th>
                                    <th>@lang('backend.actions'):</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pendingPosts as $pendingPost)
                                <tr>
                                    <td>{{ $pendingPost->id }}</td>
                                    <td><img src="{{ asset($pendingPost->photo) }}" width="100px" height="50px"></td>
                                    <td>{{ $pendingPost->translate('az')->title }}</td>
                                    <td>{{ category($pendingPost->category_id)[0]->translate('az')->name }}</td>
                                    @canany(['settings edit','settings delete'])
                                        <td class="text-center">
                                            <a class="btn btn-primary" title="Posta bax"
                                               href={{ route('backend.pendingPostId',['id'=>$pendingPost->id]) }}>
                                                <i class="fas fa-eye"></i>
                                            </a>
{{--                                            <a class="btn btn-success"--}}
{{--                                               href={{ route('backend.posts.edit',['post'=>$pendingPost->id]) }}>--}}
{{--                                                <i class="fas fa-check-square"></i>--}}
{{--                                            </a>--}}
{{--                                            @can('posts edit')--}}
{{--                                                <a class="btn btn-primary"--}}
{{--                                                   href={{ route('backend.posts.edit',['post'=>$pendingPost->id]) }}>--}}
{{--                                                    <i class="fas fa-edit"></i>--}}
{{--                                                </a>--}}
{{--                                            @endcan--}}
{{--                                            @can('posts delete')--}}
{{--                                                <a class="btn btn-danger"--}}
{{--                                                   href="{{ route('backend.delPost',['id'=>$pendingPost->id]) }}">--}}
{{--                                                    <i class="fas fa-trash"></i>--}}
{{--                                                </a>--}}
{{--                                            @endcan--}}
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
