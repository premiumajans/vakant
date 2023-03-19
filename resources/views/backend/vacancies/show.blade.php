@extends('master.backend')
@section('title',__('backend.vacancies'))
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
                                            <h4 class="mb-sm-0">@lang('backend.vacancy') : #{{ $vacancy->id }}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <img class="me-3 rounded-circle avatar-sm"
                                             src="{{asset('backend/images/users/mail.png')}}"
                                             alt="Generic placeholder image">
                                        <div class="flex-1">
                                            <h5 class="font-size-16 my-1">{{ $vacancy->position ?? '-' }}
                                                / {{ $vacancy->company ?? '-' }}</h5>
                                            <small> {{ date('d.m.Y H:i:s',strtotime($vacancy->start_time))}}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <h5>@lang('backend.position'): {{  }}</h5>
                                        <h5>@lang('backend.category')
                                            : {{ \App\Models\AltCategory::where('id',$vacancy->category_id)->first()->translate(app()->getLocale())->name ?? '-' }}</h5>
                                        <h5>@lang('backend.email'): <a
                                                href="mailto:{{ $vacancy->mail }}">{{ $vacancy->email }}</a></h5>
                                    </div>
                                    <p>
                                        <a href="mailto:{{ $vacancy->email }}"
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
