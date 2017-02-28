<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ONU查询系统</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta content="telephone=no" name="format-detection"/>
    <link href="./dist/lib/weui.min.css" rel="stylesheet">
    <link href="./dist/css/jquery-weui.min.css" rel="stylesheet">
    <link href="./dist/css/auth.css" rel="stylesheet">
</head>
<body>
<div class="container js_container">
    <div class="page">
        <div class="hd">
            <h1 class="page_title">OLT查询系统</h1>
            <p class="page_desc">请选择OLT品牌后再进行查询</p>
        </div>
        <div class="weui_cells weui_cells_form">
            <div class="weui_cell brand">
                <div class="weui_cell_hd"><label class="weui_label">设备品牌</label></div>
                <div class="weui_cell_bd weui_cell_primary"><input class="weui_input" type="text" id="brand"
                                                                   placeholder="请选择品牌" readonly></div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">IP地址</label></div>
                <div class="weui_cell_bd weui_cell_primary"><input class="weui_input" type="text" id="ip"
                                                                   placeholder="请输入OLT的IP地址"></div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">管理账号</label></div>
                <div class="weui_cell_bd weui_cell_primary"><input class="weui_input" type="text" id="username"
                                                                   placeholder="请输入OLT的管理账号"></div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">管理密码</label></div>
                <div class="weui_cell_bd weui_cell_primary"><input class="weui_input" type="text" id="password"
                                                                   placeholder="请输入OLT的OLT的管理密码"></div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">特权密码</label></div>
                <div class="weui_cell_bd weui_cell_primary"><input class="weui_input" type="text" id="enpassword"
                                                                   placeholder="请输入OLT的特权密码"></div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">MAC地址</label></div>
                <div class="weui_cell_bd weui_cell_primary"><input class="weui_input" type="text" id="mac"
                                                                   placeholder="请输入OLT的MAC地址"></div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">设备名称</label></div>
                <div class="weui_cell_bd weui_cell_primary"><input class="weui_input" type="text" id="device"
                                                                   placeholder="请输入OLT的设备名称"></div>
            </div>
        </div>
        <div class="weui_btn_area">
            <a class="weui_btn weui_btn_primary" id="submit">查询</a><br/>
        </div>
    </div>
