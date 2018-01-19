/**
 * Created by Administrator on 2017/12/12 0012.
 */

//图书馆管理->图书馆列表->编辑
$(function () {
    $(".example10").click(function(){
        //获取图书馆ID
        var id = $(this).attr('attr-id');
        //操作系统
        var sys = $(this).attr('attr-sys');
        var html = '';
        //获取数据
        $.ajax({
            type:'get',
            url:getRoot()+'/Library/select.html',
            data:'id='+id,
            dataType:'json',
            success:function(data){
                console.log(data);
                if(data.code == 1){
                    html += '<form id="edit">\
                            <div class="lib_id outer lib_commmon">\
                                <p>图书馆ID：</p>\
                            <input type="text" name="id" value="'+data.data['id']+'"/>\
                                </div>\
                                <div class="lib_name outer lib_sel">\
                                <p>图书馆名称：</p>\
                            <input type="text" name="name" value="'+data.data['name']+'"/>\
                                </div>\
                                <div class="lib_num outer lib_commmon">\
                                <p>可借数量：</p>\
                            <input type="text" name="max_lend_times" value="'+data.data['max_lend_times']+'"/>\
                                </div>\
                                <div class="lib_num outer lib_sel">\
                                <p>管理系统：</p>\
                        <select name="sys_type">';
                            for(var i=0;i < data.data[0].length;i++){
                                console.log(data.data[0][i]);
                                if(data.data[0][i]['name'] == sys){
                                    html += '<option value="'+data.data[0][i]['id']+'" selected>'+data.data[0][i]['name']+'</option>';
                                }else {
                                    html += '<option value="'+data.data[0][i]['id']+'">'+data.data[0][i]['name']+'</option>';
                                }
                            }
                        html += '</select>\
                                </div>\
                                <div class="lib_btns outer">\
                                    <div class="lib_sure" id="editLibBtn">确定</div>\
                                    <div class="lib_close close_btn">取消</div>\
                                    </div>\
                                    </form>';

                    $('#editLib').html(html);
                    //修改点击
                    $('#editLibBtn').click(function(){
                        var data = $('#edit').serialize();
                        //修改数据
                        $.ajax({
                            type:'post',
                            url:getRoot()+'/Library/editLib.html',
                            data:data,
                            dataType:'json',
                            success:function(data){
                                console.log(data);
                                if(data.code == 1){
                                    var url = getRoot()+"/Library/index.html";
                                    return dialog.success('修改成功',url);
                                }else {
                                    return dialog.error(data.message);
                                }
                            }
                        });
                    });

                    //关闭
                    $(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
                        $("#LoginBox10").fadeOut("fast");
                        $("#mask10").css({ display: 'none' });
                    });

                }else{
                    return dialog.error(data.message);
                }
            }
        })
    })
});

