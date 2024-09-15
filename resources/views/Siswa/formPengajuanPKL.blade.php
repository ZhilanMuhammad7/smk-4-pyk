@extends('layouts.master')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">Form Pengajuan PKL</h4>
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
                                    <input type="text" name="nama" class="form-control" required data-validation-required-message="This field is required" value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Jurusan <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="jurusan" id="select" class="form-select" required data-validation-required-message="This field is required">
                                        <option value="Teknik Komputer jaringan">Teknik Komputer jaringan</option>
                                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                        <option value="Multimedia">Multimedia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Nama Tempat Magang<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nama_tempat_pkl" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Tanggal Mulai PKL<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="tgl_mulai_pkl" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Tanggal Selesai PKL<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="tgl_mulai_pkl" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <a href="" class="btn btn-info">Submit</a>
                            <a class="btn btn-danger" href="/pengajuanPKL">Kembali</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection