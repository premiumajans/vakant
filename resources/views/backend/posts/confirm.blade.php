@extends('master.backend')
@section('title',__('backend.pending-posts'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@lang('backend.pending-posts'): #{{$pendingPost->id}}</h4>
                                <div>
                                <a class="btn btn-success"
                                   href={{ route('backend.approvePost',['id'=>$pendingPost->id]) }}>
                                    @lang('backend.approve')
                                    <i class="fas fa-check-square"></i>
                                </a>
                                <a class="btn btn-primary"
                                   href={{ route('backend.posts.edit',['post'=>$pendingPost->id]) }}>
                                    @lang('backend.edit')
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a class="btn btn-danger"
                                   href={{ route('backend.delPost',['id'=>$pendingPost->id]) }}>
                                    @lang('backend.delete')
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            </div>
                            <div class="page-title-box d-sm-flex align-items-center justify-content-center">
{{--                                <a class="btn btn-success"--}}
{{--                                   href={{ route('backend.posts.edit',['post'=>$pendingPost->id]) }}>--}}
{{--                                    @lang('backend.approve')--}}
{{--                                    <i class="fas fa-check-square"></i>--}}
{{--                                </a>--}}
{{--                                <a class="btn btn-primary m-4"--}}
{{--                                   href={{ route('backend.posts.edit',['post'=>$pendingPost->id]) }}>--}}
{{--                                    @lang('backend.edit')--}}
{{--                                    <i class="fas fa-pen"></i>--}}
{{--                                </a>--}}
{{--                                <a class="btn btn-danger"--}}
{{--                                   href={{ route('backend.posts.edit',['post'=>$pendingPost->id]) }}>--}}
{{--                                    @lang('backend.delete')--}}
{{--                                    <i class="fas fa-trash-alt"></i>--}}
{{--                                </a>--}}
                            </div>
                            <iframe src="{{ route('backend.ppost',$pendingPost->id) }}" width="100%"
                                    height="700px"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
