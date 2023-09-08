@extends('master.backend')
@section('title',__('backend.vacancies'))
@section('styles')
    <link rel="stylesheet" href="{{asset('user-assets/vendor/libs/tagify/tagify.css')}}"/>
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('backend.vacancies'): #{{ $vacancy->id }}</h4>
                                    </div>
                                </div>
                                <form action="{{ route('backend.updateMergedVacancy',$vacancy->id) }}" method="POST"
                                      class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label>@lang('backend.position')
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="position" class="form-control" required=""
                                               value="{{ $vacancy->position }}">
                                        {!! validationResponse('backend.position') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.categories') <span class="text-danger">*</span></label>
                                        <div>
                                            <select class="form-control" name="category">
                                                @foreach($categories as $cat)
                                                    <optgroup label="{{ $cat->name }}">
                                                        @foreach($cat->alt as $altCat)
                                                            <option
                                                                @if($altCat->id == $vacancy->category_id) selected
                                                                @endif
                                                                value="{{ $altCat->id }}">{{ $altCat->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label>@lang('backend.city') <span class="text-danger">*</span></label>
                                            <select class="form-control" name="city">
                                                @foreach($cities as $city)
                                                    <option @if($city->id == $vacancy->city_id) selected
                                                            @endif
                                                            value="{{ $city->id }}">{{ $city->translate(app()->getLocale())->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label>@lang('backend.work-mode') <span class="text-danger">*</span></label>
                                            <select class="form-control" name="mode">
                                                @foreach($modes as $mode)
                                                    <option @if($mode->id == $vacancy->mode_id) selected
                                                            @endif
                                                            value="{{ $mode->id }}">{{ $mode->translate(app()->getLocale())->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-6">
                                            <label>@lang('backend.min-salary') <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="minimum_salary">
                                                @foreach($salaries as $salary_min)
                                                    <option
                                                        value="{{ $salary_min->id }}"
                                                        @if($salary_min->id == $vacancy->min_salary) selected @endif
                                                    ">{{ $salary_min->salary ?? '-' }}
                                                    ₼
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('backend.max-salary') <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="maximum_salary">
                                                @foreach($salaries as $salary)
                                                    <option value="{{ $salary->id }}"
                                                            @if($salary->id == $vacancy->max_salary) selected @endif>{{ $salary->salary ?? '-' }}
                                                        ₼
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-6">
                                            <label>@lang('backend.min-age') <span class="text-danger">*</span></label>
                                            <select class="form-control" name="minimum_age">
                                                @for($i=18;$i<66;$i++)
                                                    <option @if($i == $vacancy->min_age) selected
                                                            @endif value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('backend.max-age') <span class="text-danger">*</span></label>
                                            <select class="form-control" name="maximum_age">
                                                @for($i=65;$i>=18;$i--)
                                                    <option @if($i == $vacancy->max_age) selected
                                                            @endif value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-6">
                                            <label>@lang('backend.education') <span class="text-danger">*</span></label>
                                            <select class="form-control" name="education">
                                                @foreach($educations as $education)
                                                    <option
                                                        @if($education->id == $vacancy->education_id) selected
                                                        @endif
                                                        value="{{$education->id}}">{{ $education->translate(app()->getLocale())->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('backend.experience') <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="experience">
                                                @foreach($experiences as $experience)
                                                    <option
                                                        @if($experience->id == $vacancy->experience_id) selected
                                                        @endif
                                                        value="{{$experience->id}}">{{ $experience->translate(app()->getLocale())->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-6">
                                            <label>@lang('frontend.company') <span class="text-danger">*</span></label>
                                            <input name="company" class="form-control" required
                                                   value="{{ $vacancy->company }}">
                                            {!! validationResponse('frontend.company') !!}
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('frontend.relevant-people') <span class="text-danger">*</span></label>
                                            <input name="relevant_people" class="form-control" required
                                                   value="{{ $vacancy->relevant_people }}">
                                            {!! validationResponse('frontend.relevant_people') !!}
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-6">
                                            <label>@lang('backend.email') <span class="text-danger">*</span></label>
                                            <input name="email" class="form-control"
                                                   value="{{ $vacancy->email }}"
                                                   required>
                                            {!! validationResponse('frontend.email') !!}
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                            <input name="phone" class="form-control"
                                                   value="{{ $vacancy->phone }}"
                                                   required>
                                            {!! validationResponse('frontend.phone') !!}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('frontend.candidate-requirements') <span
                                                class="text-danger">*</span></label>
                                        <textarea required id="elmaz1"
                                                  name="candidate_requirements">{!! $vacancy->candidate_requirement !!}</textarea>
                                       {!! validationResponse('frontend.candidate-requirements') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('frontend.about-job') <span class="text-danger">*</span></label>
                                        <textarea required id="elmaz2"
                                                  name="about_job">{!! $vacancy->job_description !!}</textarea>
                                       {!! validationResponse('frontend.about_job') !!}
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="TagifyBasic" class="form-label">@lang('backend.keywords')</label>
                                        <input id="TagifyBasic" class="form-control" name="tags"
                                               value="@foreach(vacancy_tags($vacancy->tags) as $tag){{ $tag }}@if(!$loop->last),@endif @endforeach"/>
                                    </div>
                                    <div class="mb-0 text-center">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                @lang('backend.submit')
                                            </button>
                                            <a href="{{url()->previous()}}" type="button"
                                               class="btn btn-secondary waves-effect">
                                                @lang('backend.cancel')
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('backend/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/form-editor.init.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="{{asset('user-assets/vendor/libs/tagify/tagify.js')}}"></script>>
    <script src="{{asset('user-assets/js/forms-tagify.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
@endsection
