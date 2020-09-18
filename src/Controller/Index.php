<?php
declare(strict_types=1);

namespace HPlus\Admin\Controller;

use HPlus\Admin\Middleware\AuthMiddleware;
use HPlus\Route\Annotation\AdminController;
use HPlus\Route\Annotation\ApiController;
use HPlus\Route\Annotation\GetApi;
use HPlus\UI\Entity\MenuEntity;
use HPlus\UI\Entity\UISettingEntity;
use HPlus\UI\Entity\UserEntity;
use HPlus\UI\UI;
use HPlus\Admin\Facades\Admin;
use Hyperf\HttpServer\Annotation\Middleware;

/**
 * @Middleware(AuthMiddleware::class)
 * @AdminController(tag="入口文件")
 */
class Index
{
    /**
     * @GetApi(path="_self_path")
     * @return array|mixed
     */
    public function index()
    {
        $userInfo = new UserEntity();
        $userInfo->setId(1);
        $userInfo->setName('测试后台');
        $userInfo->setUsername('admin');
        $setting = new UISettingEntity();
        $setting->setMenu(new MenuEntity(Admin::menu()));
        $setting->setUser($userInfo);
        $setting->setUrl([
            'logout' => route('admin/logout'),
            'setting' => route('admin/setting')
        ]);
        return UI::view($setting);
    }
}