@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mx-0 gy-3 px-lg-5">
            <div class="card mb-4">
                <h5 class="card-header">@lang('backend.post-an-ad')</h5>
                <form form class="needs-validation card-body" novalidate action="{{ route('user.item.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-username">@lang('backend.position')</label>
                            <input type="text" class="form-control" name="position" required
                                   placeholder="@lang('backend.position')"/>
                            {!! validation_m('backend.position') !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">@lang('backend.categories')</label>
                            <select  class="form-select" name="category" data-allow-clear="true" required>
                                <option value="">@lang('backend.categories')</option>
                                @foreach($categories as $category)
                                    <optgroup
                                        label="{{ $category->translate(app()->getLocale())->name ?? '-' }}">
                                        @foreach($category->alt()->get() as $altCategory)
                                            <option
                                                value="{{ $altCategory->id }}">{{ $altCategory->translate(app()->getLocale())->name ?? '-' }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            {!! validation_m('backend.categories') !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">@lang('backend.work-mode')</label>
                            <select  class="form-select" name="mode" data-allow-clear="true" required>
                                <option value="">@lang('backend.work-mode')</option>
                                @foreach($modes as $mode)
                                    <option
                                        value="{{ $mode->id }}">{{ $mode->translate(app()->getLocale())->name }}</option>
                                @endforeach
                            </select>
                            {!! validation_m('backend.work-mode') !!}
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">@lang('backend.cities')</label>
                            <select  name="city" class="form-select" data-allow-clear="true" required>
                                <option value="">@lang('backend.cities')</option>
                                @foreach($cities as $city)
                                    <option
                                        value="{{ $city->id }}">{{ $city->translate(app()->getLocale())->name }}</option>
                                @endforeach
                            </select>
                            {!! validation_m('backend.city') !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">@lang('backend.experience')</label>
                            <select class="form-select" name="experience" required data-allow-clear="true">
                                <option value="">@lang('backend.experience')</option>
                                @foreach($experiences as $experience)
                                    <option
                                        value="{{ $experience->id }}">{{ $experience->translate(app()->getLocale())->name }}</option>
                                @endforeach
                            </select>
                            {!! validation_m('backend.experience') !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">@lang('backend.education')</label>
                            <select name="education" class="form-select" data-allow-clear="true" required>
                                <option value="">@lang('backend.education')</option>
                                @foreach($educations as $education)
                                    <option
                                        value="{{ $education->id }}">{{ $education->translate(app()->getLocale())->name }}</option>
                                @endforeach
                            </select>
                            {!! validation_m('backend.education') !!}
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">@lang('backend.min-age')</label>
                            <select  class="form-select"  data-allow-clear="true" name="minimum_age" required>
                                <option value="">@lang('backend.min-age')</option>
                                @for($i=18;$i<66;$i++)
                                    <option
                                        value="{{ $i }}">{{ $i }} @lang('backend.age')</option>
                                @endfor
                            </select>
                            {!! validation_m('backend.min-age') !!}
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">@lang('backend.max-age')</label>
                            <select required name="maximum_age" class="form-select" data-allow-clear="true">
                                <option value="">@lang('backend.max-age')</option>
                                @for($i=65;$i>18;$i--)
                                    <option
                                        value="{{ $i }}">{{ $i }} @lang('backend.age')</option>
                                @endfor
                            </select>
                            {!! validation_m('backend.max-age') !!}
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">@lang('backend.min-salary')</label>
                            <select required name="minimum_salary" class="form-select" data-allow-clear="true">
                                <option value="">@lang('backend.min-salary')</option>
                                @foreach($salaries as $salary)
                                    <option
                                        value="{{ $salary->id }}">{{ $salary->salary }} ₼
                                    </option>
                                @endforeach
                            </select>
                            {!! validation_m('backend.min-salary') !!}
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">@lang('backend.max-salary')</label>
                            <select required name="maximum_salary" class="form-select" data-allow-clear="true">
                                <option value="">@lang('backend.max-salary')</option>
                                @foreach($salaries as $salary)
                                    <option
                                        value="{{ $salary->id }}">{{ $salary->salary }} ₼
                                    </option>
                                @endforeach
                            </select>
                            {!! validation_m('backend.max-salary') !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">@lang('frontend.about-job')</label>
                            <textarea id="elm1" rows="7"
                                      name="about_job"
                                      required
                                      class="form-control"></textarea>
                            {!! validation_m('frontend.about-job') !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"
                                  >@lang('frontend.candidate-requirements')</label>
                            <textarea id="elm2" rows="7"
                                      name="candidate_requirements"
                                      required
                                      class="form-control"></textarea>
                            {!! validation_m('frontend.candidate-requirements') !!}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="multicol-email">@lang('backend.email')</label>
                                <input type="text" id="multicol-email" class="form-control" name="email" required
                                       placeholder="example@site.com"/>
                            {!! validation_m('backend.email') !!}
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="multicol-phone">@lang('backend.phone')</label>
                            <input type="text" class="form-control phone-mask" name="phone" required
                                   placeholder="+994 50 000 0510"/>
                            {!! validation_m('backend.phone') !!}
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="multicol-phone">@lang('frontend.relevant-people')</label>
                            <input type="text" name="relevant_people"
                                   class="form-control" required
                                   placeholder="@lang('frontend.relevant-people')"/>
                            {!! validation_m('frontend.relevant-people') !!}
                        </div>

                        <div class="col-12 mb-4">
                            <label for="TagifyBasic" class="form-label">@lang('backend.keywords')</label>
                            <input id="TagifyBasic" class="form-control" name="name"
                                   value="Vakansiya, İş elanları, Bakı"/>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">@lang('backend.save')</button>
                            <button type="reset" class="btn btn-label-secondary">@lang('backend.cancel')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('user-assets/js/form-validation.js')}}"></script>
    <script src="{{asset('user-assets/js/forms-extras.js')}}"></script>
    <script src="{{asset('user-assets/vendor/libs/autosize/autosize.js')}}"></script>
    <script src="{{asset('backend/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/form-editor.init.js')}}"></script>
@endsection
