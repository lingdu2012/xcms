<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>xcms基础框架</title>
    <meta name="description" content="xcms基础框架">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="">
    <link rel="apple-touch-icon-precomposed" href="">
    <meta name="apple-mobile-web-app-title" content="" />
    <script src="/admin/js/echarts.min.js"></script>
    <link rel="stylesheet" href="/admin/css/amazeui.min.css" />
    <link rel="stylesheet" href="/admin/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/admin/css/app.css">
    <script src="/admin/js/jquery.min.js"></script>

</head>

<body data-type="index" class="theme-white">

<div class="am-g tpl-g">
        <!-- 头部 -->
        <header>
            <!-- logo -->
            <div class="am-fl tpl-header-logo">
                <a href="javascript:;"><img src="/admin/img/logo.png" alt=""></a>
            </div>
            <!-- 右侧内容 -->
            <div class="tpl-header-fluid">
                <!-- 侧边切换 -->
                <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span></span>
                </div>
                <!--基本菜单-->
                <div class="am-fr tpl-header-navbar">
                    <ul>
                        <!-- 欢迎语 -->
                        <li class="am-text-sm tpl-header-navbar-welcome">
                            <a href="javascript:void(0);">你好, <span>{{session("user")}}</span></a>
                        </li>
                        <!-- 退出 -->
                        <li class="am-text-sm">
                            <a href="/superlogin/out">
                                <span class="am-icon-sign-out"></span> 退出
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </header>
        <!-- 侧边导航栏 -->
        <div class="left-sidebar">
            <!-- 用户信息 -->
            <div class="tpl-sidebar-user-panel">
                <div class="tpl-user-panel-slide-toggleable" style="text-align:center;">
                    <div class="tpl-user-panel-profile-picture" style="margin:auto;">
                        <img src="/admin/img/tx.jpg" alt="">
                    </div>
                    <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              {{session("user")}}
          </span>
                    <a href="/super/uset" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
                </div>
            </div>

            <!-- 菜单 -->
            <ul class="sidebar-nav">
                <li class="sidebar-nav-heading">Xcms管理系统</li>
                <?php $menus=menus();?>
                @foreach ($menus['list'] as $menu)
                @if($menus['now']=="/".$menu->menu_url)
                    <li class="sidebar-nav-link">
                        <a href="/{{$menu->menu_url}}" class="active">
                            <i class="{{$menu->menu_icon}} sidebar-nav-link-logo"></i> {{$menu->menu_name}}
                        </a>
                    </li>
                @elseif($menus['now'] == "/super/apage?list=".$menu->menu_url)
                    <li class="sidebar-nav-link" >
                        <a href="/super/apage?list={{$menu->menu_url}}" class="active">
                            <i class="{{$menu->menu_icon}} sidebar-nav-link-logo"></i> {{$menu->menu_name}}
                        </a>
                    </li>
                @elseif($menus['now'] == "/super/apsave?list=".$menu->menu_url)
                    @if($menu->menu_list==1)
                    <li class="sidebar-nav-link" >
                        <a href="/super/apage?list={{$menu->menu_url}}" class="active">
                            <i class="{{$menu->menu_icon}} sidebar-nav-link-logo"></i> {{$menu->menu_name}}
                        </a>
                    </li>
                    @else
                    <li class="sidebar-nav-link" >
                        <a href="/super/apsave?list={{$menu->menu_url}}" class="active">
                            <i class="{{$menu->menu_icon}} sidebar-nav-link-logo"></i> {{$menu->menu_name}}
                        </a>
                    </li>
                    @endif
                @else
                    @if($menu->menu_type==1)
                        @if($menu->menu_list==1)
                        <li class="sidebar-nav-link">
                            <a href="/super/apage?list={{$menu->menu_url}}">
                                <i class="{{$menu->menu_icon}} sidebar-nav-link-logo"></i> {{$menu->menu_name}}
                            </a>
                        </li>
                        @else
                        <li class="sidebar-nav-link">
                            <a href="/super/apsave?list={{$menu->menu_url}}">
                                <i class="{{$menu->menu_icon}} sidebar-nav-link-logo"></i> {{$menu->menu_name}}
                            </a>
                        </li>
                        @endif
                    @else
                    <li class="sidebar-nav-link">
                        <a href="/{{$menu->menu_url}}">
                            <i class="{{$menu->menu_icon}} sidebar-nav-link-logo"></i> {{$menu->menu_name}}
                        </a>
                    </li>
                    @endif
                @endif
                @endforeach
            </ul>
        </div>