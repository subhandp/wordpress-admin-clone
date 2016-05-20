    $(document).on('click','#btn-more',function(){
        var $btn=$(this);
        var offset= $btn.attr('offset');
        $.ajax({
            type:'POST',
            url:base_url+'admin/proses_home/widget_activity_komentar',
            data:'offset='+offset,
            dataType:"json",
            beforeSend:function(){
                    $btn.button('loading');
                },
            error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
            success:function(data){
                setTimeout(function(){
                    $('.btn-block').remove();
                    for (var i = 0; i < data.komen.length; i++) {
                        $('.activity_komen-body').append(data.komen[i]);  
                    };
                if (data.more) {
                    $('.btn-more').append(data.more);
                    console.log(data.more); 
                }
                },500);

            }
        });
        
    });

        $(document).on('click','#save-draft',function(){
            var $btn=$(this);          
            var draft={
                judul:$('#qjudul').val(),
                isi:$('#qisi').val(),
                ajax_draft:'1'
            };
            $.ajax({
                type:'POST',
                url:base_url+'admin/proses_home/widget_quickdraft',
                data: draft,
                dataType:"json",
                beforeSend:function(){
                    $btn.button('loading');
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
                success:function(data){
                    setTimeout(function(){
                        if (data.drafts) {
                            $('.isi-drafts').append(data.drafts);
                            console.log(data); 
                        }
                        $('#qjudul').val('');
                        $('#qisi').val('');
                        $btn.button('reset');
                    },500);

                }
            });
            
        });

        $(document).on('click','.link-app',function(){   
            var tr= $(this).parents('tr');    
            if ($(this).parents('tr').hasClass('homeunapproved')) {
                tr.removeClass('homeunapproved');
                tr.animate({backgroundColor: '#ccf1cd'});
                tr.animate({backgroundColor: 'white'});
                tr.removeClass('appm');
                $(this).addClass('unappm');
                $(this).text('unapproved');     
                var data={
                    id_komen:$(this).attr('id'),
                    jenis:'approved',
                    ajax:'2'
                }
            }
            else{
                tr.animate({backgroundColor: '#fff3e6'});
                tr.addClass('homeunapproved');
                $(this).removeClass('unappm');
                $(this).addClass('appm');
                $(this).text('approved');
                var data={
                    id_komen:$(this).attr('id'),
                    jenis:'unapproved',
                    ajax:'2'
                }
            }
            $.ajax({
                type:'POST',
                url:base_url+'admin/proses_home/activity_template_update_komentar',
                data: data,
                dataType:"json",
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
                success:function(data){
                    $('.kpending').text(data.komen_num[0]);
                    $('.kapprove').text(data.komen_num[1]);
                    $('.ktrash').text(data.komen_num[2]);

                }
            });
            
        });

        $(document).on('click','.trashm',function(){        
            var trash={
                id_komen:$(this).attr('id'),
                jenis:'trash',
                ajax:'3'
            };
            var kelas=$(this).parents('tr').attr('class');
            var tr=$(this).parents('tr');
            tr.removeClass();
            tr.attr('siblingclass', kelas);
            $(this).parents('div .komenshow').hide();
            $(this).parents('div .komenshow').next().show();

            $.ajax({
                type:'POST',
                url:base_url+'admin/proses_home/activity_template_update_komentar',
                data: trash,
                dataType:"json",
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
                success:function(data){
                    $('.kpending').text(data.komen_num[0]);
                    $('.kapprove').text(data.komen_num[1]);
                    $('.ktrash').text(data.komen_num[2]);

                }
            });
            
        });

        $(document).on('click','.undo-komen',function(){        
            var undo={
                id_komen:$(this).attr('id'),
                jenis:'undo-trash',
                ajax:'3'
            };
            var siblingclass=$(this).parents('tr').attr('siblingclass');
            var tr=$(this).parents('tr');
            tr.attr('siblingclass','');
            tr.addClass(siblingclass);
            $(this).parents('div .komentrash').hide();
            $(this).parents('div .komentrash').prev().show();
            console.log(siblingclass);
            $.ajax({
                type:'POST',
                url:base_url+'admin/proses_home/activity_template_update_komentar',
                data: undo,
                dataType:"json",
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
                success:function(data){
                    $('.kpending').text(data.komen_num[0]);
                    $('.kapprove').text(data.komen_num[1]);
                    $('.ktrash').text(data.komen_num[2]);

                }
            });
            
        });

