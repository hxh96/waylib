$(function(){
	$(".a1").mouseenter(function(){
		$(".icon1").hide();
		$(".icon11").show();
	})
	$(".a1").mouseleave(function(){
		$(".icon11").hide();
		$(".icon1").show();
	})
	$(".a2").mouseenter(function(){
		$(".icon2").hide();
		$(".icon22").show();
	})
	$(".a2").mouseleave(function(){
		$(".icon22").hide();
		$(".icon2").show();
	})
	$(".a3").mouseenter(function(){
		$(".icon3").hide();
		$(".icon33").show();
	})
	$(".a3").mouseleave(function(){
		$(".icon33").hide();
		$(".icon3").show();
	})
	$(".a4").mouseenter(function(){
		$(".icon4").hide();
		$(".icon44").show();
	})
	$(".a4").mouseleave(function(){
		$(".icon44").hide();
		$(".icon4").show();
	})
	
	$(".a5").mouseenter(function(){
		$(".icon5").hide();
		$(".icon55").show();
	})
	$(".a5").mouseleave(function(){
		$(".icon55").hide();
		$(".icon5").show();
	})
	
	$(".a6").mouseenter(function(){
		$(".icon6").hide();
		$(".icon66").show();
	})
	$(".a6").mouseleave(function(){
		$(".icon66").hide();
		$(".icon6").show();
	})
	
	$(".a7").mouseenter(function(){
		$(".icon7").hide();
		$(".icon77").show();
	})
	$(".a7").mouseleave(function(){
		$(".icon77").hide();
		$(".icon7").show();
	})
	$(".a8").mouseenter(function(){
		$(".icon8").hide();
		$(".icon88").show();
	})
	$(".a8").mouseleave(function(){
		$(".icon88").hide();
		$(".icon8").show();
	})
	$(".a9").mouseenter(function(){
		$(".icon9").hide();
		$(".icon99").show();
	})
	$(".a9").mouseleave(function(){
		$(".icon99").hide();
		$(".icon9").show();
	})
})



//添加管理员弹框
$(function ($) {
		$("#example").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask'></div>");
			$("#mask").addClass("mask").fadeIn("slow");
			$("#LoginBox").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox").fadeOut("fast");
			$("#mask").css({ display: 'none' });
		});
});
//管理员信息查看弹框
$(function ($) {
		$(".example1").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask1'></div>");
			$("#mask1").addClass("mask").fadeIn("slow");
			$("#LoginBox1").fadeIn("slow");


		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox1").fadeOut("fast");
			$("#mask1").css({ display: 'none' });
		});
});
$(function () {
	$(".example1").click(function(){
		$('#Photo').attr('src',$(this).data("photo"));
		$('#Name').html($(this).data("name"));
		$('#Gender').html($(this).data("gender")==1?'男':'女');
		$('#Role').html($(this).data("lib"));
		$('#Mobile').html($(this).data("phone"));
		$('#Last').html($(this).data("last"));
		$('#updateData').attr('attr-userid',$(this).data("userid"));
		//$('#updateData').attr('attr-status',);

		var userId = $(this).data("userid");
		var status = $(this).data("status");
		var html = '';
		if(status == 1){
			html = '<a href="javaScript:;">\
						<img src="'+getRoot()+'/Public/Run/img/ftgly.png" attr-status="'+status+'" id="statusBtn"/>\
						<p>封停管理员</p>\
					</a>';
			var newStatus = 0;
		}else {
			html = '<a href="javaScript:;">\
						<img src="'+getRoot()+'/Public/Run/img/qygly.png" attr-status="'+status+'" id="statusBtn"/>\
						<p>启用管理员</p>\
					</a>';
			var newStatus = 1;
		}
		$('#checkStatus').html(html);
		$('#statusBtn').on('click', function () {
			layer.open({
				content: '确认执行该操作?',
				icon: 3,
				btn: ['是', '否'],
				yes: function () {
					$.ajax({
						type:'post',
						url:getRoot()+"/User/checkStatus.html",
						data:'user_id='+userId+'&status='+newStatus,
						dataType:'json',
						success:function(data){
							if(data.code == 1){
								var url = getRoot()+"/User/administer.html";
								return dialog.success('操作成功',url);
							}else {
								return dialog.error(data.message);
							}
						}
					})
				}
			});
		});
	})
})
//选中
$(function(){
				
	$(".main_left_ul ul li").click(function(){
		$(this).addClass("onup").siblings().removeClass("onup");
	})
})
//头部选中
//$(function(){
//	$(".main_right_top ul li").click(function(){
//		$(this).addClass("on").siblings().removeClass("on");
//		$(this).find("a").find(".icon2").show()
//		$(this).siblings().find("a").find(".icon2").hide();
//		$(this).find("a").find(".icon1").hide()
//		$(this).siblings().find("a").find(".icon1").show();
//	})
//})

