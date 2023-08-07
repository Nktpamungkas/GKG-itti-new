<style>
    .input-xs {
        height: 22px;
        padding: 2px 5px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="form-group row">
                    <label for="Hadir" class="col-sm-1 col-form-label text-center">Tgl Laporan :</label>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm datepicker" name="tgl_laporan" id="tgl_laporan" placeholder="Tgl Laporan..." autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button" id="generate"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                    <a href="" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i></a>
                    <button id="print" class="btn btn-danger btn-sm pull-right" style="margin-right: 20px; font-weight: bold; display: none;">PRINT <i class="fa fa-print"></i></button>
                    <button type="button" id="hold" class="btn btn-sm btn-info pull-right text-black" style="margin-right: 20px; font-weight: bold; display: none;">SIMPAN <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <form method="post" action="javascript:void(0)">
                    <!-- SHIFT 1 -->
                    <div class="col-md-4" style="border-right: solid gray 1px;">
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-6 col-form-label" style="border-bottom: solid gray 1px;">ABSENSI SHIFT 1 : </label></h4>
                            <div class="col-md-6">
                                <input type="text" id="group_s1" oninput="this.value = this.value.toUpperCase()" class="form-control input-sm" maxlength="1" placeholder="Group..." value="">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="absensi" class="col-sm-3 col-form-label text-right">Absensi :</label>
                            <div class="col-sm-6">
                                <input required readonly type="text" class="form-control input-xs" value="0" name="absensi_s1" id="absensi_s1" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Hadir" class="col-sm-3 col-form-label text-right">Hadir :</label>
                            <div class="col-sm-6">
                                <input required readonly type="text" class="form-control input-xs" value="0" name="hadir_s1" id="hadir_s1" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Sakit" class="col-sm-3 col-form-label text-right">Sakit :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="sakit_s1" id="sakit_s1" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Mangkir" class="col-sm-3 col-form-label text-right">Mangkir :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="mangkir_s1" id="mangkir_s1" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Cuti" class="col-sm-3 col-form-label text-right">Cuti :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="cuti_s1" id="cuti_s1" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Libur" class="col-sm-3 col-form-label text-right">Libur :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="libur_s1" id="libur_s1" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Izin" class="col-sm-3 col-form-label text-right">Izin :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="izin_s1" id="izin_s1" placeholder="orang...">
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-12 col-form-label text-center" style="border-bottom: solid gray 1px;">PRODUKSI SHIFT 1</label></h4>
                        </div>
                        <div class=" form-group row">
                            <label for="Masuk" class="col-sm-3 col-form-label text-right">Masuk Kain :</label>
                            <div class="col-sm-7">
                                <input required type="text" class="form-control input-sm" name="masuk_kain_s1" id="masuk_kain_s1" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Pembagian" class="col-sm-3 col-form-label text-right">Bagi Kain :</label>
                            <div class="col-sm-7">
                                <input required type="text" class="form-control input-sm" name="pembagian_kain_s1" id="pembagian_kain_s1" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Buka" class="col-sm-3 col-form-label text-right">Buka Kain :</label>
                            <div class="col-sm-7">
                                <input required type="text" class="form-control input-sm" name="buka_kain_s1" id="buka_kain_s1" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Penyusunan" class="col-sm-3 col-form-label text-right">Penyusunan Kain :</label>
                            <div class="col-sm-7">
                                <textarea type="text" class="form-control" name="penyusunan_s1" id="penyusunan_s1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-12 col-form-label text-center" style="border-bottom: solid gray 1px;">MASALAH YANG TERJADI SHIFT 1</label></h4>
                        </div>
                        <div class=" form-group row">
                            <div class="col-sm-12">
                                <textarea required type="text" class="form-control" name="masalah_s1" id="masalah_s1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-12 col-form-label text-center" style="border-bottom: solid gray 1px;">LAIN-LAIN DIVISI GKG | CEK MESIN</label></h4>
                        </div>
                        <!-- left lain-lain -->
                        <div class="col-sm-6" style="border-right: solid gray 1px;">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Terima kain</label>
                                    <input required type="text" class="form-control input-xs" name="terima_kain_s1" id="terima_kain_s1" placeholder="Terima kain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Inspeksi</label>
                                    <input required type="text" class="form-control input-xs" name="inspeksi_s1" id="inspeksi_s1" placeholder="Inspeksi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Bagi Kain</label>
                                    <input type="text" class="form-control input-xs" name="bagi_kain_s1" id="bagi_kain_s1" placeholder="Bagi kain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Buka Kain</label>
                                    <input required type="text" class="form-control input-xs" name="bukakains1" id="bukakains1" placeholder="Buka kain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Leader</label>
                                    <input required type="text" class="form-control input-xs" name="leader_s1" id="leader_s1" placeholder="Leader">
                                </div>
                            </div>
                        </div>
                        <!-- right lain-lain -->
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_bk_s1" id="mc_bk_s1" placeholder="MC Buka ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_blk_s1" id="mc_blk_s1" placeholder="MC Balik ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_blh_s1" id="mc_blh_s1" placeholder="MC Belah ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_jhtpgr_s1" id="mc_jhtpgr_s1" placeholder="Jahit Pinggir ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Masalah Kehadiran</label>
                                    <textarea type="text" class="form-control" name="masalah_hadir_s1" id="masalah_hadir_s1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SHIFT 1 -->
                    <!-- SHIFT 2 -->
                    <div class="col-md-4" style="border-right: solid gray 1px;">
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-6 col-form-label" style="border-bottom: solid gray 1px;">ABSENSI SHIFT 2 : </label></h4>
                            <div class="col-md-6">
                                <input type="text" id="group_s2" oninput="this.value = this.value.toUpperCase()" class="form-control input-sm" maxlength="1" placeholder="Group..." value="">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="absensi" class="col-sm-3 col-form-label text-right">Absensi :</label>
                            <div class="col-sm-6">
                                <input required readonly type="text" class="form-control input-xs" value="0" name="absensi_s2" id="absensi_s2" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Hadir" class="col-sm-3 col-form-label text-right">Hadir :</label>
                            <div class="col-sm-6">
                                <input required readonly type="text" class="form-control input-xs" value="0" name="hadir_s2" id="hadir_s2" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Sakit" class="col-sm-3 col-form-label text-right">Sakit :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="sakit_s2" id="sakit_s2" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Mangkir" class="col-sm-3 col-form-label text-right">Mangkir :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="mangkir_s2" id="mangkir_s2" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Cuti" class="col-sm-3 col-form-label text-right">Cuti :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="cuti_s2" id="cuti_s2" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Libur" class="col-sm-3 col-form-label text-right">Libur :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="libur_s2" id="libur_s2" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Izin" class="col-sm-3 col-form-label text-right">Izin :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="izin_s2" id="izin_s2" placeholder="orang...">
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-12 col-form-label text-center" style="border-bottom: solid gray 1px;">PRODUKSI SHIFT 2</label></h4>
                        </div>
                        <div class=" form-group row">
                            <label for="Masuk" class="col-sm-3 col-form-label text-right">Masuk Kain :</label>
                            <div class="col-sm-7">
                                <input required type="text" class="form-control input-sm" name="masuk_kain_s2" id="masuk_kain_s2" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Pembagian" class="col-sm-3 col-form-label text-right">Bagi Kain :</label>
                            <div class="col-sm-7">
                                <input required type="text" class="form-control input-sm" name="pembagian_kain_s2" id="pembagian_kain_s2" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Buka" class="col-sm-3 col-form-label text-right">Buka Kain :</label>
                            <div class="col-sm-7">
                                <input required type="text" class="form-control input-sm" name="buka_kain_s2" id="buka_kain_s2" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Penyusunan" class="col-sm-3 col-form-label text-right">Penyusunan Kain :</label>
                            <div class="col-sm-7">
                                <textarea type="text" class="form-control" name="penyusunan_s2" id="penyusunan_s2"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-12 col-form-label text-center" style="border-bottom: solid gray 1px;">MASALAH YANG TERJADI SHIFT 2</label></h4>
                        </div>
                        <div class=" form-group row">
                            <div class="col-sm-12">
                                <textarea required type="text" class="form-control" name="masalah_s2" id="masalah_s2"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-12 col-form-label text-center" style="border-bottom: solid gray 1px;">LAIN-LAIN DIVISI GKG | CEK MESIN</label></h4>
                        </div>
                        <!-- left lain-lain -->
                        <div class="col-sm-6" style="border-right: solid gray 1px;">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Terima Kain</label>
                                    <input required type="text" class="form-control input-xs" name="terima_kain_s2" id="terima_kain_s2" placeholder="Terima kain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Inspeksi</label>
                                    <input required type="text" class="form-control input-xs" name="inspeksi_s2" id="inspeksi_s2" placeholder="Inspeksi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Bagi kain</label>
                                    <input type="text" class="form-control input-xs" name="bagi_kain_s2" id="bagi_kain_s2" placeholder="Bagi kain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Buka Kain</label>
                                    <input required type="text" class="form-control input-xs" name="bukakains2" id="bukakains2" placeholder="Buka kain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Leader</label>
                                    <input required type="text" class="form-control input-xs" name="leader_s2" id="leader_s2" placeholder="Leader">
                                </div>
                            </div>
                        </div>
                        <!-- right lain-lain -->
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_bk_s2" id="mc_bk_s2" placeholder="MC Buka ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_blk_s2" id="mc_blk_s2" placeholder="MC Balik ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_blh_s2" id="mc_blh_s2" placeholder="MC Belah ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_jhtpgr_s2" id="mc_jhtpgr_s2" placeholder="Jahit Pinggir ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Masalah Kehadiran</label>
                                    <textarea type="text" class="form-control" name="masalah_hadir_s2" id="masalah_hadir_s2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SHIFT 2 -->
                    <!-- SHIFT 3 -->
                    <div class="col-md-4">
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-6 col-form-label" style="border-bottom: solid gray 1px;">ABSENSI SHIFT 3 : </label></h4>
                            <div class="col-md-6">
                                <input type="text" id="group_s3" oninput="this.value = this.value.toUpperCase()" class="form-control input-sm" maxlength="1" placeholder="Group..." value="">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="absensi" class="col-sm-3 col-form-label text-right">Absensi :</label>
                            <div class="col-sm-6">
                                <input required readonly type="text" class="form-control input-xs" value="0" name="absensi_s3" id="absensi_s3" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Hadir" class="col-sm-3 col-form-label text-right">Hadir :</label>
                            <div class="col-sm-6">
                                <input required readonly type="text" class="form-control input-xs" value="0" name="hadir_s3" id="hadir_s3" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Sakit" class="col-sm-3 col-form-label text-right">Sakit :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="sakit_s3" id="sakit_s3" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Mangkir" class="col-sm-3 col-form-label text-right">Mangkir :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="mangkir_s3" id="mangkir_s3" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Cuti" class="col-sm-3 col-form-label text-right">Cuti :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="cuti_s3" id="cuti_s3" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Libur" class="col-sm-3 col-form-label text-right">Libur :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="libur_s3" id="libur_s3" placeholder="orang...">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Izin" class="col-sm-3 col-form-label text-right">Izin :</label>
                            <div class="col-sm-6">
                                <input required type="text" class="form-control input-xs" value="0" name="izin_s3" id="izin_s3" placeholder="orang...">
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-12 col-form-label text-center" style="border-bottom: solid gray 1px;">PRODUKSI SHIFT 3</label></h4>
                        </div>
                        <div class=" form-group row">
                            <label for="Masuk" class="col-sm-3 col-form-label text-right">Masuk Kain :</label>
                            <div class="col-sm-7">
                                <input type="text" value="0" class="form-control input-sm" name="masuk_kain_s3" id="masuk_kain_s3" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Pembagian" class="col-sm-3 col-form-label text-right">Bagi Kain :</label>
                            <div class="col-sm-7">
                                <input type="text" value="0" class="form-control input-sm" name="pembagian_kain_s3" id="pembagian_kain_s3" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="Buka" class="col-sm-3 col-form-label text-right">Buka Kain :</label>
                            <div class="col-sm-7">
                                <input required type="text" class="form-control input-sm" name="buka_kain_s3" id="buka_kain_s3" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <!-- <div class=" form-group row">
                            <label for="MasukManual" class="col-sm-3 col-form-label text-right">Total Masuk Kain Manual :</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control input-sm" name="masuk_kain_manual" id="masuk_kain_manual" placeholder="-Jumlah-">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="BagiManual" class="col-sm-3 col-form-label text-right">Total Bagi Kain Manual :</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control input-sm" name="bagi_kain_manual" id="bagi_kain_manual" placeholder="-Jumlah-">
                            </div>
                        </div> -->
                        <div class=" form-group row">
                            <label for="Penyusunan" class="col-sm-3 col-form-label text-right">Penyusunan Kain :</label>
                            <div class="col-sm-7">
                                <textarea type="text" class="form-control" name="penyusunan_s3" id="penyusunan_s3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-12 col-form-label text-center" style="border-bottom: solid gray 1px;">MASALAH YANG TERJADI SHIFT 3</label></h4>
                        </div>
                        <div class=" form-group row">
                            <div class="col-sm-12">
                                <textarea required type="text" class="form-control" name="masalah_s3" id="masalah_s3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h4 style="font-style: italic;"><label for="Hadir" class="col-sm-12 col-form-label text-center" style="border-bottom: solid gray 1px;">LAIN-LAIN DIVISI GKG | CEK MESIN</label></h4>
                        </div>
                        <!-- left lain-lain -->
                        <div class="col-sm-6" style="border-right: solid gray 1px;">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Terima Kain</label>
                                    <input required type="text" class="form-control input-xs" name="terima_kain_s3" id="terima_kain_s3" placeholder="Terima kain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Inspeksi</label>
                                    <input required type="text" class="form-control input-xs" name="inspeksi_s3" id="inspeksi_s3" placeholder="Inspeksi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Bagi Kain</label>
                                    <input required type="text" class="form-control input-xs" name="bagi_kain_s3" id="bagi_kain_s3" placeholder="Bagi kain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Buka Kain</label>
                                    <input required type="text" class="form-control input-xs" name="bukakains3" id="bukakains3" placeholder="Buka kain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Leader</label>
                                    <input required type="text" class="form-control input-xs" name="leader_s3" id="leader_s3" placeholder="Leader">
                                </div>
                            </div>
                        </div>
                        <!-- right lain-lain -->
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_bk_s3" id="mc_bk_s3" placeholder="MC Buka ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_blk_s3" id="mc_blk_s3" placeholder="MC Balik ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_blh_s3" id="mc_blh_s3" placeholder="MC Belah ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input required type="text" class="form-control input-sm" name="mc_jhtpgr_s3" id="mc_jhtpgr_s3" placeholder="Jahit Pinggir ...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Masalah Kehadiran</label>
                                    <textarea type="text" class="form-control" name="masalah_hadir_s3" id="masalah_hadir_s3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SHIFT 3 -->
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var spinner = new jQuerySpinner({
        parentId: 'block-full-page'
    });

    function disableScroll() {
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
            window.onscroll = function() {
                window.scrollTo(scrollLeft, scrollTop);
            };
    }

    function enableScroll() {
        window.onscroll = function() {};
    }

    function SpinnerShow() {
        spinner.show();
        disableScroll()
    }

    function SpinnerHide() {
        spinner.hide();
        enableScroll();
    }
</script>
<!-- work here -->
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        })

        $('#group_s3').on('focus', function() {
            if ($(this).val() == '-') {
                $(this).val('');
            } else {
                console.log('javascript:void(3)')
            }
        })
        $('#group_s2').on('focus', function() {
            if ($(this).val() == '-') {
                $(this).val('');
            } else {
                console.log('javascript:void(2)')
            }
        })
        $('#group_s1').on('focus', function() {
            if ($(this).val() == '-') {
                $(this).val('');
            } else {
                console.log('javascript:void(1)')
            }
        })

        $('#generate').click(function() {
            let tgl_laporan = $('#tgl_laporan').val();
            if (tgl_laporan == "") {
                Swal.fire(
                    'Pilih tanggal !',
                    'Untuk Generate data silahkan pilih tanggal !',
                    'error'
                )
            } else {
                SpinnerShow(), $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: "pages/ajax/data_server_MasukKainGreige.php",
                    data: {
                        tgl_laporan: tgl_laporan,
                        s1: $('#group_s1').val(),
                        s2: $('#group_s2').val(),
                        s3: $('#group_s3').val()
                    },
                    success: function(response) {
                        if (($('#tgl_laporan').val() == "") || (response.value_masuk == "0.00" && response.value_bagi == "0.00" && response.buka_kain_s1 == "0.00" && response.buka_kain_s2 == "0.00" && response.buka_kain_s3 == "0.00")) {
                            SpinnerHide(), Swal.fire(
                                'Data Kosong !',
                                '<b>Data Buka Bagi dan Masuk Kain masih 0 sebaiknya anda memilih tanggal lain !</b>',
                                'error'
                            )
                        } else {
                            $("#hold").show();
                            $('#masuk_kain_s3').val(response.value_masuk);
                            $('#pembagian_kain_s3').val(response.value_bagi);
                            $('#buka_kain_s1').val(response.buka_kain_s1);
                            $('#buka_kain_s2').val(response.buka_kain_s2);
                            $('#buka_kain_s3').val(response.buka_kain_s3);
                            $("#generate").prop("disabled", true);

                            Cek_if_data_was_exist(tgl_laporan)
                        }
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            }
        });

        $("#hold").click(function() {
            if (($('#tgl_laporan').val() == "") || ($('#masuk_kain_s1').val() == "0.00" && $('#pembagian_kain_s1').val() == "0.00" && $('#buka_kain_s1').val() == "0.00")) {
                Swal.fire(
                    'Data Kosong !',
                    '<b>Data Buka Bagi dan Masuk Kain masih 0 sebaiknya anda memilih tanggal lain !</b>',
                    'error'
                )
            } else {
                SpinnerShow(),
                    $.ajax({
                        dataType: "json",
                        type: "POST",
                        url: "pages/ajax/Ds_hold_laporan_shift.php",
                        data: {
                            tgl_laporan: $('#tgl_laporan').val(),
                            masuk_kain_s1: $('#masuk_kain_s1').val(),
                            masuk_kain_s2: $('#masuk_kain_s2').val(),
                            masuk_kain_s3: $('#masuk_kain_s3').val(),
                            pembagian_kain_s1: $('#pembagian_kain_s1').val(),
                            pembagian_kain_s2: $('#pembagian_kain_s2').val(),
                            pembagian_kain_s3: $('#pembagian_kain_s3').val(),
                            buka_kain_s1: $('#buka_kain_s1').val(),
                            buka_kain_s2: $('#buka_kain_s2').val(),
                            buka_kain_s3: $('#buka_kain_s3').val(),
                            // MANUAL
                            masuk_kain_manual: $('#masuk_kain_manual').val(),
                            bagi_kain_manual: $('#bagi_kain_manual').val(),
                            // ABSENSI
                            absensi_s1: $("#absensi_s1").val(),
                            absensi_s2: $("#absensi_s2").val(),
                            absensi_s3: $("#absensi_s3").val(),
                            // GROUP
                            group_s1: $("#group_s1").val(),
                            group_s2: $("#group_s2").val(),
                            group_s3: $("#group_s3").val(),
                            // hadir
                            hadir_s1: $("#hadir_s1").val(),
                            hadir_s2: $("#hadir_s2").val(),
                            hadir_s3: $("#hadir_s3").val(),
                            // sakit
                            sakit_s1: $("#sakit_s1").val(),
                            sakit_s2: $("#sakit_s2").val(),
                            sakit_s3: $("#sakit_s3").val(),
                            // mangkir
                            mangkir_s1: $("#mangkir_s1").val(),
                            mangkir_s2: $("#mangkir_s2").val(),
                            mangkir_s3: $("#mangkir_s3").val(),
                            // cuti
                            cuti_s1: $("#cuti_s1").val(),
                            cuti_s2: $("#cuti_s2").val(),
                            cuti_s3: $("#cuti_s3").val(),
                            // libur
                            libur_s1: $("#libur_s1").val(),
                            libur_s2: $("#libur_s2").val(),
                            libur_s3: $("#libur_s3").val(),
                            // izin
                            izin_s1: $("#izin_s1").val(),
                            izin_s2: $("#izin_s2").val(),
                            izin_s3: $("#izin_s3").val(),
                            // masalah
                            masalah_s1: $("#masalah_s1").val(),
                            masalah_s2: $("#masalah_s2").val(),
                            masalah_s3: $("#masalah_s3").val(),
                            // terimakain
                            terima_kain_s1: $("#terima_kain_s1").val(),
                            terima_kain_s2: $("#terima_kain_s2").val(),
                            terima_kain_s3: $("#terima_kain_s3").val(),
                            // inspeksi
                            inspeksi_s1: $("#inspeksi_s1").val(),
                            inspeksi_s2: $("#inspeksi_s2").val(),
                            inspeksi_s3: $("#inspeksi_s3").val(),
                            // bagi kain
                            bagi_kain_s1: $("#bagi_kain_s1").val(),
                            bagi_kain_s2: $("#bagi_kain_s2").val(),
                            bagi_kain_s3: $("#bagi_kain_s3").val(),
                            // bukakain
                            bukakains1: $("#bukakains1").val(),
                            bukakains2: $("#bukakains2").val(),
                            bukakains3: $("#bukakains3").val(),
                            // penyusunan
                            penyusunan_s1: $("#penyusunan_s1").val(),
                            penyusunan_s2: $("#penyusunan_s2").val(),
                            penyusunan_s3: $("#penyusunan_s3").val(),
                            // leader
                            leader_s1: $("#leader_s1").val(),
                            leader_s2: $("#leader_s2").val(),
                            leader_s3: $("#leader_s3").val(),
                            // mc_buka
                            mc_bk_s1: $("#mc_bk_s1").val(),
                            mc_bk_s2: $("#mc_bk_s2").val(),
                            mc_bk_s3: $("#mc_bk_s3").val(),
                            // mc_balik
                            mc_blk_s1: $("#mc_blk_s1").val(),
                            mc_blk_s2: $("#mc_blk_s2").val(),
                            mc_blk_s3: $("#mc_blk_s3").val(),
                            // mc_belah
                            mc_blh_s1: $("#mc_blh_s1").val(),
                            mc_blh_s2: $("#mc_blh_s2").val(),
                            mc_blh_s3: $("#mc_blh_s3").val(),
                            // jahit_pinggir
                            mc_jhtpgr_s1: $("#mc_jhtpgr_s1").val(),
                            mc_jhtpgr_s2: $("#mc_jhtpgr_s2").val(),
                            mc_jhtpgr_s3: $("#mc_jhtpgr_s3").val(),
                            //masalah_hadir
                            masalah_hadir_s1: $("#masalah_hadir_s1").val(),
                            masalah_hadir_s2: $("#masalah_hadir_s2").val(),
                            masalah_hadir_s3: $("#masalah_hadir_s3").val(),
                            // status
                            status: "NOT COMPLETED",
                        },
                        success: function(response) {
                            SpinnerHide(), Swal.fire(
                                'Berhasil',
                                '<b>' + response.data + '</b>',
                                'success'
                            )
                            Cek_if_data_was_exist($('#tgl_laporan').val())
                        },
                        error: function() {
                            SpinnerHide(), alert("Error");
                        }
                    });
            }
        })

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        function Cek_if_data_was_exist(tgl_laporan) {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "pages/ajax/Cek_if_data_was_exist.php",
                data: {
                    tgl_laporan: tgl_laporan
                },
                success: function(response) {
                    var Data = response.data;
                    if (response.session == 'LIB_SUCCSS') {
                        if (Data.group_s1 == "" || Data.group_s2 == "" || Data.group_s3 == "") {
                            SpinnerHide(), toastr.info('Data existing, silahkan lengkapi data...');
                            $("#print").hide();
                        } else {
                            SpinnerHide(), $("#print").show();
                        }
                            // MANUAL
                            $("#masuk_kain_manual").val(Data.masuk_kain_manual),
                            $("#bagi_kain_manual").val(Data.bagi_kain_manual),
                            // ABSENSI
                            $("#absensi_s1").val(Data.absensi_s1),
                            $("#absensi_s2").val(Data.absensi_s2),
                            $("#absensi_s3").val(Data.absensi_s3),
                            // GROUP
                            $("#group_s1").val(Data.group_s1),
                            $("#group_s2").val(Data.group_s2),
                            $("#group_s3").val(Data.group_s3),
                            // hadir
                            $("#hadir_s1").val(Data.hadir_s1),
                            $("#hadir_s2").val(Data.hadir_s2),
                            $("#hadir_s3").val(Data.hadir_s3),
                            // sakit
                            $("#sakit_s1").val(Data.sakit_s1),
                            $("#sakit_s2").val(Data.sakit_s2),
                            $("#sakit_s3").val(Data.sakit_s3),
                            // mangkir
                            $("#mangkir_s1").val(Data.mangkir_s1),
                            $("#mangkir_s2").val(Data.mangkir_s2),
                            $("#mangkir_s3").val(Data.mangkir_s3),
                            // cuti
                            $("#cuti_s1").val(Data.cuti_s1),
                            $("#cuti_s2").val(Data.cuti_s2),
                            $("#cuti_s3").val(Data.cuti_s3),
                            // libur
                            $("#libur_s1").val(Data.libur_s1),
                            $("#libur_s2").val(Data.libur_s2),
                            $("#libur_s3").val(Data.libur_s3),
                            // bagi dan masuk kain s1 &s2
                            $('#masuk_kain_s1').val(Data.masuk_kain_s1),
                            $('#masuk_kain_s2').val(Data.masuk_kain_s2),
                            $('#pembagian_kain_s1').val(Data.pembagian_kain_s1),
                            $('#pembagian_kain_s2').val(Data.pembagian_kain_s2),
                            // buka kain 
                            // $('#buka_kain_s1').val(Data.buka_kain_s1),
                            // $('#buka_kain_s2').val(Data.buka_kain_s2),
                            // $('#buka_kain_s3').val(Data.buka_kain_s3),
                            // izin
                            $("#izin_s1").val(Data.izin_s1),
                            $("#izin_s2").val(Data.izin_s2),
                            $("#izin_s3").val(Data.izin_s3),
                            // masalah
                            $("#masalah_s1").val(Data.masalah_s1),
                            $("#masalah_s2").val(Data.masalah_s2),
                            $("#masalah_s3").val(Data.masalah_s3),
                            // terimakain
                            $("#terima_kain_s1").val(Data.terimakains1),
                            $("#terima_kain_s2").val(Data.terimakains2),
                            $("#terima_kain_s3").val(Data.terimakains3),
                            // inspeksi
                            $("#inspeksi_s1").val(Data.inspeksis1),
                            $("#inspeksi_s2").val(Data.inspeksis2),
                            $("#inspeksi_s3").val(Data.inspeksis3),
                            // bagi kain
                            $("#bagi_kain_s1").val(Data.bagikains1),
                            $("#bagi_kain_s2").val(Data.bagikains2),
                            $("#bagi_kain_s3").val(Data.bagikains3),
                            // bukakain
                            $("#bukakains1").val(Data.bukakains1),
                            $("#bukakains2").val(Data.bukakains2),
                            $("#bukakains3").val(Data.bukakains3),
                            // penyusunan
                            $("#penyusunan_s1").val(Data.penyusunan_s1),
                            $("#penyusunan_s2").val(Data.penyusunan_s2),
                            $("#penyusunan_s3").val(Data.penyusunan_s3),
                            // leader
                            $("#leader_s1").val(Data.leader_s1),
                            $("#leader_s2").val(Data.leader_s2),
                            $("#leader_s3").val(Data.leader_s3),
                            // mc_buka
                            $("#mc_bk_s1").val(Data.mc_buka_s1),
                            $("#mc_bk_s2").val(Data.mc_buka_s2),
                            $("#mc_bk_s3").val(Data.mc_buka_s3),
                            // mc_balik
                            $("#mc_blk_s1").val(Data.mc_balik_s1),
                            $("#mc_blk_s2").val(Data.mc_balik_s2),
                            $("#mc_blk_s3").val(Data.mc_balik_s3),
                            // mc_belah
                            $("#mc_blh_s1").val(Data.mc_belah_s1),
                            $("#mc_blh_s2").val(Data.mc_belah_s2),
                            $("#mc_blh_s3").val(Data.mc_belah_s3),
                            // jahit_pinggir
                            $("#mc_jhtpgr_s1").val(Data.jahit_pinggir_s1),
                            $("#mc_jhtpgr_s2").val(Data.jahit_pinggir_s2),
                            $("#mc_jhtpgr_s3").val(Data.jahit_pinggir_s3),
                            // masalah_hadir
                            $("#masalah_hadir_s1").val(Data.masalah_hadir_s1),
                            $("#masalah_hadir_s2").val(Data.masalah_hadir_s2),
                            $("#masalah_hadir_s3").val(Data.masalah_hadir_s3), SpinnerHide()

                    } else {
                        SpinnerHide(), toastr.success('Data baru, Harap melengkapi data shift 1, 2 & 3 untuk memunculkan button print');
                    }
                },
                error: function() {
                    SpinnerHide(), alert("Error");
                }
            });
        }

        $('#print').click(function() {
            window.open('pages/cetak/laporan_shift.php?date_laporan=' + $('#tgl_laporan').val());
        })

    })
