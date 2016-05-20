        $(document).on('click','.quick-edit-a',function(){ 
                var quick_edit=$('tr.quick-edit'),post_data=[]; 
                $('tr.massal-edit').hide();
                $('.data-edit').show();
                $(this).parents('tr').after(quick_edit);
                quick_edit.prev().hide();
                quick_edit.show();

                post_data['pass']=quick_edit.prev().attr('pass');
                post_data['sticky']=quick_edit.prev().attr('sticky');
                post_data['id']=quick_edit.prev().attr('id');
                post_data['komen']=quick_edit.prev().attr('komen');
                post_data['judul']=quick_edit.prev().find('a.judul_post').text().split("-")[0];
                post_data['kategori']=quick_edit.prev().find('.kategori_post').attr('id-kategori');
                post_data['tags']=quick_edit.prev().children('.tag_post').text();
                post_data['status']=quick_edit.prev().attr('status');;

                if (post_data['judul']!='(no title) ') {
                    $('input.quick_judul_post').val(post_data['judul']);
                }else{
                    $('input.quick_judul_post').val("");
                }
                
                $('input.quick_pass_post').val(post_data['pass']);
                $('textarea.quick_tag_post').val(post_data['tags']);
                if (post_data['komen']=='1') {
                    $('input.quick_komen_post').prop('checked', true);
                }else{
                    $('input.quick_komen_post').prop('checked', false);
                }

                if (post_data['sticky']=='1') {
                    $('input.quick_sticky_post').prop('checked', true);
                }else{$('input.quick_sticky_post').prop('checked', false);}

                quick_edit.find('input:radio[name=kategori_post]').each(function() {
                    if ($(this).val()==post_data['kategori']) {
                        $(this).prop('checked', true);
                    }else{
                        $(this).prop('checked', false);
                    }
                });
                $('select.quick_status_post').val(post_data['status']);
                quick_edit.attr('id_post',post_data['id']);
                console.log(post_data);

        });

        $(document).on('click','button.post_quick_update',function(){ 
            var update_data_quick={};
            var current=$(this);
            update_data_quick['id_post']=$('tr.quick-edit').attr('id_post');
            update_data_quick['judul_post']=$('input.quick_judul_post').val();
            update_data_quick['status_post']=$('select.quick_status_post').val();
            update_data_quick['pass_post']=$('input.quick_pass_post').val();
            if ($('input.quick_komen_post').is(':checked')) {
                update_data_quick['komen_post']='1';
            }else{
                update_data_quick['komen_post']='0';
            }

            if ($('input.quick_sticky_post').is(':checked')) {
                update_data_quick['sticky_post']='1';
            }else{
                update_data_quick['sticky_post']='0';
            }
            update_data_quick['kategori_post']=$('tr.quick-edit').find('input:radio[name=kategori_post]:checked').val();
            update_data_quick['tags_post']=$('textarea.quick_tag_post').val().split(",");

            console.log(update_data_quick);
            $.ajax({
                type:'POST',
                url:base_url+'admin/proses_post/post_quick_bulk_edit',
                data: {
                    ajax:'4',
                    quick_data:JSON.stringify(update_data_quick)
                },
                beforeSend:function(){
                    $('img.loading-img').show();
                },
                dataType:"html",
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
                success:function(data){
                    console.log(data);
                    setTimeout(function() {
                        current.parents('tr').prev().replaceWith(data);
                        current.parents('tr').prev().animate({backgroundColor: '#ccf1cd'});
                        current.parents('tr').prev().animate({backgroundColor: 'white'});
                        current.parents('tr').prev().show();
                        $('tr.quick-edit').hide(); 
                        $('img.loading-img').hide();
                    }, 500);
                }
            });
        });



        $(document).on('click','button.post_bulk_update',function(){  
            var update_bulk_data={},id_bulk=[];
            if ($('a.clstag').length) {
                $('a.clstag').each(function() {
                    id_bulk.push($(this).attr('id_post'));
                });     
                update_bulk_data['id_post']=id_bulk;
            }else{update_bulk_data['id_post']=false;}

            if ($('tr.massal-edit').find('input:radio[name=kategori_post]').is(':checked')) {
                update_bulk_data['kategori_post']=$('tr.massal-edit').find('input:radio[name=kategori_post]:checked').val();
            }else{update_bulk_data['kategori_post']=false;}

            if ($('textarea.bulk_tag_post').val()!="") {
                update_bulk_data['tags_post']=$('textarea.bulk_tag_post').val().split(",");
            }else{update_bulk_data['tags_post']=false;}


            if ($('select.bulk_sticky_post').val()=="none") {update_bulk_data['sticky_post']=null;}
                else{update_bulk_data['sticky_post']=$('select.bulk_sticky_post').val();}
            if ($('select.bulk_komen_post').val()=="none") {update_bulk_data['komen_post']=null;}
                else{update_bulk_data['komen_post']=$('select.bulk_komen_post').val();}
            if ($('select.bulk_status_post').val()=="none") {update_bulk_data['status_post']=false;}
                else{update_bulk_data['status_post']=$('select.bulk_status_post').val();}
            console.log(update_bulk_data);
            $.ajax({
                type:'POST',
                url:base_url+'admin/proses_post/post_quick_bulk_edit',
                data: {
                    ajax:'5',
                    bulk_data:JSON.stringify(update_bulk_data)
                },

                beforeSend:function(){
                    $('img.loading-img').show();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
                success:function(){
                    location.reload();
                }
            });
        });



        $(document).on('click','.btn-bulk',function(){ 
            var pil=$('#bulk-post').val();
            var selected= [];
            if (pil=='edit_post') {

                $("input:checkbox[name=check-post]:checked" ).each(function() {
                    selected.push([$(this).parents('tr').attr('id'),$(this).parents('tr').find('a.judul_post').text().split("-")[0]]);
                });
                if (selected.length>0) {
                    $('tr.quick-edit').hide();
                    $('tr.quick-edit').prev().show(); 
                    $('tr.massal-edit').show();
                    $('tr.massal-edit').prop('value', selected);
                    $('div.list-tags').empty();
                    for (var i = 0; i < selected.length; i++) {
                        var judul='<div><a href="javascript:void(0);" class="fa fa-times-circle-o fa-fw clstag" id_post='+selected[i][0]+'></a><span> '+selected[i][1]+'</span></div>';
                        $('div.list-tags').append(judul);
                    };
                };
            }
            else if(pil=="trash_post"){
                $("input:checkbox[name=check-post]:checked" ).each(function() {
                    selected.push($(this).parents('tr').attr('id'));
                });
                if (selected.length>0) {
                    $.ajax({
                        type:'POST',
                        url:base_url+'admin/proses_post/ke_trash',
                        data: {
                            ajax:'6',
                            trash_data:JSON.stringify(selected)
                        },
                        beforeSend:function(){
                            $('img.loading-img').show();
                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                        },
                        success:function(){
                            location.reload();
                        }
                    });
                    console.log(JSON.stringify(selected));
                };                
            }

        });


        $(document).on('click','a.trash_post_a',function(){        
            var selected= [];
            selected.push($(this).parents('tr').attr('id'));
            $.ajax({
                type:'POST',
                url:base_url+'admin/proses_post/ke_trash',
                data: {
                    ajax:'7',
                    trash_data:JSON.stringify(selected)
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
                success:function(){
                    location.reload();
                }
            });
        });


        $(document).on('click','.batal-quick-edit',function(){  
            $(this).parents('tr').prev().show();
            $('tr.quick-edit').hide();      
        });


        $(document).on('click','.batal-massal-edit',function(){        
            $('tr.massal-edit').hide();
        });


        $(document).on('click','.clstag',function(){        
            $(this).parent().remove();
        });


        $(document).on('click change','input:checkbox[name=check-all]',function(){        
            if ($('input:checkbox[name=check-all]').is(':checked')) {
                $("input:checkbox[name=check-all]").prop('checked', this.checked);
                $("input:checkbox[name=check-post]").prop('checked', this.checked);
            };
        });


        order=$('input.arrow-kondisi').attr('order');
        kolom=$('input.arrow-kondisi').attr('kolom');

        function arrow_sort(elm_sort,elm_n_sort,j_sort,j_n_sort){
            $(elm_sort).addClass(j_sort);
            $(elm_n_sort).addClass('fa-unsorted');
            $(elm_sort).removeClass('fa-unsorted '+j_n_sort);
            $(elm_n_sort).romoveClass('fa-sort-asc fa-sort-desc');            
        }
        
        if (order=='desc' && kolom=='judul_post') {
            arrow_sort('i.judul-arrow','i.waktu-arrow','fa-sort-desc','fa-sort-asc');
        }
        else if(order=='asc' && kolom=='judul_post'){
            arrow_sort('i.judul-arrow','i.waktu-arrow','fa-sort-asc','fa-sort-desc');
        }
        else if(order=='asc' && kolom=='waktu_post'){
            arrow_sort('i.waktu-arrow','i.judul-arrow','fa-sort-asc','fa-sort-desc');
        }
        else if(order=='desc' && kolom=='waktu_post'){
            arrow_sort('i.waktu-arrow','i.judul-arrow','fa-sort-desc','fa-sort-asc');
        }         

        var list='button.btn-list',detail='button.btn-detail';
        $(document).on('click',list,function(){        
            localStorage.setItem("view_post", 'btn-list');
            btn_list();
        });
        $(document).on('click',detail,function(){        
            localStorage.setItem("view_post", 'btn-detail');
            btn_detail();
        });

        var view_post=localStorage.getItem("view_post");
        if (view_post!=null) {
            if (view_post=='btn-list') {
                btn_list();
            }else{
                btn_detail();
            }
        }else{btn_list();}

        function btn_list(){
            $('button.btn-detail').removeClass('active');
            $(list).addClass('active');   
            $('div.isi_post_quick').hide();
        }
        function btn_detail(){
            $('button.btn-list').removeClass('active');
            $(detail).addClass('active');
            $('div.isi_post_quick').show();             
        }
