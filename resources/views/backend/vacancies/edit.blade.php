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
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('backend.vacancies'): #{{ $vacancy->id }}</h4>
                                    </div>
                                </div>
                                <form action="{{ route('backend.vacancies.update',$vacancy->id) }}" method="POST"
                                      class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>@lang('backend.position')
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="position" class="form-control" required=""
                                               value="{{ $vacancy->description->position }}">
                                        <div class="valid-feedback">
                                            @lang('backend.position') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.position') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.categories') <span class="text-danger">*</span></label>
                                        <div>
                                            <select class="form-control" name="category">
                                                @foreach($categories as $cat)
                                                    <optgroup label="{{ $cat->name }}">
                                                        @foreach($cat->alt as $altCat)
                                                            <option
                                                                @if($altCat->id == $vacancy->description->category_id) selected
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
                                                    <option @if($city->id == $vacancy->description->city_id) selected
                                                            @endif
                                                            value="{{ $city->id }}">{{ $city->translate(app()->getLocale())->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label>@lang('backend.work-mode') <span class="text-danger">*</span></label>
                                            <select class="form-control" name="mode">
                                                @foreach($modes as $mode)
                                                    <option @if($mode->id == $vacancy->description->mode_id) selected
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
                                                        @if($salary_min->id == $vacancy->description->min_salary) selected @endif
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
                                                            @if($salary->id == $vacancy->description->max_salary) selected @endif>{{ $salary->salary ?? '-' }}
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
                                                    <option @if($i == $vacancy->description->min_age) selected
                                                            @endif value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('backend.max-age') <span class="text-danger">*</span></label>
                                            <select class="form-control" name="maximum_age">
                                                @for($i=65;$i>=18;$i--)
                                                    <option @if($i == $vacancy->description->max_age) selected
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
                                                        @if($education->id == $vacancy->description->education_id) selected
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
                                                        @if($experience->id == $vacancy->description->experience_id) selected
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
                                                   value="{{ $vacancy->description->company }}">
                                            <div class="valid-feedback">
                                                @lang('frontend.company') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('frontend.company') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('frontend.relevant-people') <span class="text-danger">*</span></label>
                                            <input name="relevant_people" class="form-control" required
                                                   value="{{ $vacancy->description->relevant_people }}">
                                            <div class="valid-feedback">
                                                @lang('frontend.relevant-people') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('frontend.relevant-people') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-6">
                                            <label>@lang('backend.email') <span class="text-danger">*</span></label>
                                            <input name="email" class="form-control"
                                                   value="{{ $vacancy->description->email }}"
                                                   required>
                                            <div class="valid-feedback">
                                                @lang('frontend.email') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('frontend.email') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                            <input name="phone" class="form-control"
                                                   value="{{ $vacancy->description->phone }}"
                                                   required>
                                            <div class="valid-feedback">
                                                @lang('frontend.phone') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('frontend.phone') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('frontend.candidate-requirements') <span
                                                class="text-danger">*</span></label>
                                        <textarea required id="elmaz1"
                                                  name="candidate_requirements">{!! $vacancy->description->candidate_requirement !!}</textarea>
                                        <div class="valid-feedback">
                                            @lang('frontend.candidate-requirements') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('frontend.candidate-requirements') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('frontend.about-job') <span class="text-danger">*</span></label>
                                        <textarea required id="elmaz2"
                                                  name="about_job">{!! $vacancy->description->job_description !!}</textarea>
                                        <div class="valid-feedback">
                                            @lang('frontend.about-job') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('frontend.about-job') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="TagifyBasic" class="form-label">@lang('backend.keywords')</label>
                                        <input id="TagifyBasic" class="form-control" name="tags"
                                               value="@foreach(vacancy_tags($vacancy->description->tags) as $tag)
                                                {{ $tag }}@if(!$loop->last),@endif
                                            @endforeach"/>
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

                    <div class="col-xl-4 ">
                        <div class="card">
                            <div class="card-body">
                                @if($vacancy->premium()->exists())
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                                <span class="text-warning">@lang('backend.premium')&nbsp;<i
                                                        class="fas fa-crown"></i></span>
                                            <h4 class="mb-sm-0">@lang('backend.currently-status'):
                                                <span
                                                    class="text-primary">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$vacancy->premium->end_time )->format('d-m-Y')}}</span>
                                            </h4>
                                        </div>
                                    </div>
                                @endif
                                @if($vacancy->premium()->exists())
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal" data-whatever="@mdo">
                                            <i class="fas fa-clock"></i>&nbsp;@lang('backend.get-time')</button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">@lang('backend.get-time')</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('backend.VacancyPremiumTime',$vacancy->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="recipient-name"
                                                                       class="col-form-label">@lang('backend.time')
                                                                    :</label>
                                                                <input type="text" name="time" value="30"
                                                                       class="form-control"
                                                                       id="recipient-name">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">
                                                                    @lang('backend.cancel')
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    @lang('backend.save')
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-danger text-white w-45"
                                           href="{{ route('backend.VacancyPremiumCancel',$vacancy->id) }}"><i
                                                class="fas fa-clock"></i>&nbsp;@lang('backend.cancel')</a>
                                    </div>
                                @else
                                    <a class="btn btn-warning text-white w-100"
                                       href="{{ route('backend.VacancyPremium',$vacancy->id) }}"><i
                                            class="fas fa-crown"></i>&nbsp;@lang('backend.get-premium')</a>
                                @endif
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