//读者详情
$(function(){		
	$(".info_right_bottom li").click(function(){
		$(this).addClass("up").siblings().removeClass("up");
	})
})

//修改排序
$(function ($) {
		$(".example2").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask2'></div>");
			$("#mask2").addClass("mask").fadeIn("slow");
			$("#LoginBox2").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox2").fadeOut("fast");
			$("#mask2").css({ display: 'none' });
		});
});
$(function () {
	$(".example2").click(function(){
		var zz=$(this).data("book_id");
		$('#sort_btn').attr('attr-book_id',zz);
	})
})
//添加专题
$(function ($) {
		$(".example3").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask3'></div>");
			$("#mask3").addClass("mask").fadeIn("slow");
			$("#LoginBox3").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox3").fadeOut("fast");
			$("#mask3").css({ display: 'none' });
		});
});
//专题 编辑
$(function ($) {
		$(".example4").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask4'></div>");
			$("#mask4").addClass("mask").fadeIn("slow");
			$("#LoginBox4").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox4").fadeOut("fast");
			$("#mask4").css({ display: 'none' });
		});
});

//添加图书
$(function($) {
		$(".example5").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask5'></div>");
			$("#mask5").addClass("mask").fadeIn("slow");
			$("#LoginBox5").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox5").fadeOut("fast");
			$("#mask5").css({ display: 'none' });
		});
});

//编辑书目
$(function($) {
		$(".example6").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask6'></div>");
			$("#mask6").addClass("mask").fadeIn("slow");
			$("#LoginBox6").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox6").fadeOut("fast");
			$("#mask6").css({ display: 'none' });
		});
});


//新增书目
$(function($) {
		$(".example7").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask7'></div>");
			$("#mask7").addClass("mask").fadeIn("slow");
			$("#LoginBox7").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox7").fadeOut("fast");
			$("#mask7").css({ display: 'none' });
		});
});

//增加藏书开始
$(function($) {
		$(".example8").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask8'></div>");
			$("#mask8").addClass("mask").fadeIn("slow");
			$("#LoginBox8").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox8").fadeOut("fast");
			$("#mask8").css({ display: 'none' });
		});
});

//订阅管理

$(function($) {
		$(".example9").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask9'></div>");
			$("#mask9").addClass("mask").fadeIn("slow");
			$("#LoginBox9").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox9").fadeOut("fast");
			$("#mask9").css({ display: 'none' });
		});
});
//编辑图书馆

$(function($) {
		$(".example10").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask10'></div>");
			$("#mask10").addClass("mask").fadeIn("slow");
			$("#LoginBox10").fadeIn("slow");
		});

});
//新增图书馆
$(function($) {
		$(".example11").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask11'></div>");
			$("#mask11").addClass("mask").fadeIn("slow");
			$("#LoginBox11").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox11").fadeOut("fast");
			$("#mask11").css({ display: 'none' });
		});
});
//新增api
$(function($) {
		$(".example12").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask12'></div>");
			$("#mask12").addClass("mask").fadeIn("slow");
			$("#LoginBox12").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox12").fadeOut("fast");
			$("#mask12").css({ display: 'none' });
		});
});
//编辑api
$(function($) {
		$(".example13").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask13'></div>");
			$("#mask13").addClass("mask").fadeIn("slow");
			$("#LoginBox13").fadeIn("slow");
		});

});
//编辑机器
$(function($) {
		$(".example14").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask14'></div>");
			$("#mask14").addClass("mask").fadeIn("slow");
			$("#LoginBox14").fadeIn("slow");
		});
});
//新增机器
$(function($) {
		$(".example15").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.6'
			}, 1000);
		}).on('click', function () {
			$("body").append("<div id='mask14'></div>");
			$("#mask15").addClass("mask").fadeIn("slow");
			$("#LoginBox15").fadeIn("slow");
		});
		//关闭
		$(".close_btn").hover(function () { }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#LoginBox15").fadeOut("fast");
			$("#mask15").css({ display: 'none' });
		});
});