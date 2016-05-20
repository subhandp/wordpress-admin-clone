    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Post <button type="button" class="btn  btn-primary">Tambah Baru</button></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php 
		if ($this->session->flashdata('post_trash')!=null) {
			echo'<div class="alert alert-success alert-dismissable">
		        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            	<span class="nil-trash">'.$this->session->flashdata('jmlh_trash').'</span> post di pindahkan ke Trash. <a href='.base_url('admin/proses_post/ke_trash?undo_trash='.$this->session->flashdata('post_trash').'').' class="alert-link undo_trash_post">Undo</a>
				</div>';
		}
		else if($this->session->flashdata('trash_undo')!=null){
			echo'<div class="alert alert-success alert-dismissable">
			    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        <span class="res-trash">'.$this->session->flashdata('trash_undo').'</span> post di kembalikan dari Trash
			</div>';			
		}
     ?>




	<div class="row">

					<div class="col-lg-6 col-md-12">
						<p><a href="">All</a><span class=" tgl pallpost"> (6)</span> | <a>Terbit</a><span href="" class=" tgl pterbit" > (6)</span> | <a>Pending</a><span href="" class=" tgl pterbit" > (1)</span> | <a href="" >Drafts</a><span class=" tgl pdrafts"> (6)</span> | <a href="">Tempah Sampah</a><span class=" tgl ptrash"> (6)</span></p>
					</div>
					<div class="col-lg-6 col-md-12">
					<form action="" class="form">
						<div class="form-inline pull-right">
								<input type="text"  id="pjudulpost" class="form-control" placeholder="Judul Post"> 
							<button class=" btn btn-default" type="submit">Cari Post</button>
						</div>

					</form>

					</div>

	</div>
				<br>

	<div class="row">

				<div class="col-lg-6">

					<form action="">
						<div class="form-inline">
						 	<div class="tinterface ">
								<button class="btn btn-default fa fa-th-list tlist btn-list" type="button"></button>							
								<button class="btn btn-default fa fa-th-large tdetails btn-detail" type="button"></button>
							</div><br>
							<select name="allpost" id="bulk-post" class="form-control">
	                        <option value="bulk">Aksi massal</option>
	                        <option value="edit_post">Edit</option>
	                        <option value="trash_post">Move to trash</option>
	                    </select>
	                    <button class="btn btn-default btn-bulk" type="button">Apply</button>
							<select name="tanggal" id="ftanggal" class="form-control">
								<option value="">Semua tanggal</option>
							</select>
							<select name="kategori" id="fkategori" class="form-control">
								<option value="">Semua kategori</option>
							</select>
							<button class="btn btn-default">Filter</button>
						</div>
					</form>
				</div>
				<div class="col-lg-6 pull-right">

				<?php echo $table['pagination'] ?>
				
				</div>
			
	</div>

			<br>
	<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">

						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<?php echo $table['head_table']; ?>
									</thead>
									<tbody>

										<tr class="massal-edit">
											<td colspan="6">
												<p>Edit Massal</p>
												<div class="row">
													<div class="col-lg-4">
														<i class="tgl">Judul</i>
														<div class="panel panel-default">
															<div class="panel-body fixed-panel">
																 <div class="list-tags">
											                        <a href="javascript:void(0);" class="fa fa-times-circle-o clstag"></a><span> aku</span><br>
											                        <a href="javascript:void(0);" class="fa fa-times-circle-o clstag"></a><span> kamu</span><br>
											                        <a href="javascript:void(0);" class="fa fa-times-circle-o clstag"></a><span> dia</span><br>
											                    
											                    </div>
															</div>
														</div>
													</div>	
													<div class="col-lg-4">
														<i class="tgl">Kategori</i>
														<div class="panel panel-default">

															<div class="panel-body bulk_kategori_post">
																<?php 
																	foreach ($table['kategori_list'] as $row) {
																		echo $row;
																	}
																 ?>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<i class="tgl">Tags</i>
															<textarea class="form-control bulk_tag_post" ></textarea>
														</div>


														<i class="tgl">Komen</i>&nbsp;&nbsp;
														<select class="bulk_komen_post" id="">
															<option value="none">-- No Change --</option>
											                <option value="1">Boleh</option>
											                <option value="0">Tidak Boleh</option>
											            </select>&nbsp;&nbsp;&nbsp;&nbsp;
											           <i class="tgl">sticky</i>&nbsp;
														<select class="bulk_sticky_post" id="">
															<option value="none">-- No Change --</option>
											                <option value="1">Sticky</option>
											                <option value="0">Tidak Sticky</option>
											            </select>	
											            		<br><br>
														<i class="tgl">Status</i>&nbsp;&nbsp;&nbsp; 
														<select class="bulk_status_post" id="">
															<option value="none">-- No Change --</option>
											                <option value="publish">Publish</option>
											                <option value="pending">Pending Review</option>
											                <option value="draft">Draft</option>
											            </select>	
													</div>
												</div><br>
												<button class="btn-default pull-left batal-massal-edit">Batal</button>
												<div class=" pull-right">
													<img class="loading-img" src="<?php echo  base_url('assets/css/images/loading.gif')?>" alt="" style="height:20px;">&nbsp;&nbsp;
													<button class="btn-primary pull-right post_bulk_update">Update</button>
												</div>
											</td>
										</tr> 	

										<tr class="quick-edit">
											<td colspan="6" >
												<p>Quick Edit</p>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<i class="tgl_post">Judul</i>
															<input type="text" class="form-control quick_judul_post">

														</div>
														<div class="form-group">
															<i class="tgl_post">Password</i>
															<input type="text" class="form-control quick_pass_post">

														</div>
													</div>	
													<div class="col-lg-4">
														<i class="tgl">Kategori</i>
														<div class="panel panel-default">

															<div class="panel-body">
																<?php 
																	foreach ($table['kategori_list'] as $row) {
																		echo $row;
																	}
																 ?>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<i class="tgl">Tags</i>
															<textarea class="form-control quick_tag_post" ></textarea>
														</div>

														<input type="checkbox" class="quick_komen_post" value="1"> <i class="tgl"> Bolehkan Komentar</i> &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="quick_sticky_post" value="1"> <i class="tgl"> Sticky Post</i><br><br>
														<i class="tgl">Status</i>
														<select name="" class="quick_status_post">
											                <option value="publish">Publish</option>
											                <option value="pending">Pending</option>
											                <option value="draft">Draft</option>
											            </select>		

													</div>
												</div><br>
												<button class="btn-default pull-left batal-quick-edit">Batal</button>
												<div class=" pull-right">
													<img class="loading-img" src="<?php echo  base_url('assets/css/images/loading.gif')?>" alt="" style="height:20px;">&nbsp;&nbsp;
													<button class="btn-primary pull-right post_quick_update">Update</button>
												</div>
											</td>
										</tr>

									<?php 
										if (isset($table['tr_table'])) {
												foreach ($table['tr_table'] as $row) {
												echo $row;
											}
										}
										else{
											echo "<tr><td>Post tidak di temukan</td></tr>";
										}

									 ?>

									</tbody>
									<tfoot >
										<tr>
											<?php echo $table['head_table']; ?>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>

	</div>

	<div class="row">
					<div class="col-lg-6">
						<form action="">
							<div class="form-inline">
 							<select name="allpost" id="allpost" class="form-control">
                                <option value="bulk">Aksi massal</option>
                                <option value="edit_post">Edit</option>
                                <option value="trash">Move to trash</option>
                            </select>
                            <button class="btn btn-default">Apply</button>
                        </div>
						</form>
					</div>
		<?php echo $table['pagination'] ?>
	</div>	

<?php 

?>