//图书馆管理->机器列表->编辑弹框
$(function () {
    $(".example14").click(function () {
        //获取机器ID
        var machId = $(this).attr('attr-machId');
        var html = '';
        //获取数据
        $.ajax({
            type:'get',
            url:getRoot()+'/Library/machOne.html',
            data:'machId='+machId,
            dataType:'json',
            success:function(data){
                console.log(data);
                if(data.code == 1){
                    html += '<form id="edit">\
                    <input type="hidden" name="library_id" id="libId" value="'+data.data['library_id']+'">\
                    <ul class="outer">\
                        <li class="lib">\
                        <p>图书馆：</p><span>'+data.data['library']+'</span>\
                    </li>\
                    <li>\
                    <p>机器ID：</p>\
                    <input type="text" name="machine_id" value="'+data.data['machine_id']+'"/>\
                        </li>\
                        <li>\
                        <p>地址：</p>\
                    <input type="text"  name="machine_addr" value="'+data.data['machine_addr']+'" />\
                        </li>\
                        <li>\
                        <p>机器名称：</p>\
                    <input type="text"  name="machine_name" value="'+data.data['machine_name']+'" />\
                        </li>\
                        <li>\
                        <p>状态：</p>\
                    <select  name="machine_state">';
                    if(data.data['machine_state'] == 1){
                        html += '<option value="1" selected>正常</option>\
                            <option value="0">删除</option>';
                    }else {
                        html += '<option value="1">正常</option>\
                            <option value="0" selected>删除</option>';
                    }
                    html += '</select>\
                    </li>\
                    <li>\
                    <p>经度：</p>\
                    <input type="text"  name="gps_latitude" value="'+data.data['gps_latitude']+'" />\
                        </li>\
                        <li>\
                        <p>类型：</p>\
                    <select name="machine_type">';
                        if(data.data['machine_type'] == 1){
                            html += '<option value="1" selected>智能微图</option>\
                            <option value="2">图书馆</option>';
                        }else {
                            html += '<option value="1">智能微图</option>\
                            <option value="2" selected>图书馆</option>';
                        }
                        html +='</select>\
                        </li>\
                        <li>\
                        <p>纬度：</p>\
                    <input type="text"  name="gps_longitude" value="'+data.data['gps_longitude']+'"/>\
                        </li>\
                        </ul>\
                        <div class="catalog_btn outer">\
                        <div class="catalog_sure" id="editMachBtn">确定</div>\
                        <div class="catalog_close close_btn">取消</div>\
                        </div>\
                        </form>';

                    $('#editMach').html(html);


                    //修改
                    $('#editMachBtn').click(function(){
                        var data = $('#edit').serialize();
                        var libId = $('#libId').val();
                        //修改数据
                        $.ajax({
                            type:'post',
                            url:getRoot()+'/Library/editMach.html',
                            data:data,
                            dataType:'json',
                            success:function(data){
                                console.log(data);
                                if(data.code == 1){
                                    var url = getRoot()+"/Library/mach.html?libId="+libId;
                                    return dialog.success('修改成功',url);
                                }else {
                                    return dialog.error(data.message);
                                }
                            }
                        });
                    });


                    //关闭
                    $(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
                        $("#LoginBox14").fadeOut("fast");
                        $("#mask14").css({ display: 'none' });
                    });

                }else {
                    return dialog.error(data.message);
                }
            }
        });

    });
});




//图书馆管理->API列表->编辑弹框
$(function () {
    $(".example13").click(function () {
        //获取ApiID
        var apiId = $(this).attr('attr-apiId');
        var html = '';
        //获取数据
        $.ajax({
            type:'get',
            url:getRoot()+'/Library/apiOne.html',
            data:'apiId='+apiId,
            dataType:'json',
            success:function(data){
                console.log(data);
                if(data.code == 1){
                    html += '<form id="edit">\
                    <input type="hidden" name="api_id" value="'+data.data['api_id']+'">\
                    <div class="api_name outer">\
                        <p>图书馆：</p><span>'+data.data['library']+'</span>\
                        <input type="hidden" name="library_id" id="libId" value="'+data.data['library_id']+'">\
                    </div>\
                    <div class="api_status outer">\
                        <p>状态：</p>\
                    <input type="text" name="api_type_id" value="'+data.data['api_type_id']+'"/>\
                        </div>\
                        <div class="api_url outer">\
                        <p>URL地址：</p>\
                    <textarea name="api_url">'+data.data['api_url']+'</textarea>\
                    </div>\
                    <div class="lib_btns outer">\
                        <div class="lib_sure" id="editApiBtn">确定</div>\
                        <div class="lib_close close_btn">取消</div>\
                        </div>\
                        </form>';

                    $('#editApi').html(html);


                    //修改
                    $('#editApiBtn').click(function(){
                        var data = $('#edit').serialize();
                        var libId = $('#libId').val();
                        //修改数据
                        $.ajax({
                            type:'post',
                            url:getRoot()+'/Library/editApi.html',
                            data:data,
                            dataType:'json',
                            success:function(data){
                                console.log(data);
                                if(data.code == 1){
                                    var url = getRoot()+"/Library/api.html?libId="+libId;
                                    return dialog.success('修改成功',url);
                                }else {
                                    return dialog.error(data.message);
                                }
                            }
                        });
                    });


                    //关闭
                    $(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
                        $("#LoginBox13").fadeOut("fast");
                        $("#mask13").css({ display: 'none' });
                    });

                }else {
                    return dialog.error(data.message);
                }
            }
        });

    });
});



















