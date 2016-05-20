                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-list-alt "></i> Activity
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">

                                                    <div class="col-lg-12">
                                                        <b>
                                                            <p>Recently Published</p>
                                                        </b>
                                                    </div>

                                                    <div class="col-lg-5 tgl">
                                                        <?php 
                                                            foreach ($activity_published as $arr) {
                                                                foreach ($arr['tgl'] as $tgl ) {
                                                                    echo $tgl;
                                                                }
                                                            }
                                                         ?>
                                                    </div>
                                                    <div class="col-lg-7 recently-post">
                                                        <?php 
                                                            foreach ($activity_published as $arr) {
                                                                foreach ($arr['judul'] as $judul ) {
                                                                    echo $judul;
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                    
                                            
                                            </div>

                                        </div>
                                        <div class="panel-heading"> Komentar</div>

                                        <div class="panel-body table-activity">
                                                <table >
                                                    <tbody class="activity_komen-body">
                                                           <?php 
                                                            foreach ($activity_komentar['komen'] as $key) {
                                                                echo $key;
                                                            }
                                                         ?>  
                   
                                                                    <div class='media komentrash'>                     
                                                                        <img src=http://localhost/hmvc/assets/css/images/subhan.JPG alt='' class='ppkomentrash pull-left'>                       
                                                                        <div class='media-body'>                        
                                                                            <p class='media-heading'>komentar dari <strong>Subhan dinda putra</strong> di pindah ke trash. <a href="">undo</a></p>                                            
                                                                        </div>                      
                                                                    </div>                      
                                                                                                                                                                     
                                                    </tbody>
                                                </table>
                                                    <div class="btn-more">
                                                        <?php if ($activity_komentar['more']) {
                                                            echo $activity_komentar['more'];
                                                        } ?>     
                                                    </div>
 
                                                    
                                        </div>
                                        <div class="panel-footer">
                                            <p><a href="">All</a> | <a href="">Pending</a> (<span href="" class=" tgl kpending" ><?php echo $activity_komentar['komen_num'][0] ?></span> ) | <a href="">Approved</a> (<span href="" class=" tgl kapprove" ><?php echo $activity_komentar['komen_num'][1] ?></span>) | <a href="">Tempah Sampah</a> (<span class=" tgl ktrash"><?php echo $activity_komentar['komen_num'][2] ?></span>)</p>
                                        </div>
                                    </div>                                        