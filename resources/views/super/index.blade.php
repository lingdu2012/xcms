
        @include('super.header')
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <!--首页标题-->
            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span>管理首页</div>
                        <p class="page-header-description">当前时间：{{date("Y-m-d G:i:s")}} &nbsp;&nbsp; 登录IP：{{$_SERVER['REMOTE_ADDR']}}</p>
                    </div>
                </div>
            </div>
            <!--基本统计信息-->
            <div class="row-content am-cf">
                <div class="row am-cf">
                    <div class="am-u-sm-12 am-u-md-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">当前系统情况</div>
                            </div>
                            <div class="widget-body-md widget-body tpl-amendment-echarts am-fr">
                                PHP版本：{{PHP_VERSION}}<br/>
                                Laravel版本：5.6
                                Mysql版本：{{$mysql_version}}<br/>
                                服务器系统：{{php_uname()}}<br/>
                                最大执行时间：{{get_cfg_var("max_execution_time")}}s<br/>
                                脚本运行占用最大内存：{{get_cfg_var("memory_limit")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--框架使用说明-->
            <div class="row-content am-cf">
                <div class="row am-cf">
                    <div class="am-u-sm-12 am-u-md-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">Xcms基础框架使用说明</div>
                            </div>
                            <div class="widget-body tpl-amendment-echarts am-fr">
                               <h4>【关于Xcms基础框架】</h4>
                                <p>    
                                作者根据自己日常需要而开发的一个基础针对内容管理增、删、改、查等简单操作的系统，很兴奋地使用Laravel和amazeUI。
                                </p>
                                <h4>【页面配置】</h4>
                                <p>    
                                配置页面表单内容，主要针对表单操作交互操作内容的配置。
                                </p>
                                <h4>【菜单配置】</h4>
                                <p>
                                配置左侧菜单栏内容，其中管理首页、页面配置、菜单配置为固定菜单，主要配置操作通过两个菜单即可完成。
                                </p>
                                <h4>【关于多用户】</h4>
                                <p>
                                建议用户管理分为三级角色（开发用户、管理用户、运营用户），当前系统登录为单用户admin，开发人员可以根据需要进行二次开发。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('super.footer')