</div>
<script src="./dist/lib/jquery-2.1.4.js"></script>
<script src="./dist/js/jquery-weui.min.js"></script>
<script src="./dist/lib/fastclick.js"></script>
<script>
    $(function () {
        FastClick.attach(document.body);
        ﾟωﾟﾉ = /｀ｍ´）ﾉ ~┻━┻   //*´∇｀*/ ['_'];
        o = (ﾟｰﾟ) = _ = 3;
        c = (ﾟΘﾟ) = (ﾟｰﾟ) - (ﾟｰﾟ);
        (ﾟДﾟ) = (ﾟΘﾟ) = (o ^ _ ^ o) / (o ^ _ ^ o);
        (ﾟДﾟ) = {
            ﾟΘﾟ: '_',
            ﾟωﾟﾉ: ((ﾟωﾟﾉ == 3) + '_') [ﾟΘﾟ],
            ﾟｰﾟﾉ: (ﾟωﾟﾉ + '_')[o ^ _ ^ o - (ﾟΘﾟ)],
            ﾟДﾟﾉ: ((ﾟｰﾟ == 3) + '_')[ﾟｰﾟ]
        };
        (ﾟДﾟ) [ﾟΘﾟ] = ((ﾟωﾟﾉ == 3) + '_') [c ^ _ ^ o];
        (ﾟДﾟ) ['c'] = ((ﾟДﾟ) + '_') [(ﾟｰﾟ) + (ﾟｰﾟ) - (ﾟΘﾟ)];
        (ﾟДﾟ) ['o'] = ((ﾟДﾟ) + '_') [ﾟΘﾟ];
        (ﾟoﾟ) = (ﾟДﾟ) ['c'] + (ﾟДﾟ) ['o'] + (ﾟωﾟﾉ + '_')[ﾟΘﾟ] + ((ﾟωﾟﾉ == 3) + '_') [ﾟｰﾟ] + ((ﾟДﾟ) + '_') [(ﾟｰﾟ) + (ﾟｰﾟ)] + ((ﾟｰﾟ == 3) + '_') [ﾟΘﾟ] + ((ﾟｰﾟ == 3) + '_') [(ﾟｰﾟ) - (ﾟΘﾟ)] + (ﾟДﾟ) ['c'] + ((ﾟДﾟ) + '_') [(ﾟｰﾟ) + (ﾟｰﾟ)] + (ﾟДﾟ) ['o'] + ((ﾟｰﾟ == 3) + '_') [ﾟΘﾟ];
        (ﾟДﾟ) ['_'] = (o ^ _ ^ o) [ﾟoﾟ] [ﾟoﾟ];
        (ﾟεﾟ) = ((ﾟｰﾟ == 3) + '_') [ﾟΘﾟ] + (ﾟДﾟ).ﾟДﾟﾉ + ((ﾟДﾟ) + '_') [(ﾟｰﾟ) + (ﾟｰﾟ)] + ((ﾟｰﾟ == 3) + '_') [o ^ _ ^ o - ﾟΘﾟ] + ((ﾟｰﾟ == 3) + '_') [ﾟΘﾟ] + (ﾟωﾟﾉ + '_') [ﾟΘﾟ];
        (ﾟｰﾟ) += (ﾟΘﾟ);
        (ﾟДﾟ)[ﾟεﾟ] = '\\';
        (ﾟДﾟ).ﾟΘﾟﾉ = (ﾟДﾟ + ﾟｰﾟ)[o ^ _ ^ o - (ﾟΘﾟ)];
        (oﾟｰﾟo) = (ﾟωﾟﾉ + '_')[c ^ _ ^ o];
        (ﾟДﾟ) [ﾟoﾟ] = '\"';
        (ﾟДﾟ) ['_']((ﾟДﾟ) ['_'](ﾟεﾟ + (ﾟДﾟ)[ﾟoﾟ] + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + (o ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (o ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (c ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟｰﾟ) + ((o ^ _ ^ o) - (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (c ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + ((o ^ _ ^ o) - (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (o ^ _ ^ o)) + ((o ^ _ ^ o) - (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟΘﾟ) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟｰﾟ) + ((o ^ _ ^ o) - (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (o ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((o ^ _ ^ o) - (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + (o ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (o ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (c ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟｰﾟ) + ((o ^ _ ^ o) - (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (o ^ _ ^ o)) + ((o ^ _ ^ o) - (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (c ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + ((o ^ _ ^ o) + (o ^ _ ^ o)) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (c ^ _ ^ o) + (c ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟｰﾟ) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((o ^ _ ^ o) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + (ﾟｰﾟ) + (o ^ _ ^ o) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟΘﾟ) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + (ﾟｰﾟ) + ((o ^ _ ^ o) - (ﾟΘﾟ)) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (ﾟΘﾟ)) + (ﾟΘﾟ) + (ﾟДﾟ)[ﾟεﾟ] + ((ﾟｰﾟ) + (o ^ _ ^ o)) + (o ^ _ ^ o) + (ﾟДﾟ)[ﾟoﾟ])(ﾟΘﾟ))('_');
    });
</script>
<script>
    $('#brand').select({
        title: "请选择品牌",
        input: "格林",
        items: [
            {
                title: "格林",
                value: "green"
            },
            {
                title: "瑞斯康达",
                value: "raisecom"
            },
            {
                title: "中兴",
                value: "zte"
            }
        ]
    });
    //设置设备品牌默认值
    $('#brand').attr('value', '格林');
    $('#brand').attr('data-values', 'green');
    $('body').keypress(function (e) {
        if (e.which == 13) {//绑定回车事件
            $('#submit').click();
        }
    });

    $('#submit').click(function () {
        var brand = $('#brand').attr('data-values');
        //表单验证
        for (var i = 1; i < $('input').length - 1; i++) {
            if ($('input').eq(i).val() == '') {
                if (!($('input').eq(i).attr('id') === 'enpassword' && brand === 'zte')) {
                    $.toptip($('input').eq(i).attr('placeholder'), 'warning');
                    return false;
                }
            }
        }

        var ip = $('#ip').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var enpassword = $('#enpassword').val();
        var mac = $('#mac').val();
        var device = $('#device').val();
        var data =
        {
            brand: brand,
            ip: ip,
            username: username,
            password: password,
            enpassword: enpassword,
            mac: mac,
            device: device
        };
        $.showLoading("正在查询中...");

        $.ajax({
            type: 'POST',
            url: 'controller.php',
            data: data,
            timeout: 15000,
            success: function (data) {
                $.hideLoading();

                if (data.status) {
                    localStorage.setItem('devName', data.msg.devName);
                    localStorage.setItem('regStatus', data.msg.regStatus);
                    localStorage.setItem('ponPort', data.msg.ponPort);
                    localStorage.setItem('ponIdx', data.msg.ponIdx);
                    location.href = 'complete.php';
                } else {
                    $.alert(data.msg.info);
                }
            },
            error: function () {
                $.hideLoading();
                $.alert('输入有误或请求超时');
            },
            dataType: 'json'
        });
    });


</script>
</body>
</html>