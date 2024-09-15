@extends('layouts.master')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">Layanan Akademik</h4>
        <h6 class="box-subtitle">Form Surat Izin PKL</h6>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col">
                <form novalidate>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <h5>Nama <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nama" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Tempat Lahir <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="tempat_lahir" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Tanggal Lahir <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="tgl_lahir" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Tanggal Mulai PKL <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="tgl_mulai_pkl" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Tanggal Selesai PKL <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="tgl_Selesai_pkl" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>No Handphone <span class="text-danger">*</span></h5>
                                <input type="number" name="no_hp" class="form-control" required data-validation-required-message="This field is required" max="12">
                                <div class="form-control-feedback">
                                    <small><i>Harus Kurang Dari 12 Angka</i></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Alamat Tinggal Saat Ini <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea name="alamat" id="textarea" class="form-control" required placeholder="Masukkan Alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Nama Tempat PKL <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nama_tempat_pkl" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Bidang Kerja <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="bidang_kerja" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Jurusan <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="jurusan" id="select" required class="form-select">
                                        <option value="">Teknik Komputer jaringan</option>
                                        <option value="1">Rekayasa Perangkat Lunak</option>
                                        <option value="2">Multimedia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <a href="" class="btn btn-info">Submit</a>
                            <a class="btn btn-danger" href="/layananAkademik">Kembali</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection