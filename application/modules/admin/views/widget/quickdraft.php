                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-share"></i>  Quick Draft
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                    <div class="col-lg-12">

                                                            <div class=" col-lg-12 form-group">
                                                                <input type="text"  id="qjudul" class="form-control" placeholder="Title"> 
                                                            </div>
                                                            <div class="col-lg-12 form-group">
                                                                <textarea class="col-md-12"  placeholder="Apa yang anda pikirkan?" name="" id="qisi"rows="10" class="form-control"> </textarea>
                                                            </div>  
                                                             <div class="col-lg-12">
                                                                <button class='btn btn-primary' data-loading-text='Menyimpan draft...' id='save-draft'>Simpan Draft</button>
                                                            </div>
                                                    </div>
                
                                            </div>

                                        </div>
                                        <div class="panel-footer">
                                            <p><b>Drafts</b></p>

                                            <div class="isi-drafts">
                                                <?php 
                                                    foreach ($quick_draft['list_draft'] as $draft) {
                                                        echo $draft;
                                                    }
                                                 ?>
                                            </div>
                                        </div>
                                    </div>