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
                                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.vacancy') : #{{ $vacancy->id }}</h4>
                                            <div>
                                                <a href="{{ route('backend.approve-vacancy',$vacancy->id) }}"
                                                   class="btn btn-success waves-effect mt-4"><i class="fas fa-check"></i>
                                                    @lang('backend.approve')</a>
                                                <a href="{{ route('backend.delVacancy',$vacancy->id) }}"
                                                   class="btn btn-danger waves-effect mt-4"><i class="fas fa-times"></i>
                                                    @lang('backend.cancel')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <img class="me-3 rounded-circle avatar-sm"
                                             src="{{ ($vacancy->company_type == 1) ? 'https://static.vecteezy.com/system/resources/previews/007/296/443/original/user-icon-person-icon-client-symbol-profile-icon-vector.jpg' : 'https://cdn-icons-png.flaticon.com/512/4812/4812244.png' }}"
                                             alt="Generic placeholder image">
                                        <div class="flex-1">
                                            <h5 class="font-size-16 my-1">{{ $vacancy->position ?? '-' }}
                                                / {{ $vacancy->company ?? '-' }}</h5>
                                            <small> {{ date('d.m.Y H:i:s',strtotime($vacancy->start_time))}}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <h5>@lang('backend.position'): {{ $vacancy->position }}</h5>
                                        <h5>@lang('backend.category')
                                            : {{ \App\Models\AltCategory::where('id',$vacancy->category_id)->first()->translate(app()->getLocale())->name ?? '-' }}</h5>
                                        <h5>@lang('backend.email'): <a
                                                href="mailto:{{ $vacancy->mail }}">{{ $vacancy->email }}</a></h5>
                                        <h5>
                                            @lang('backend.salary'):
                                            {{ \Illuminate\Support\Facades\DB::table('salaries')->where('id','=',$vacancy->min_salary)->first()->salary }}
                                            -
                                            {{ \Illuminate\Support\Facades\DB::table('salaries')->where('id','=',$vacancy->max_salary)->first()->salary }}
                                            AZN
                                        </h5>
                                        <h5>
                                            @lang('backend.age'):
                                            {{ $vacancy->min_age }}
                                            -
                                            {{ $vacancy->max_age }}
                                        </h5>
                                        <h5>@lang('backend.experience'): {{ \App\Models\Experience::find($vacancy->experience_id)->translate(app()->getLocale())->name ?? '-' }}</h5>
                                        <h5>@lang('backend.education'): {{ \App\Models\Education::find($vacancy->education_id)->translate(app()->getLocale())->name ?? '-' }}</h5>
                                        <h5>@lang('backend.city'): {{ \App\Models\City::find($vacancy->experience_id)->translate(app()->getLocale())->name ?? '-' }}</h5>
                                        <h5>@lang('frontend.company'): {{ $vacancy->company }}</h5>
                                        <h5>@lang('frontend.relevant-people'): {{ $vacancy->relevant_people }}</h5>
                                        <h5>@lang('frontend.candidate-requirements'): <br> {!! $vacancy->candidate_requirement !!}</h5>
                                        <h5>@lang('frontend.about-job'): <br> {!! $vacancy->job_description !!}</h5>
                                        <h5>@lang('backend.tags'): <br>
                                            @foreach(vacancy_tags($vacancy->tags) as $tag)
                                                <span>#{{ $tag }}@if(!$loop->last),@endif</span>
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
