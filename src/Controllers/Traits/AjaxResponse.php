<?php

namespace cjango\CPanel\Controllers\Traits;

trait AjaxResponse
{

    protected function success($message = '', $url = null, $data = null)
    {
        return [
            'code' => 1,
            'msg'  => $message ?: '操作成功',
            'url'  => is_null($url) ? '' : $url,
            'data' => $data,
        ];
    }

    protected function error($message = '', $url = null, $data = null)
    {
        return [
            'code' => 0,
            'msg'  => $message ?: '操作失败',
            'url'  => is_null($url) ? '' : $url,
            'data' => $data,
        ];
    }
}
