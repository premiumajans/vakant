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
                                            <div>
                                                <a href="{{ route('backend.approve-vacancy',$vacancy->id) }}"
                                                   class="btn btn-success waves-effect mt-4"><i
                                                        class="fas fa-check"></i>
                                                    @lang('backend.approve')</a>
                                                <a href="{{ route('backend.vacanciesDelete',$vacancy->id) }}"
                                                   class="btn btn-danger waves-effect mt-4"><i class="fas fa-times"></i>
                                                    @lang('backend.cancel')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <img class="me-3 rounded-circle avatar-sm"
                                             src="{{ ($vacancy->causer_type == 1) ? 'https://static.vecteezy.com/system/resources/previews/007/296/443/original/user-icon-person-icon-client-symbol-profile-icon-vector.jpg' : 'https://cdn-icons-png.flaticon.com/512/4812/4812244.png' }}"
                                             alt="Generic placeholder image">
                                        <div class="flex-1">
                                            <h5 class="font-size-16 my-1">{{ $vacancy->description->position ?? '-' }}
                                                / {{ $vacancy->description->company ?? '-' }}</h5>
                                            <small> {{ date('d.m.Y H:i:s',strtotime($vacancy->shared_time))}}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <h5>@lang('backend.position'): {{ $vacancy->description->position ?? '-'}}</h5>
                                        <h5>@lang('backend.category')
                                            : {{ \App\Models\AltCategory::find($vacancy->description?->category_id)->translate(app()->getLocale())->name ?? '-' }}</h5>
                                        <h5>@lang('backend.email'): <a
                                                href="mailto:{{ $vacancy->description?->mail ?? '-'}}">{{ $vacancy->description->email ?? '-'}}</a>
                                        </h5>
                                        <h5>
                                            @lang('backend.salary'):
                                            {{ $vacancy->description?->min_salary ?? '-' }}
                                            -
                                            {{ $vacancy->description?->max_salary ?? '-'}}
                                            AZN
                                        </h5>
                                        <h5>
                                            @lang('backend.age'):
                                            {{ $vacancy->description->min_age  ?? '-' }}
                                            -
                                            {{ $vacancy->description->max_age  ?? '-' }}
                                        </h5>
                                        <h5>@lang('backend.experience')
                                            : {{ \App\Models\Experience::find($vacancy->description?->experience_id)->translate(app()->getLocale())->name ?? '-' }}</h5>
                                        <h5>@lang('backend.education')
                                            : {{ \App\Models\Education::find($vacancy->description?->education_id)->translate(app()->getLocale())->name ?? '-' }}</h5>
                                        <h5>@lang('backend.city')
                                            : {{ \App\Models\City::find($vacancy->description?->experience_id ?? '-' )->translate(app()->getLocale())->name ?? '-' }}</h5>
                                        <h5>@lang('frontend.company'): {{ $vacancy->description?->company  ?? '-' }}</h5>
                                        <h5>@lang('frontend.relevant-people')
                                            : {{ $vacancy->description->relevant_people  ?? '-' }}</h5>
                                        <h5>@lang('frontend.candidate-requirements'):
                                            <br> {!! $vacancy->description->candidate_requirement  ?? '-' !!}</h5>
                                        <h5>@lang('frontend.about-job'):
                                            <br> {!! $vacancy->description->job_description  ?? '-'  !!}</h5>
                                        <h5>@lang('backend.tags'): <br>
                                            @foreach(vacancy_tags($vacancy->description->tags ?? '-' ) as $tag)
                                                <span>#{{ $tag }}@if(!$loop->last)
                                                        ,
                                                    @endif</span>
                                            @endforeach
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
