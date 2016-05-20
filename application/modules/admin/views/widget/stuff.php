                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-list-alt "></i>  Your Stuff
                                        </div>
                                        <div class="panel-body ">
                                            <?php 
                                                //echo $stuff;
                                                $a=0;
                                                $jml=count($stuff);
                                                foreach ($stuff as $val ) {
                                                    $a++;
                                                    echo $val;
                                                    if ($jml!=$a) {
                                                        echo "<hr>";
                                                    }
                                                    
                                                }
                                             ?>

                                        </div>
                                    </div>


