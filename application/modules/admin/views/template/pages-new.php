            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Page Baru</h1>
                </div>
            </div>

            <div class="row">
                    <div class="col-lg-9">
                        <form action="">
                            <div class="form-group">
                                <input type="text" placeholder="Judul" class="form-control pnpost"> <br>
                                <br>
                                <textarea class="ckeditor "  name="konten_page" id="konten_page" ></textarea>

                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">Publish</div>
                            <div class="panel-body">
                                <button class="btn btn-default pull-left">Save Draft</button>
                                <button class="btn btn-default pull-right">Preview</button>
                                <div class="clearfix"></div>
                                <br>
                                <p>
                                    <i class="fa fa-key"></i> Status: <b>Draft</b> <a href="#" data-toggle="collapse" data-target="#ppublished" name="editpublish">Edit</a>
                                    <ul class="collapse" id="ppublished">
                                        <li>
                                            <form action="">
                                                <select name="ppublished" id="">
                                                    <option value="">Publish</option>
                                                    <option value="">Draft</option>
                                                </select>
                                                <input type="submit" value="ok">
                                            </form>
                                        </li>
                                    </ul>
                                    <i class="fa fa-eye"></i> Visibility: <b>Public</b> <a href="#" data-toggle="collapse" data-target="#pvisibility" name="editpublic">Edit</a>
                                    <ul  class="collapse" id="pvisibility">
                                        <li>
                                            <form action="">
                                                <input type="radio" data-toggle="collapse" data-target="#ppublic" name="editpublish"> Public
                                                <ul class="collapse" id="ppublic">
                                                    <li>
                                                        <input type="checkbox"> Stick post halaman depan
                                                    </li>
                                                </ul>
                                                <br>
                                                <input type="radio" data-toggle="collapse" data-target="#ppass" name="editpublish"> Perlindungan Password
                                                <ul class="collapse" id="ppass">
                                                    <li>
                                                        password:
                                                        <input type="text">
                                                    </li>
                                                </ul>
                                            </form>
                                        </li>
                                    </ul>
                                </p>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-danger pull-left"><span class="fa fa-trash-o"></span></button>
                                <button class="btn btn-primary pull-right" type="submit">Publish</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Gambar Judul
                            </div>
                            <div class="panel-body">
                                <img src="<?php echo base_url('assets/css/images/subhan.JPG') ?>" alt="kosong" class="gambar-judul">
                                <input type="file">
                            </div>
                        </div>
                    </div>
            </div>