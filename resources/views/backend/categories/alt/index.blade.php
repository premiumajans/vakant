@extends('master.backend')
@section('title',__('backend.alt-categories'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="d-sm-flex align-items-center justify-content-between">
                                        <h4 class="card-title">@lang('backend.alt-categories'):</h4>
                                        <a href="{{ route('backend.alt-categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                            &nbsp;@lang('backend.add-new')
                                        </a>
                                    </div>
                                </div>
                                <p class="card-title-desc"></p>
                                <div id="accordion" class="custom-accordion">
                                    @foreach($categories as $category)
                                        <div class="card mb-1 shadow-none">
                                            <a href="#Collapse{{$category->id}}" class="text-dark collapsed"
                                               data-bs-toggle="collapse" aria-expanded="false"
                                               aria-controls="Collapse{{ $category->id }}">
                                                <div class="card-header" id="headingOne">
                                                    <h6 class="m-0">
                                                        # {{ $category->translate('az')->name }}
                                                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                                    </h6>
                                                </div>
                                            </a>
                                            <div id="Collapse{{$category->id}}" class="collapse"
                                                 aria-labelledby="headingOne"
                                                 data-bs-parent="#accordion" style="">
                                                <div class="card-body">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">@lang('backend.alt-categories')</h4>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped mb-0">

                                                                        <thead>
                                                                        <tr>
                                                                            <th>#ID</th>
                                                                            @foreach(active_langs() as $lang)
                                                                                <th>@lang('backend.name')
                                                                                    ({{$lang->code}})
                                                                                </th>
                                                                            @endforeach
                                                                            <th>@lang('backend.time')</th>
                                                                            <th>@lang('backend.actions')</th>

                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach(\App\Models\AltCategory::where('category_id',$category->id)->get() as $alt)
                                                                            <tr>
                                                                                <th scope="row">{{ $alt->id }}</th>
                                                                                @foreach(active_langs() as $lang)
                                                                                    <th>
                                                                                        {{ $alt->translate($lang->code)->name ?? '-'}}
                                                                                    </th>
                                                                                @endforeach
                                                                                <td>{{ date('d.m.Y H:i:s',strtotime($category->created_at)) }}</td>
                                                                                <td class="text-center">
                                                                                    <a class="btn btn-primary"
                                                                                       href={{ route('backend.alt-categories.edit',['alt_category'=>$category->id]) }}>
                                                                                        <i class="fas fa-edit"></i>
                                                                                    </a>
                                                                                    <a class="btn btn-danger"
                                                                                       href="{{ route('backend.delAltCategory',['id'=>$alt->id]) }}">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </a>
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
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
