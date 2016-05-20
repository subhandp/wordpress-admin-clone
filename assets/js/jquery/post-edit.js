
        var visibility_default=$('input#hidden-default').attr('visibility-default');
        var status_default=$('input#hidden-default').attr('status-default');

        publish_visibility(visibility_default);
        status_text('visibility',visibility_default);

        publish_status(status_default);
        status_text('status',status_default);

        function publish_status(status){
            var option=$('select[name=ppublished]').children('option').length

            switch(option){
                case 2: //option berjumlah 2 pada page post new
                    var index= status=='pending' ? 0 : status=='draft' ? 1 : null;
                    break;
                case 3: //option berjumlah 3 pada page post edit
                    var index= status=='publish' ? 0 : status=='pending' ? 1 : status=='draft' ? 2 : null;
                    break;
            }

            $('select[name=ppublished]').prop('selectedIndex', index);
        }

        function publish_visibility(btn){
            if (btn=='public'||btn=='public_sticky') {

                var stick= btn=='public_sticky' ? true : false; //jika benar checklist sticky post
                $('.ppublic').collapse('show'); 
                $('.ppass').collapse('hide'); 
                $('#public-click').prop('checked', true); 
                $('input.post-n-stick').prop('checked', stick); 
                 
            }
            else if(btn=='password'){

                $('.ppublic').collapse('hide'); 
                $('.ppass').collapse('show'); 
                $('#pass-click').prop('checked', true);
                $('input.post-n-input-pass').val($('input#hidden-default').attr('pass'));
                   
            }  
  
        }


        function status_text(publish_action,text){
            var selector= publish_action=='visibility' ? '#pvisibility' : '.ppublished'; 
            var selector_text= publish_action=='status' ? '#post-n-status' : '#post-n-visi';
            var edit_element= publish_action=='visibility' ? '.btn-edit-visibility' : '.btn-edit-status';

            if (text=='public'||text=='public_sticky') { $('input.post-n-input-pass').val(''); }; //hapus isi password jika public/public_sticky di pilih

            switch(text){
                case 'publish': text='Published'; break;
                case 'pending': text='Pending Preview'; break;
                case 'draft': text='Draft'; break;
                case 'public': text='Public'; break;
                case 'public_sticky': text='Public, Sticky'; break;
                case 'password': text='Password Protected'; break;
            }

            $(selector).collapse('hide'); 
            $(selector_text).text(text);
            $(edit_element).show();
        }


        $(document).on('click','.btn-cancel',function(){  
            if ($(this).hasClass('cancel-visibility')) {

                status_text('visibility',visibility_default);
                publish_visibility(visibility_default);


            }else if($(this).hasClass('cancel-status')){

                status_text('status',status_default);
                publish_status(status_default);

            }
            
        });



        $(document).on('click','.post-n-status-btn',function(){  

                status_text('status',$('select[name=ppublished]').val());
        });



        $(document).on('click','.post-n-visi-btn',function(){  

            if ($('#public-click').is(':checked')) {
                if ($('input.post-n-stick').is(':checked')) {
                    status_text('visibility','public_sticky');
                }else{
                    status_text('visibility','public');
                }

            }
            else if ($('#pass-click').is(':checked') && $.trim($('input.post-n-input-pass').val())!='') {
                status_text('visibility','password');
            };
            
        });




        $(document).on('click','button.post-n-tag-btn',function(){  
            var tag=$(this).prev().val();
            var tags=tag.split(',');
            if ($.trim(tag)!='') {
                $(this).prev().val('');
                for (var i = 0; i < tags.length; i++) {
                    if ($.trim(tags[i])!='') {
                        $('div.post-n-list-tags').append('<span><a href="javascript:void(0);" class="fa fa-times-circle-o clstag post-n-clstag"></a><span> '+tags[i]+'</span>&nbsp;&nbsp;&nbsp;<input type="hidden" name="input_tag[]" value='+tags[i]+' /></span>');
                    };
                    
                };
                
            }  
        });

        $(document).on('click','a.post-n-clstag',function(){  
            $(this).parent().remove();
        });



        $(document).on('click','button.post-n-kategori-btn',function(){  
            var kategori=$(this).prev().val();
            $.ajax({
                type:'POST',
                url:base_url+'admin/proses_post_new/get_kategori',
                data: {
                    ajax:'8',
                    kategori
                },
                dataType:"html",
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
                success:function(kategori){
                    console.log(kategori);
                    $('div.panel-kategori').append(kategori);
                    $('div.panel-kategori').find('p').last().animate({backgroundColor: '#ccf1cd'});
                    $('div.panel-kategori').find('p').last().animate({backgroundColor: 'white'});
                    $('input.post-n-kategori-input').val('');
                }
            }); 
        });


        $(document).on('click','i.fa-minimize',function(){  
            if ($(this).hasClass('fa-caret-up')) {
                $(this).removeClass('fa-caret-up');
                $(this).addClass('fa-caret-down');
            }else{
                $(this).removeClass('fa-caret-down');
                $(this).addClass('fa-caret-up');
            }
        });


        $(document).on('click','#public-click',function(){  
            $('.ppass').collapse('hide');   
        });


        $(document).on('click','#pass-click',function(){  
            $('.ppublic').collapse('hide');   
            $('input.post-n-stick').prop('checked', false);
        });


        $(document).on('click','.btn-edit-status, .btn-edit-visibility',function(){  
            $(this).hide();
            $('.btn-cancel').show();
        });





