/*顶部消息提示*/
window.updateAlert = function(text, type, callback) {
    if (typeof type != 'string') {
        if (type) {
            type = "success";
        } else {
            type = "error";
        }
    }
    swal({
        title: text,
        type: type,
        timer: 1500,
        showConfirmButton: false
    });
    if (typeof callback == "function") {
        setTimeout(function() {
            callback();
        }, 1500)
    }
}

// ajax GET 请求
$('body').on('click', '.ajax-get', function(event) {
    event.preventDefault();
    var $this     = $(this);
    var $tips     = $this.attr('tip') || '确认要执行该操作吗?';
    var $target   = $this.data('href') || $this.attr('href') || $this.attr('url') || $this.data('url');
    if ($this.hasClass('confirm')) {
        swal({
            title: $tips,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "是的，我确定！",
            cancelButtonText: "让我再考虑一下…",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function() {
            $.get($target, function(data) {
                updateAlert(data.msg, data.code, function() {
                    if ($this.hasClass('no-refresh')) {

                    } else if (data.url) {
                        location.href = data.url;
                    } else {
                        location.reload();
                    }
                });
            });
        })
    } else {
        $.get($target, function(data) {
            updateAlert(data.msg, data.code, function() {
                if ($this.hasClass('no-refresh')) {

                } else if (data.url) {
                    location.href = data.url;
                } else {
                    location.reload();
                }
            });
        });
    }
});

// ajax POST 请求
$('body').on('click', '.ajax-post', function(event) {
    if ($(this).hasClass('disabled') || $(this).attr('disabled')) {
        return false;
    };
    event.preventDefault();
    var $this   = $(this);
    var $form   = $this.parents('form');
    var $action = $form.attr("action");
    var $tips   = $this.attr('tip') || '确认要执行该操作吗?';
    if ($this.hasClass('confirm')) {
        if(!confirm($tips)){
            return false;
        }
    }
    $this.attr('disabled', 'disabled');
    var query = $form.serialize();
    $.post($action, query, function(data) {
        var prt = parent;
        var prtLayer = prt.layer.getFrameIndex(window.name);

        /* 如果是在layer内部 */
        if (typeof prtLayer != 'undefined') {
            if (data.code) {
                prt.layer.close(prtLayer);
                prt.updateAlert(data.msg, data.code, function() {
                    prt.location.reload();
                });
            } else {
                prt.updateAlert(data.msg, data.code, function() {
                    if (data.url) {
                        location.reload();
                    }
                });
            }
        } else {
            updateAlert(data.msg, data.code, function() {
                if (data.url) {
                    location.href = data.url;
                } else {
                    location.reload();
                }
            });
        }
        $this.removeAttr('disabled');
    }).error(function(error) {
        $this.removeAttr('disabled');
        if (error.responseJSON.errors) {
            var err = '';
            $.each(error.responseJSON.errors, function(i, n) {
                err += n + "\r\n";
            })
            updateAlert(err, 'warning');
        } else if (error.responseJSON.message) {
            updateAlert(error.responseJSON.message, 'warning');
        } else {
            updateAlert('发生未知错误', 'warning');
        }
    });
});

$('#password').on('click', function(event) {
    event.preventDefault();
    layer.open({
        type: 2,
        title: '修改密码',
        closeBtn: 1,
        shade: 0.5,
        area: ['400px', '280px'],
        content: $(this).attr('href')
    });
});

/**
 * 模态窗口
 */
 $('body').on('click', '[data-toggle="layer"]', function(event) {
    event.preventDefault();
    var $this = $(this),
    _width = $this.data('width') || '500',
    _height = $this.data('height') || '350',
    _title = $this.attr('title') || $this.data('title') || $this.text() || '模态窗口',
    _href = $this.attr('href') || $this.data('remote') || $this.data('url');

    layer.open({
        type: 2,
        title: _title,
        closeBtn: 1,
        shade: 0.5,
        area: [_width + 'px', _height + 'px'],
        content: _href
    });
});
