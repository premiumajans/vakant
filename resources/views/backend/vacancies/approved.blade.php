@extends('master.backend')
@section('title',__('backend.approved-vacancies'))
@section('styles')
    @include('backend.templates.components.dt-styles')
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@lang('backend.approved-vacancies'):</h4>
                                <a href="{{ route('backend.vacancies.create') }}" class="btn btn-primary mb-3"><i
                                        class="fas fa-plus"></i> &nbsp;@lang('backend.add-new')
                                </a>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('frontend.company'):</th>
                                <th>@lang('backend.position'):</th>
                                <th>@lang('backend.email'):</th>
                                <th>@lang('backend.phone'):</th>
                                <th>@lang('backend.actions'):</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vacancies as $vacancy)
                                <tr>
                                    <td class="text-center">{{ $vacancy->id }}</td>
                                    <td class="text-center">{{ $vacancy->description->company ?? '-' }}</td>
                                    <td class="text-center">{{ $vacancy->description->position ?? '-' }}</td>
                                    <td>
                                        <a href="mailto:{{ $vacancy->description->email ?? '-'}}">{{ $vacancy->description->email ?? '-'}}</a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $vacancy->description->phone ?? '-' }}">{{ $vacancy->description->phone ?? '-'}}</a>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                <li>
                                                    <a class="dropdown-item active"
                                                       href="{{ route('backend.VacancyPremium',$vacancy->id) }}">@lang('backend.get-premium')</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item active"
                                                       href="{{ route('backend.VacancyPremiumCancel',$vacancy->id) }}">@lang('backend.premium')&nbsp;@lang('backend.cancel')</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item active"
                                                       href="{{ route('backend.vacancies.edit',$vacancy->id) }}">@lang('backend.edit')</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger"
                                                       href="{{ route('backend.vacanciesDelete',$vacancy->id) }}">@lang('backend.delete')</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.dt-scripts')
@endsection
