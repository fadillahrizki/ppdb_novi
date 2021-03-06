<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
</head>

<body>
    <div class="container">
        <form method="post" class="row">
            @csrf
            <div class="col-md-12 mt-5">
                <h2>PPDB</h2>
                <div id="stepper1" class="bs-stepper">
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#step-content-1">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Informasi Kontak</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-content-2">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Informasi Siswa</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-content-3">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Pembayaran</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="step-content-1" class="content">

                            <div class="card card-body">
                                @if(Session::has('sms'))

                                <span class="alert {{Session::get('sms')->ok() ? 'alert-success' : 'alert->danger'}}">{{Session::get('sms')->message()}}</span>

                                @endif

                                @if(Session::has('verification'))

                                <span class="alert {{Session::get('verification')->ok() ? 'alert-success' : 'alert->danger'}}">{{Session::get('verification')->message()}}</span>
                                <input type="hidden" name="verificated" value="true">

                                @endif

                                <div class="form-group">
                                    <label for="">Nama Pendaftar</label>
                                    <input type="text" name="nama_pendaftar" value="{{Session::get('request') ? Session::get('request')['nama_pendaftar'] : ''}}" value="{{Session::get('request') ? Session::get('request')['nama_pendaftar'] : ''}}" <?= Session::get('request') ? 'readonly' : '' ?> class=" form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor WA</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input type="text" name="no_wa" value="{{Session::get('request') ? Session::get('request')['no_wa'] : ''}}" <?= Session::get('request') ? 'readonly' : '' ?> class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="{{Session::get('request') ? Session::get('request')['email'] : ''}}" <?= Session::get('request') ? 'readonly' : '' ?> class="form-control">
                                </div>
                                @if(Session::has('user_sms'))
                                <div class="form-group">
                                    <label for="">Kode OTP</label>
                                    <input type="text" name="otp" class="form-control">
                                </div>
                                <input type="hidden" name="user_sms" value="{{Session::get('user_sms')->id()}}">
                                @endif
                            </div>

                            <hr>

                            @if(!Session::has('verification'))

                            @if(Session::has('sms'))

                            <button class="btn btn-primary">Verifikasi</button>

                            @else

                            <button class="btn btn-primary">Kirim OTP</button>

                            @endif
                            @else

                            <button type="button" class="btn btn-primary" onclick="stepper1.next()">Next</button>

                            @endif
                        </div>
                        <div id="step-content-2" class="content">
                            <div class="card card-body">
                                <div class="form-group">
                                    <label for="">Nama Calon Siswa</label>
                                    <input type="text" name="nama_calon_siswa" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck" onchange="checkPendaftar(this)">
                                        <label class="form-check-label" for="gridCheck">
                                            Sama Dengan Pendaftar
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Alumni PP Al Hikmah 2 ?</label>
                                    <select name="alumni" class="form-control" onchange="checkAlumni(this)">
                                        <option value="-" selected disabled>- Pilih Jawaban -</option>
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                    </select>
                                </div>
                                <div class="form-group d-none" id="sebut_nama_sekolah">
                                    <label for="">Sebutkan Nama Sekolah</label>
                                    <input type="text" name="sebutkan_nama_sekolah" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Domisili</label>
                                    <select name="domisili" class="form-control" onchange="checkDomisili(this)">
                                        <option value="-" selected disabled>- Pilih Domisili -</option>
                                        <option value="Warga Benda">Warga Benda</option>
                                        <option value="Bukan Warga Benda">Bukan Warga Benda</option>
                                    </select>
                                </div>
                                <div class="form-group d-none" id="ketik_alamat">
                                    <label for="">Ketik alamat</label>
                                    <textarea name="alamat" rows="5" class="form-control"></textarea>
                                </div>
                            </div>

                            <hr>
                            <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="stepper1.next()">Next</button>
                        </div>
                        <div id="step-content-3" class="content">

                            <div class="card">
                                <div class="card-header bg-info text-white d-flex justify-content-between">
                                    <h5>Transfer Manual</h5>
                                    <h5>Biaya : <b id="bp">Rp125.000,00</b></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Bank Tujuan</label>
                                        <select name="tipe_pembayaran" class="form-control">
                                            <option value="-" selected disabled>- Pilih Bank -</option>
                                            <option value="BCA">Bank BCA</option>
                                            <option value="BRI">Bank BRI</option>
                                            <option value="BNI">Bank BNI</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="biaya_pembayaran" value="125.000">
                                </div>
                            </div>

                            <hr>

                            <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

    <script>
        var stepper1 = new Stepper(document.querySelector('#stepper1'))

        function checkPendaftar(el) {
            var pendaftar = $("input[name=nama_pendaftar]");
            var calon_siswa = $("input[name=nama_calon_siswa]");
            if (el.checked) {
                calon_siswa.val(pendaftar.val())
                calon_siswa.attr('readonly', true)
            } else {
                calon_siswa.val('')
                calon_siswa.attr('readonly', false)
            }
        }

        function checkAlumni(el) {
            var sebut = $("#sebut_nama_sekolah")
            var biaya = $("input[name='biaya_pembayaran']")
            var bp = $("#bp")

            var domisili = $("input[name='domisili']")

            if (el.value !== "Ya") {
                sebut.removeClass("d-none")
            } else {
                sebut.find("input").val("PP Al Hikmah 2")
                sebut.addClass("d-none")
            }

            if (el.value == "Ya" || domisili.val() == "Warga Benda") {
                biaya.val("95000")
                bp.html("Rp95.000")
            } else {
                biaya.val("125000")
                bp.html("Rp125.000")
            }
        }

        function checkDomisili(el) {
            var alamat = $("#ketik_alamat")
            var biaya = $("input[name='biaya_pembayaran']")
            var bp = $("#bp")

            var alumni = $("input[name='alumni']")

            if (el.value == "Warga Benda" || alumni.val() == "Ya") {
                biaya.val("95000")
                bp.html("Rp95.000")
            } else {
                biaya.val("125000")
                bp.html("Rp125.000")
            }

            alamat.removeClass("d-none")
        }
    </script>
</body>

</html>