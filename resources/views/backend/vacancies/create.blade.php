@extends('master.backend')
@section('title',__('backend.vacancies'))
@section('styles')
    <link rel="stylesheet" href="{{asset('user-assets/vendor/libs/tagify/tagify.css')}}"/>
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-8 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('backend.vacancies'): @lang('backend.add-new')</h4>
                                    </div>
                                </div>
                                <form action="{{ route('backend.vacancies.store') }}" method="POST"
                                      class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label>@lang('backend.position') <span class="text-danger">*</span></label>
                                        <input type="text" name="position" class="form-control" required=""
                                             >
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
                                                    <option
                                                        value="{{ $city->id }}">{{ $city->translate(app()->getLocale())->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label>@lang('backend.work-mode') <span class="text-danger">*</span></label>
                                            <select class="form-control" name="mode">
                                                @foreach($modes as $mode)
                                                    <option
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
                                                @foreach($salaries as $salary)
                                                    <option value="{{ $salary->id }}">{{ $salary->salary ?? '-' }}₼
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('backend.max-salary') <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="maximum_salary">
                                                @foreach($salaries as $salary)
                                                    <option value="{{ $salary->id }}">{{ $salary->salary ?? '-' }}₼
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
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('backend.max-age') <span class="text-danger">*</span></label>
                                            <select class="form-control" name="maximum_age">
                                                @for($i=65;$i>=18;$i--)
                                                    <option value="{{$i}}">{{$i}}</option>
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
                                                        value="{{$experience->id}}">{{ $experience->translate(app()->getLocale())->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-6">
                                            <label>@lang('frontend.company') <span class="text-danger">*</span></label>
                                            <input name="company" class="form-control" required >
                                            <div class="valid-feedback">
                                                @lang('frontend.company') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('frontend.company') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('frontend.relevant-people') <span class="text-danger">*</span></label>
                                            <input name="relevant_people" class="form-control" required >
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
                                            <input name="email" class="form-control" required>
                                            <div class="valid-feedback">
                                                @lang('frontend.email') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('frontend.email') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                            <input name="phone" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('frontend.candidate-requirements') <span class="text-danger">*</span></label>
                                        <textarea id="elmaz1" name="candidate_requirements" required></textarea>
                                        <div class="valid-feedback">
                                            @lang('frontend.candidate-requirements') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('frontend.candidate-requirements') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('frontend.about-job') <span class="text-danger">*</span></label>
                                        <textarea id="elmaz2" name="about_job" required></textarea>
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
                                               value="Vakansiya, İş elanları, Bakı"/>
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
@endsection