</script>
<script>
    $(document).on('focus', '.input-xs', function() {
        $(this).keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    })
    $(document).on('focus', '.angka', function() {
        $(this).keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    })
</script>
<script>
function roundToTwo(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}
</script>
<script>
    $(document).ready(function() {
        function SUM_absensi_s1() {
            let terima_kain_s1 = $("#terima_kain_s1").val() || 0;
            let inspeksi_s1 = $("#inspeksi_s1").val() || 0;
            let bagi_kain_s1 = $("#bagi_kain_s1").val() || 0;
            let bukakains1 = $("#bukakains1").val() || 0;
            let leader_s1 = $("#leader_s1").val() || 0;
            let value = parseFloat(terima_kain_s1) + parseFloat(inspeksi_s1) + parseFloat(bagi_kain_s1) + parseFloat(bukakains1) + parseFloat(leader_s1);
            $('#absensi_s1').val(value)
            SUM_hadir_s1()
        }

        $('#terima_kain_s1').on('focusout', function() {
            SUM_absensi_s1();
        })
        $('#inspeksi_s1').on('focusout', function() {
            SUM_absensi_s1();
        })
        $('#bagi_kain_s1').on('focusout', function() {
            SUM_absensi_s1();
        })
        $('#bukakains1').on('focusout', function() {
            SUM_absensi_s1();
        })
        $('#leader_s1').on('focusout', function() {
            SUM_absensi_s1();
        })

        function SUM_absensi_s2() {
            let terima_kain_s2 = $("#terima_kain_s2").val() || 0;
            let inspeksi_s2 = $("#inspeksi_s2").val() || 0;
            let bagi_kain_s2 = $("#bagi_kain_s2").val() || 0;
            let bukakains2 = $("#bukakains2").val() || 0;
            let leader_s2 = $("#leader_s2").val() || 0;
            let value = parseFloat(terima_kain_s2) + parseFloat(inspeksi_s2) + parseFloat(bagi_kain_s2) + parseFloat(bukakains2) + parseFloat(leader_s2);
            $('#absensi_s2').val(value)
            SUM_hadir_s2()
        }

        $('#terima_kain_s2').on('focusout', function() {
            SUM_absensi_s2();
        })
        $('#inspeksi_s2').on('focusout', function() {
            SUM_absensi_s2();
        })
        $('#bagi_kain_s2').on('focusout', function() {
            SUM_absensi_s2();
        })
        $('#bukakains2').on('focusout', function() {
            SUM_absensi_s2();
        })
        $('#leader_s2').on('focusout', function() {
            SUM_absensi_s2();
        })

        function SUM_absensi_s3() {
            let terima_kain_s3 = $("#terima_kain_s3").val() || 0;
            let inspeksi_s3 = $("#inspeksi_s3").val() || 0;
            let bagi_kain_s3 = $("#bagi_kain_s3").val() || 0;
            let bukakains3 = $("#bukakains3").val() || 0;
            let leader_s3 = $("#leader_s3").val() || 0;
            let value = parseFloat(terima_kain_s3) + parseFloat(inspeksi_s3) + parseFloat(bagi_kain_s3) + parseFloat(bukakains3) + parseFloat(leader_s3);
            $('#absensi_s3').val(value)
            SUM_hadir_s3()
        }

        $('#terima_kain_s3').on('focusout', function() {
            SUM_absensi_s3();
        })
        $('#inspeksi_s3').on('focusout', function() {
            SUM_absensi_s3();
        })
        $('#bagi_kain_s3').on('focusout', function() {
            SUM_absensi_s3();
        })
        $('#bukakains3').on('focusout', function() {
            SUM_absensi_s3();
        })
        $('#leader_s3').on('focusout', function() {
            SUM_absensi_s3();
        })
        // //////////////////////////////////////////////////////////// END absensi

        // hadir start
        function SUM_hadir_s1() {
            let absensi = $('#absensi_s1').val() || 0;
            let sakit_s1 = $('#sakit_s1').val() || 0;
            let mangkir_s1 = $('#mangkir_s1').val() || 0;
            let cuti_s1 = $('#cuti_s1').val() || 0;
            let libur_s1 = $('#libur_s1').val() || 0;
            let izin_s1 = $('#izin_s1').val() || 0;
            value = parseFloat(absensi) - (parseFloat(sakit_s1) + parseFloat(mangkir_s1) + parseFloat(cuti_s1) + parseFloat(libur_s1) + parseFloat(izin_s1));
            $('#hadir_s1').val(value)
        }

        $('#sakit_s1').on('focusout', function() {
            SUM_hadir_s1();
        })
        $('#mangkir_s1').on('focusout', function() {
            SUM_hadir_s1();
        })
        $('#cuti_s1').on('focusout', function() {
            SUM_hadir_s1();
        })
        $('#libur_s1').on('focusout', function() {
            SUM_hadir_s1();
        })
        $('#izin_s1').on('focusout', function() {
            SUM_hadir_s1();
        })

        function SUM_hadir_s2() {
            let absensi = $('#absensi_s2').val() || 0;
            let sakit_s2 = $('#sakit_s2').val() || 0;
            let mangkir_s2 = $('#mangkir_s2').val() || 0;
            let cuti_s2 = $('#cuti_s2').val() || 0;
            let libur_s2 = $('#libur_s2').val() || 0;
            let izin_s2 = $('#izin_s2').val() || 0;
            value = parseFloat(absensi) - (parseFloat(sakit_s2) + parseFloat(mangkir_s2) + parseFloat(cuti_s2) + parseFloat(libur_s2) + parseFloat(izin_s2));
            $('#hadir_s2').val(value)
        }

        $('#sakit_s2').on('focusout', function() {
            SUM_hadir_s2();
        })
        $('#mangkir_s2').on('focusout', function() {
            SUM_hadir_s2();
        })
        $('#cuti_s2').on('focusout', function() {
            SUM_hadir_s2();
        })
        $('#libur_s2').on('focusout', function() {
            SUM_hadir_s2();
        })
        $('#izin_s2').on('focusout', function() {
            SUM_hadir_s2();
        })

        function SUM_hadir_s3() {
            let absensi = $('#absensi_s3').val() || 0;
            let sakit_s3 = $('#sakit_s3').val() || 0;
            let mangkir_s3 = $('#mangkir_s3').val() || 0;
            let cuti_s3 = $('#cuti_s3').val() || 0;
            let libur_s3 = $('#libur_s3').val() || 0;
            let izin_s3 = $('#izin_s3').val() || 0;
            value = parseFloat(absensi) - (parseFloat(sakit_s3) + parseFloat(mangkir_s3) + parseFloat(cuti_s3) + parseFloat(libur_s3) + parseFloat(izin_s3));
            $('#hadir_s3').val(value)
        }

        $('#sakit_s3').on('focusout', function() {
            SUM_hadir_s3();
        })
        $('#mangkir_s3').on('focusout', function() {
            SUM_hadir_s3();
        })
        $('#cuti_s3').on('focusout', function() {
            SUM_hadir_s3();
        })
        $('#libur_s3').on('focusout', function() {
            SUM_hadir_s3();
        })
        $('#izin_s3').on('focusout', function() {
            SUM_hadir_s3();
        })

        function SUM_masuk_kainS2(){
            let masuk_kain_s1 = $('#masuk_kain_s1').val() || 0;
            let masuk_kain_s3 = $('#masuk_kain_s3').val() || 0;
            value = roundToTwo(parseFloat(masuk_kain_s3) - parseFloat(masuk_kain_s1)).toFixed(2);
            $('#masuk_kain_s2').val(value)
        }
        $('#masuk_kain_s1').on('focusout', function() {
            SUM_masuk_kainS2();
        })

        function SUM_pembagian_kainS2(){
            let pembagian_kain_s1 = $('#pembagian_kain_s1').val() || 0;
            let pembagian_kain_s3 = $('#pembagian_kain_s3').val() || 0;
            value = roundToTwo(parseFloat(pembagian_kain_s3) - parseFloat(pembagian_kain_s1)).toFixed(2);
            $('#pembagian_kain_s2').val(value)
        }
        $('#pembagian_kain_s1').on('focusout', function() {
            SUM_pembagian_kainS2();
        })
    })
</script>