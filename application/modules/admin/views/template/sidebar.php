                   
                   <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav side-nav">
                            <li class="active">
                                <a href="<?php echo base_url('admin/'); ?>"><i class="fa fa-fw fa-dashboard"></i>   Dashboard</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#post"><i class="fa fa-fw fa-edit"></i> Post<i class="fa fa-fw fa-caret-down"></i></a>
                                <ul id="post" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url('admin/post'); ?>">Semua Post</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('admin/post_new'); ?>">Tambah Post</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('admin/kategori'); ?>">Kategori</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('admin/tags'); ?>">Tags</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#pages"><i class="fa fa-fw  fa-file"></i> Halaman<i class="fa fa-fw fa-caret-down"></i></a>
                                <ul id="pages" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url('admin/page'); ?>">Semua Halaman</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('admin/page_new'); ?>">Tambah Halaman</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/komentar'); ?>"><i class="fa fa-fw  fa-stack-exchange "></i>    Komentar</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/upload'); ?>"><i class="fa fa-fw  fa-upload "></i> Upload Files</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#settings"><i class="fa fa-fw  fa-wrench "></i> Settings<i class="fa fa-fw fa-caret-down"></i></a>
                                <ul id="settings" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url('admin/setting_umum'); ?>">Umum</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('admin/setting_akun'); ?>">Akun</a>
                                    </li>
                                    <li>
                                        <a href="#">Tema</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

