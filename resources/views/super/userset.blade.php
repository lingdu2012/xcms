
    @include('super.header')
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <!--首页标题-->
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-cog page-header-heading-icon"></span>账号设置</div>
                    <p class="page-header-description"></p>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-body am-fr">
                    <form class="am-form tpl-form-line-form" method="post" action="">
                        @csrf
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">原密码</label>
                            <div class="am-u-sm-9">
                                <input type="password" name="oldpwd" class="tpl-form-input" placeholder="请输入原密码">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">新密码</label>
                            <div class="am-u-sm-9">
                                <input type="password" name="newpwd" class="tpl-form-input" placeholder="请输入新密码">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('super.footer')