<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{ asset('backend/mail/email.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        * {
            box-sizing: border-box;

        }

        img {
            width: 322px;
        }

        p {
            font-size: 21px;
        }

        body {
            background-color: #f4f4f4;
            font-family: Roboto, arial, sans-serif;
        }

        .background {
            background-color: #35b8e8;
            height: 250px;
        }

        .email {
            /* width: 750px;
            height: 400px;  */
            background-color: white;
            margin: -80px auto 0 auto;
            padding: 20px 40px 80px 40px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .emailconf {
            font-size: 50px;
            font-weight: 500;
            margin-top: 30px;
            text-align: center;
        }

        .box {
            box-sizing: border-box;
            width: 100%;
        }

        span {
            color: #35b8e8;
        }

        button {
            width: 273px;
            height: 95px;
            font-size: 24px !important;

        }

        .welcome {
            font-size: 18px;
            text-align: left;
            font-size: 30px;
            margin-top: 100px;
            bottom: 0em;
            color: white;
            padding: 20px;
            background: #fdab44;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;

        }

        .welcome p {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
<div class="background">
</div>
<div class="container">
    <div class="row rounded">
        <div class="col-md-12">
            <div class="email">
                <div class="emailconf d-flex justify-content-center">
                    <img src="{{ asset('backend/images/logo.png') }}"></div>
                <br/>
                <p>Hörmətli, <span>{{ $name }}</span></p>
                <div class="box">
                    <br/>
                    <p>Sifrenizi sifirlamaq ucun linke klikleyin</p>
                    <br/>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <form method="">
                                    <button class="btn btn-primary">{{ $reset_token }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded col-md-12 welcome mt-4 mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <a href="">Daha çox köməyə ehtiyacınız var?</a>
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
