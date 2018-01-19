var dialog = {
    // 错误弹出层
    error: function(message) {
        layer.open({
            content:message,
            icon:2,
            title : ['错误提示','font-weight:600;color:red;'],
        });
    },

    //成功弹出层1
    success : function(message,url) {
        layer.open({
            content : message,
            icon : 1,
            title : ['成功提示','font-weight:600;color:green;'],
            yes : function(){
                location.href=url;
            },
        });
    },


    //成功弹出层1
    Timesuccess : function(message,url) {
        layer.open({
            content : message,
            icon : 1,
            time: 3000,
            title : ['成功提示','font-weight:600;color:green;'],
            yes : function(){
                location.href=url;
            },
        });
    },

    //成功弹出层2
    finish : function(message) {
        layer.open({
            content : message,
            icon : 1,
            title : ['成功提示','font-weight:600;color:green;'],
            
        });
    },
    // 确认弹出层
    confirm : function(message, url) {
        layer.open({
            content : message,
            icon:3,
            btn : ['是','否'],
            yes : function(){
                location.href=url;
            },
        });
    },

    //无需跳转到指定页面的确认弹出层
    toconfirm : function(message) {
        layer.open({
            content : message,
            icon : 1,
            btn : ['确定'],
        });
    },

   //iframe层
    col : function(title,url){
        layer.open({
              type: 2,
              title: title,
              shade: [0],
              area: ['90%', '90%'],
              offset: 'rb', //右下角弹出
              anim: 2,
              shadeClose : true,
              shade : false,
              maxmin:true,
              resize : true,
              content: url, //iframe的url，no代表不显示滚动条
            
         });
    },

    //tips层
    okay : function(message,time){
          layer.msg(message, {
              icon: 5,
              time: time
              });
    }
}

