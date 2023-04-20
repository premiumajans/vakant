<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="./css/email.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
{{ dd($data) }}
<body>
<div class="background">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="email">
                <div class="emailconf"><img src="https://i.ibb.co/Jz4w83j/vakant.png" alt=""></div>
                <br/>
                <p>@lang('backend.dear'), <span>{{ $data['name'] }}</span></p>
                <div class="box">
                    <br/>
                    <p>Salam</p>
                    <br/>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <a href="{{ route('api.resetPassword',$data['token']) }}" class="btn btn-primary">@lang('backend.send')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-md-12 welcome mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            Nese
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            imtina et
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</html>
