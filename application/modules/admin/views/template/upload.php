            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Media Library <div class="btn btn-primary">Tambah Baru</div></h1>
                </div>
            </div>
            <div id="dropzone">
                <div class="fallback">
                    <form class="dropzone" id="dropzone_media" >
                        <div class="dz-message">
                        Drop files here or click to upload.<br />
                        <span class="note">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="form-inline">
                                             
                                <button class="btn btn-default fa fa-th-list tlist btn-list" type="button"></button>                            
                                <button class="btn btn-default fa fa-th-large tdetails btn-detail" type="button"></button>

                                <select name="tanggal" id="ftanggal" class="form-control">
                                    <option value="">Semua media item</option>
                                </select>
                                <select name="kategori" id="fkategori" class="form-control">
                                    <option value="">Semua tanggal</option>
                                </select>
                                <button class="btn btn-default">Bulk Select</button>

                            </div>
                        </div>

                        <div class="panel-body media-body">
                            <?php foreach ($media_list as $media) {
                                echo $media;
                            } ?>
                        </div>

                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#mediaModal">
                          Buka Modal
                        </button>
                         
                        <!-- Dialog Modal -->
                        <div class="modal" id="mediaModal" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-2x"></i></button>
                                    <button type="button" class="close" ><i class="fa fa-angle-right fa-2x"></i></button>
                                    <button type="button" class="close" ><i class="fa fa-angle-left fa-2x"></i></button>
                                    <h2 class="modal-title" id="myModalLabel">Modal Judul</h2>
                                  </div>
                                  <div class="modal-body">
                                        <div class=" modal-left">
                                             <img alt='kosong' class='image-media' src= 'http://localhost/hmvc/assets/media/images/Screenshot from 2015-08-14 09:56:42.png'>
                                        </div>
                                        <div class=" modal-right modal-body-detail">
                                            <div class="isi-modal-right">
                                                File name: <span class="media-file-name"></span> <br>
                                                File type: <span class="media-file-name"></span> <br>
                                                Uploaded on: <span class="media-file-name"></span> <br>
                                                File size: <span class="media-file-name"></span> <br>
                                                Dimensions: <span class="media-file-name"></span> <br>
                                                <hr class="media">

                                                <table>
                                                    <tr>
                                                        <td class="judul-form">URL</td>
                                                        <td class="input-form"><input type="text" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="judul-form">Title</td>
                                                        <td class="input-form"><input type="text" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="judul-form">Deskripsi</td>
                                                        <td class="input-form"><textarea class="form-control" name="" id="" cols="10" ></textarea></td>
                                                    </tr>
                                                </table>
                                                <div class="clearfix"></div>
                                                <hr class="media">

                                                <a href="javascript:void(0);">View attachment page</a> | <a href="javascript:void(0);">Edit more details </a> |  <a class="trashm" href="javascript:void(0);">Delete Permanently</a>
                                            </div>
                                        </div>

                                  </div>  
                                  <div class="clearfix"></div>                                
                              </div>

                            </div>
                          </div>
                        </div>

                    </div>                          
                </div>
            </div>