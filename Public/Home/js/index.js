$(function() {
	$("#btn").click(function() {
		$("#img").click();
	});

	$('#fabu').click(function() {
		var contentVal = $('.content').val();
		var bytesCount = 0;
		for (var i = 0; i < contentVal.length; i++) {
			var c = contentVal.charAt(i);
			if (/^[\u0000-\u00ff]$/.test(c)) {
				bytesCount += 1;
			} else {
				bytesCount += 2;
			}
		}
		console.log(bytesCount);
		if (bytesCount > 160) {
			// alert('输入内容不能超过80个字');
			layer.open({
				title: "错误提示",
				type: 1,
				area: ['300px', '200px'],
				offset: ['200px', '500px'],
				content: '<div style="padding: 20px 80px;">输入内容不能超过80个字，请重新输入</div>',
				btn: '关闭',
				btnAlign: 'c',
				shade: 0,
				yes: function() {
					layer.closeAll();
				}
			});
			return false;
		}
	});

	$('.btn').click(function() {

	});

	
});

function showInfo(message){
		layer.open({
                        title: "温馨提示",
                        type: 1,
                        area: ['300px', '200px'],
                        offset: ['200px', '500px'],
                        content: '<div style="padding: 20px 80px;">'+message+'</div>',
                        btn: '关闭',
                        btnAlign: 'c',
                        shade: 0,
                        yes: function() {
                            layer.closeAll();
                        }
                    });
	}