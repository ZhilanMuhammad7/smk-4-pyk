<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}">

    <title>SMKN 4 Payakumbuh</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{asset('assets/css/vendors_css.css')}}">

    <!-- Style-->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/skin_color.css')}}">

</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-1.jpg)">

    <section class="py-20">
        <div class="container">
            <div class="row justify-content-center g-0">
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="box box-body">
                        <div class="content-top-agile p-20 pb-0">
                            <h3 class="">Selamat Datang Di Website SIMPALA SMKN 4 Payakumbuh</h3>
                            <span class="light-logo"><img src="{{asset('assets/images/smk4.jpeg')}}" alt="logo"></span>
                        </div>
                        <div class="p-40">
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger mt-3" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                            <form class="m-login__form m-form" action="{{route('auth.postRegister')}}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="user_id">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                        <input type="text" name="name" class="form-control ps-15 bg-transparent" placeholder="Nama Lengkap">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                        <input type="text" name="username" class="form-control ps-15 bg-transparent" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-transparent"><i class=" ti-id-badge"></i></span>
                                        <input type="text" name="nisn" class="form-control ps-15 bg-transparent" placeholder="NISN/NIP">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                                        <input type="text" name="email" class="form-control ps-15 bg-transparent" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                                        <input type="password" name="password" class="form-control ps-15 bg-transparent" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <select name="jurusan" id="select" class="form-select" required data-validation-required-message="This field is required">
                                            <option value="">--- Pilih Jurusan ---</option>
                                            <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                            <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                            <option value="Multimedia">Multimedia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-info">DAFTAR</button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center">
                                <p class="mt-15 mb-0">Sudah Punya Akun? <a href="{{route('auth.login')}}" class="text-warning ms-5">Masuk</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Vendor JS -->
    <script src="{{asset('assets/js/vendors.min.js')}}"></script>
    <script src="{{asset('assets/corenav-master/coreNavigation-1.1.3.js')}}"></script>
    <script src="{{asset('assets/js/nav.js')}}"></script>
    <script src="{{asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>

    <!-- EduAdmin front end -->
    <script src="{{asset('assets/js/template.js')}}"></script>
</body>

</html>