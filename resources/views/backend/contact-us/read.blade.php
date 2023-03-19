@extends('master.backend')
@section('title',__('backend.contact-us'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="email mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.read-mail') : #{{ $message->id }}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <img class="me-3 rounded-circle avatar-sm"
                                             src="{{asset('backend/images/users/mail.png')}}"
                                             alt="Generic placeholder image">
                                        <div class="flex-1">
                                            <h5 class="font-size-16 my-1">{{ $message->name }}</h5>
                                            <small> {{ date('d.m.Y H:i:s',strtotime($message->created_at))}}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <h5>@lang('backend.email'): <a
                                                href="mailto:{{ $message->mail }}">{{ $message->email }}</a></h5>
                                        <h5>@lang('backend.title'): {{ $message->title }}</h5>
                                    </div>
                                    <p>
                                    <h5>@lang('backend.message'):</h5>
                                    <p>
                                        {{ $message->message }}
                                    </p>
                                    <a href="mailto:{{ $message->email }}"
                                       class="btn btn-secondary waves-effect mt-4"><i class="mdi mdi-reply"></i>
                                        @lang('backend.reply')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
