            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pengaturan Umum</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-6">
                        <form action="">
                            
                            <table class="umum-tabel">
                                <tr>
                                    <th>Judul Web</th>
                                    <td><input type="text"  name="judul-web" class="form-control"></td>
                                </tr>  
                                <tr>
                                    <th>Deskripsi Web</th>
                                    <td><input type="text"  name="desk-web" class="form-control"></td>
                                </tr>                           
                                <tr>
                                    <th>Format Tanggal</th>
                                    <td>
                                        
                                        <input type="radio"  name="format-tanggal"> July 31, 2015 <br><br>
                                        <input type="radio"  name="format-tanggal"> 2015-07-31 <br><br>
                                        <input type="radio" name="format-tanggal"> 07/31/2015 <br><br>
                                        <input type="radio"  name="format-tanggal"> 31/07/2015 <br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Format Jam</th>
                                    <td>
                                        <input type="radio"  name="format-tanggal"> 10:41 am <br><br>
                                        <input type="radio"  name="format-tanggal"> 10:41 AM <br><br>
                                        <input type="radio" name="format-tanggal"> 10:41 <br><br>
                                    </td>
                                </tr>  
                                <tr>
                                    <td><button class="btn btn-primary" type="submit">Simpan Perubahan</button></td>
                                </tr>                              
                            </table>
                        </form>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Gambar Header Blog
                            </div>
                            <div class="panel-body">
                                <img  alt="" class="head-img" src="<?php echo  base_url('assets/css/images/tri.jpg')?>"><br><br>
                                <p>
                                    Upload gambar (jpeg or png) untuk di gunakan sebagai gambar Header blog
                                </p>
                                <form action="">
                                    <input type="file"><br>
                                    <button class="btn btn-default" type="submit">Upload Gambar</button>
                                </form>
                            </div>
                        </div>

                    </div>
            </div>