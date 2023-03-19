@extends('master.frontend')
@section('styles')
    <link rel="stylesheet" href="{{asset('user-assets/vendor/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('user-assets/vendor/libs/tagify/tagify.css')}}"/>
    <link rel="stylesheet" href="{{asset('user-assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}"/>
@endsection
@section('front')
    <section class="ftco-section bg-light">
        <div class="container">
            <form action="{{ route('frontend.storeVacancy') }}" id="secondForm" method="POST" class="p-5 bg-white">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="p-4 mb-3 bg-white">
                            <div class="row form-group mb-4">
                                <div class="col-md-12"><h4>@lang('backend.phone'):</h4></div>
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <input type="text" name="phone" id="phone"
                                           class="form-control" name="phone"
                                           placeholder="+994 50 000 0510" required>
                                </div>
                            </div>
                            <div class="row form-group mb-4">
                                <div class="col-md-12"><h4>@lang('backend.email'):</h4></div>
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <input type="email" id="email" name="email" class="form-control"
                                           placeholder="example@site.com">
                                </div>
                            </div>

                            <div class="row form-group d-flex justify-content-center align-items-center">
                                <a id="checkButton" class="btn btn-primary">@lang('frontend.continue')</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8 mb-5 disabledbutton" id="second">
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold tb">@lang('backend.position')</label>
                                <input type="text" name="position" class="form-control"
                                       placeholder="@lang('backend.position')">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold tb">@lang('backend.categories')</label>
                                <select name="category" class="form-control">
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
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0 ">
                                <label
                                    class="font-weight-bold tb">@lang('backend.min-salary')</label>
                                <select name="minimum_salary" class="form-control">
                                    @foreach($salaries as $salary)
                                        <option
                                            value="{{ $salary->id }}">{{ $salary->salary ?? '-' }} ₼
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label
                                    class="font-weight-bold tb">@lang('backend.max-salary')</label>
                                <select name="maximum_salary" class="form-control">
                                    @foreach($salaries as $salary)
                                        <option
                                            value="{{ $salary->id }}">{{ $salary->salary ?? '-' }} ₼
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0 ">
                                <label
                                    class="font-weight-bold tb">@lang('backend.min-age')</label>
                                <select name="minimum_age" class="form-control">
                                    @for($i=18;$i<100;$i++)
                                        <option
                                            value="{{ $i }}">{{ $i }} @lang('backend.age')
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label
                                    class="font-weight-bold tb">@lang('backend.max-age')</label>
                                <select name="maximum_age" class="form-control">
                                    @for($i=18;$i<100;$i++)
                                        <option
                                            value="{{ $i }}">{{ $i }} @lang('backend.age')
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0 ">
                                <label class="font-weight-bold tb">@lang('backend.education')</label>
                                <select name="education" class="form-control">
                                    <option value="">@lang('backend.education')</option>
                                    @foreach($educations as $education)
                                        <option
                                            value="{{ $education->id }}">{{ $education->translate(app()->getLocale())->name ?? '-' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="font-weight-bold tb">@lang('backend.experience')</label>
                                <select name="experience" class="form-control">
                                    <option value="">@lang('backend.experience')</option>
                                    @foreach($experiences as $experience)
                                        <option
                                            value="{{ $experience->id }}">{{ $experience->translate(app()->getLocale())->name ?? '-' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold tb">@lang('backend.cities')</label>
                                <select name="city" class="form-control">
                                    <option>@lang('backend.cities')</option>
                                    @foreach($cities as $city)
                                        <option
                                            value="{{ $city->id }}">{{ $city->translate(app()->getLocale())->name ?? '-' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold tb">@lang('frontend.company')</label>
                                <input type="text" name="company" class="form-control"
                                       placeholder="@lang('frontend.company')">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold tb">@lang('backend.work-mode')</label>
                                <select name="work-mode" class="form-control">
                                    <option>@lang('backend.work-mode')</option>
                                    @foreach($modes as $mode)
                                        <option
                                            value="{{ $mode->id }}">{{ $mode->translate(app()->getLocale())->name ?? '-' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group mb-4">
                            <div class="col-md-12"><label
                                    class="font-weight-bold tb">@lang('frontend.relevant-people')</label></div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <input type="text" name="relevant_people" class="form-control"
                                       placeholder="@lang('frontend.relevant-people')">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12"><label
                                    class="font-weight-bold tb">@lang('frontend.candidate-requirements')</label></div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <textarea class="form-control" name="candidate_requirements" id="elm1" cols="30"
                                          rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12"><label
                                    class="font-weight-bold tb">@lang('frontend.about-job')</label></div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <textarea class="form-control" name="about_job" id="elm2" cols="30"
                                          rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <label for="TagifyBasic" class="font-weight-bold tb">@lang('backend.keywords')</label>
                            <input id="TagifyBasic" class="form-control" name="tags"
                                   value="Vakansiya, İş elanları, Bakı"/>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="@lang('frontend.post-a-vacancy')"
                                       class="btn btn-primary  py-2 px-5">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $('#checkButton').on('click', function (event) {
                let email = $('#email').val();
                let phone = $('#phone').val()
                $.ajax({
                    url: "{{ route('user.checkUser') }}",
                    method: "POST",
                    data: {'email': email, 'phone': phone},
                    success: function (data) {
                        $("#second").removeClass('disabledbutton');
                    },
                    error: function (error) {
                        if(Object.keys(error.responseJSON.errors).length == 2){
                            Swal.fire(
                                {
                                    icon: 'error',
                                    title:"{{ __('errors.email-phone-error') }}",
                                    confirmButtonText: "{{ __('backend.try-again') }}"
                                },
                            )
                        }
                        if(Object.keys(error.responseJSON.errors).length == 1){
                            if("email" in error.responseJSON.errors){
                                if(error.responseJSON.errors.email == "validation.unique"){
                                    Swal.fire(
                                        {
                                            icon: 'error',
                                            title:"{{ __('errors.email-validation-unique') }}",
                                            confirmButtonText: "{{ __('backend.try-again') }}"
                                        },
                                    )
                                }
                                if(error.responseJSON.errors.email == "validation.required"){
                                    Swal.fire(
                                        {
                                            icon: 'error',
                                            title:"{{ __('errors.email-validation-required') }}",
                                            confirmButtonText: "{{ __('backend.try-again') }}"
                                        },
                                    )
                                }
                            }
                            if("phone" in error.responseJSON.errors){
                                if(error.responseJSON.errors.phone == "validation.unique"){
                                    Swal.fire(
                                        {
                                            icon: 'error',
                                            title:"{{ __('errors.phone-validation-unique') }}",
                                            confirmButtonText: "{{ __('backend.try-again') }}"
                                        },
                                    )
                                }
                                if(error.responseJSON.errors.phone == "validation.required"){
                                    Swal.fire(
                                        {
                                            icon: 'error',
                                            title:"{{ __('errors.phone-validation-required') }}",
                                            confirmButtonText: "{{ __('backend.try-again') }}"
                                        },
                                    )
                                }
                            }
                        }
                    }
                })
            });
        });
    </script>
    <script src="{{asset('backend/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/form-editor.init.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="{{asset('user-assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('user-assets/vendor/libs/tagify/tagify.js')}}"></script>
    <script src="{{asset('user-assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('user-assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
    <script src="{{asset('user-assets/js/forms-selects.js')}}"></script>
    <script src="{{asset('user-assets/js/forms-tagify.js')}}"></script>
    <script src="{{asset('user-assets/js/forms-typeahead.js')}}"></script>
@endsection

