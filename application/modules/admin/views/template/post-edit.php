            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Post </h1>
                </div>
                
            </div>


    <?php echo form_open('admin/proses_post/save_post'); ?>
            
            <?php echo $post['hidden_default']; ?>
            <div class="row">
                    <div class="col-lg-9">
                            <div class="form-group">
                                <input type="text" name="judul_artikel" placeholder="Judul" class="form-control pnpost" value="<?php echo $post['judul_post'] ?>"> <br>
                                <br>
                                <textarea class="ckeditor "  name="konten_artikel" id="konten_artikel" ><?php echo $post['isi_post']; ?></textarea>

                            </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                
                            <span class="pull-left">Komentar, Like, dan Share</span><i data-toggle="collapse" data-target=".body-komen" class="fa fa-caret-up pull-right fa-minimize"></i>
                                <div class="clearfix"></div>
                            </div>
                            <div class=" collapse in body-komen">
                                <div class="panel-body">
                                    
                                    <input type="checkbox" class="post-n-komentar" name="allow_komen" value="1" <?php echo $post['komen_post_btn'] ?> > <span class="letter_n_post"> Bolehkan komentar.</span> <br><br>
                                    <input type="checkbox" class="post-n-like" name="allow_like" value="1" <?php echo $post['like_post_btn'] ?> > <span class="letter_n_post"> Tampilkan tombol suka. </span><br><br>
                                    <input type="checkbox" class="post-n-sharing" name="allow_share" value="1" <?php echo $post['sharing_post_btn'] ?> > <span class="letter_n_post"> Tampilkan tombol sharing.</span> <br><br>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading"><span class="pull-left">Publish</span><i class="fa  fa-caret-up  pull-right fa-minimize" data-toggle="collapse" data-target=".body-publish"></i><div class="clearfix"></div></div>
                            <div class="collapse in body-publish">
                                <div class="panel-body ">
                            
                                    <button class="btn btn-default pull-right btn-save-preview">Preview Change</button>
                                    <div class="clearfix"></div>
                                    <br>
                                    
                                        <p id="post-n-status-wrap"><i class="fa fa-key"></i> Status: <b id="post-n-status">Draft</b> <a href="javascript:void(0);" data-toggle="collapse" data-target=".ppublished" name="editpublish" class="btn-edit btn-edit-status">Edit</a></p>
                                        
                                            <div style="margin-bottom:10px;" class="form-inline collapse ppublished" >
                                                <select name="ppublished" class="form-control">
                                                    <option value="publish">Published</option>
                                                    <option value="pending">Pending Preview</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                                <button type="button" class="btn btn-default form-control post-n-status-btn">ok</button> &nbsp;<a href="javascript:void(0);" data-toggle="collapse" data-target=".ppublished" name="editpublish" class="btn-cancel cancel-status">Cancel</a>
                                            </div>
                                           
                                        <p id="post-n-visibility-wrap"><i class="fa fa-eye"></i> Visibility: <b id="post-n-visi">Public</b> <a href="javascript:void(0);" data-toggle="collapse" data-target="#pvisibility" name="editpublic" class="btn-edit btn-edit-visibility">Edit</a></p>
                                            <div class="collapse" id="pvisibility">
                                                 <div class="public-post">
                                                    <input type="radio" data-toggle="collapse" data-target=".ppublic" name="editpublish" id="public-click" > Public
                                                    <ul class="collapse ppublic">
                                                        <li>
                                                            <input type="checkbox" class="post-n-stick" name="input_stick" value="1"> Stick post halaman depan
                                                        </li>
                                                    </ul>
                                                 </div>

                                                 <p class="pass-post">
                                                    <input type="radio" data-toggle="collapse"  data-target=".ppass" name="editpublish" id="pass-click"> Perlindungan Password
                                                    <div class="form-group collapse ppass" >
                                                        Password:
                                                        <input type="text" class="form-control post-n-input-pass" name="input_password">
                                                    </div>   
                                                 </p>  
                                                 <button type="button" class="btn btn-default post-n-visi-btn">ok</button> &nbsp;<a href="javascript:void(0);" data-toggle="collapse" data-target="#pvisibility" name="editpublic" class="btn-cancel cancel-visibility">cancel</a>                                          
                                            </div>
                                    
                                </div>
                                <div class="panel-footer">
                                    <a href="javascript:void(0);" class="trash_n_post">Pindahkan ke Trash</a>
                                    <button class="btn btn-primary pull-right" type="submit" name="submit_form" value="update">Update</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="pull-left">Kategori</span><i data-toggle="collapse" data-target=".body-kategori" class="fa fa-caret-up pull-right fa-minimize"></i>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in body-kategori">
                                <div class="panel-body panel-kategori">
         
                                    <?php foreach ($post['kategori_list'] as $kategori) {
                                        echo $kategori;
                                    } ?>
                                </div>
                                <div class="panel-footer">
                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#pkategori" name="sidekategori">+ Tambah Kategori Baru</a>
                                        <div class="collapse" id="pkategori">
                                        <br> 
                                            <div class="form-inline">
                                                <input type="text" class="form-control" placeholder="kategori baru">
                                                <button class="btn btn-default form-control post-n-kategori-btn" type="button">Add</button>  
                                            </div>

                                    </div>
                                 </div>
                             </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="pull-left">Tags</span><i data-toggle="collapse" data-target=".body-tags" class="fa  fa-caret-up pull-right fa-minimize"></i>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in body-tags">
                                <div class=" panel-body ">
                                            <div class="form-inline">
                                                <input type="text" class="form-control input-n-tag" placeholder="Tag baru">
                                                <button type="button"  class="btn btn-default form-control post-n-tag-btn">Add</button>
                                            </div>
                                        <br>
                                        
                                        <i class="tgl">pisahkan tag dengan koma</i><br>
                                        <div class="post-n-list-tags">
                                            <?php echo $post['tags']; ?>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="pull-left">Gambar Judul</span><i data-toggle="collapse" data-target=".body-gambar" class="fa  fa-caret-up  pull-right fa-minimize"></i>
                                <div class="clearfix"></div>
                            </div>
                            <div class="body-gambar collapse in">
                                <div class="panel-body  ">
                                    <img src="css/images/subhan.JPG" alt="kosong" class="gambar-judul" style="display:none;">
                                    <input type="file">
                                </div>
                            </div>
                        </div>
                    </div>
<?php echo form_close(); ?>
