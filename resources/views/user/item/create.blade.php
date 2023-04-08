@extends('master.user')
@section('user-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mx-0 gy-3 px-lg-5">
            <div class="card mb-4">
                <h5 class="card-header">@lang('backend.post-an-ad')</h5>
                <form class="card-body" action="{{ route('user.item.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-username">@lang('backend.position')</label>
                            <input type="text" class="form-control" name="position"
                                   placeholder="@lang('backend.position')"/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-country">@lang('backend.categories')</label>
                            <select id="multicol-country" class="form-select" data-allow-clear="true">
                                <option>@lang('backend.categories')</option>
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
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="multicol-country">@lang('backend.work-mode')</label>
                            <select id="multicol-country" class="form-select" data-allow-clear="true">
                                <option>@lang('backend.work-mode')</option>
                                @foreach($modes as $mode)
                                    <option
                                        value="{{ $mode->id }}">{{ $mode->translate(app()->getLocale())->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="multicol-country">@lang('backend.cities')</label>
                            <select id="multicol-country" class="form-select" data-allow-clear="true">
                                <option>@lang('backend.cities')</option>
                                @foreach($cities as $city)
                                    <option
                                        value="{{ $city->id }}">{{ $city->translate(app()->getLocale())->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label" for="multicol-country">@lang('backend.experience')</label>
                            <select id="multicol-country" class="form-select" data-allow-clear="true">
                                <option>@lang('backend.experience')</option>
                                @foreach($experiences as $experience)
                                    <option
                                        value="{{ $experience->id }}">{{ $experience->translate(app()->getLocale())->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="multicol-country">@lang('backend.education')</label>
                            <select id="multicol-country" class="form-select" data-allow-clear="true">
                                <option>@lang('backend.education')</option>
                                @foreach($educations as $education)
                                    <option
                                        value="{{ $education->id }}">{{ $education->translate(app()->getLocale())->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="multicol-country">@lang('backend.min-age')</label>
                            <select id="multicol-country" class="form-select" data-allow-clear="true">
                                <option>@lang('backend.min-age')</option>
                                @for($i=18;$i<100;$i++)
                                    <option
                                        value="{{ $i }}">{{ $i }} @lang('backend.age')</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="multicol-country">@lang('backend.max-age')</label>
                            <select id="multicol-country" class="form-select" data-allow-clear="true">
                                <option>@lang('backend.max-age')</option>
                                @for($i=18;$i<100;$i++)
                                    <option
                                        value="{{ $i }}">{{ $i }} @lang('backend.age')</option>
                                @endfor
                            </select>
                        </div>


                        <div class="col-md-3">
                            <label class="form-label" for="multicol-country">@lang('backend.min-salary')</label>
                            <select id="multicol-country" class="form-select" data-allow-clear="true">
                                <option>@lang('backend.min-salary')</option>
                                @foreach($salaries as $salary)
                                    <option
                                        value="{{ $salary->id }}">{{ $salary->salary }} ₼
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="multicol-country">@lang('backend.max-salary')</label>
                            <select id="multicol-country" class="form-select" data-allow-clear="true">
                                <option>@lang('backend.max-salary')</option>
                                @foreach($salaries as $salary)
                                    <option
                                        value="{{ $salary->id }}">{{ $salary->salary }} ₼
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label" for="multicol-country">@lang('frontend.about-job')</label>
                            <textarea id="elm1" rows="7"
                                      name="about"
                                      class="form-control"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"
                                   for="multicol-country">@lang('frontend.candidate-requirements')</label>
                            <textarea id="elm2" rows="7"
                                      name="about"
                                      class="form-control"></textarea>
                        </div>


                        <div class="col-md-4">
                            <label class="form-label" for="multicol-email">@lang('backend.email')</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="multicol-email" class="form-control"
                                       placeholder="example@site.com"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="multicol-phone">@lang('backend.phone')</label>
                            <input type="text" id="multicol-phone" class="form-control phone-mask"
                                   placeholder="+994 50 000 0510"/>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="multicol-phone">@lang('frontend.relevant-people')</label>
                            <input type="text" name="relevant_people" id="multicol-phone"
                                   class="form-control phone-mask"
                                   placeholder="@lang('frontend.relevant-people')"/>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="TagifyBasic" class="form-label">@lang('backend.keywords')</label>
                            <input id="TagifyBasic" class="form-control" name="TagifyBasic"
                                   value="Vakansiya, İş elanları, Bakı"/>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">@lang('backend.save')</button>
                            <button type="reset" class="btn btn-label-secondary">@lang('backend.cancel')</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('user-assets/js/forms-extras.js')}}"></script>
    <script src="{{asset('user-assets/vendor/libs/autosize/autosize.js')}}"></script>
    <script src="{{asset('backend/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/form-editor.init.js')}}"></script>
@endsection
