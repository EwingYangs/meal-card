$(document).ready(function() {
	$(".user").blur(function() {
		var user = $(".user").val();
		var RegExp = /^\d{9}$/;
		if (!RegExp.test(user)) {
			layer.open({
				title: "温馨提示",
				type: 1,
				area: ['300px', '200px'],
				offset: ['200px', '500px'],
				content: '<div style="padding: 20px 80px;">学号格式不正确，请重新输入</div>',
				btn: '关闭',
				btnAlign: 'c',
				shade: 0,
				yes: function() {
					layer.closeAll();
				}
			});
		}
	});
	$(".phone").blur(function() {
		var phone = $(".phone").val();
		var RegExp = /^1[34578]\d{9}$/;
		if (!RegExp.test(phone)) {
			layer.open({
				title: "温馨提示",
				type: 1,
				area: ['300px', '200px'],
				offset: ['200px', '500px'],
				content: '<div style="padding: 20px 80px;">学号格式不正确，请重新输入</div>',
				btn: '关闭',
				btnAlign: 'c',
				shade: 0,
				yes: function() {
					layer.closeAll();
				}
			});
		}
	});

	

	$(".pwd2").blur(function() {
		var pwd1 = $(".pwd1").val();
		var pwd2 = $(".pwd2").val();
		if (pwd2 !== pwd1) {
			layer.open({
				title: "温馨提示",
				type: 1,
				area: ['300px', '200px'],
				offset: ['200px', '500px'],
				content: '<div style="padding: 20px 80px;">两次输入密码不一致，请重新输入</div>',
				btn: '关闭',
				btnAlign: 'c',
				shade: 0,
				yes: function() {
					layer.closeAll();
				}
			});
		}
	})
});