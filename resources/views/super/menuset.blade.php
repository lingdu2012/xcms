
    @include('super.header')
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <!--首页标题-->
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-sitemap page-header-heading-icon"></span>&nbsp;&nbsp;菜单设置</div>
                    <p class="page-header-description"></p>
                </div>
            </div>
        </div>
         <!--使用说明-->
    <div class="row-content am-cf">
                <div class="row am-cf">
                    <div class="am-u-sm-12 am-u-md-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">菜单配置使用说明</div>
                            </div>
                            <div class="widget-body tpl-amendment-echarts am-fr">
                                <p>
                                    本页面主要用于配置菜单列表，其中【列表字段】可以设定需要额外显示的字段，多个字段用逗号","隔开，默认列表固定显示id和创建时间。<br/>
                                    特别提示：操作保存后生效！
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--菜单配置-->
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">配置</div>
                    <div class="widget-function am-fr">
                        <a id="btn_add" href="javascript:;" class="am-icon-plus">&nbsp;&nbsp;新增</a>
                    </div>
                </div>
                <form class="am-form tpl-form-line-form" method="post" action="">
                @csrf
                    <div class="widget-body am-fr">
                        <div class="am-scrollable-horizontal ">
                            <table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " id="example-r">
                                <thead>
                                    <tr>
                                        <th>页面名称</th>
                                        <th>页面地址(EN)</th>
                                        <th>动态页面</th>
                                        <th>展示列表</th>
                                        <th>列表字段</th>
                                        <th>图标</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody id="setArea">
                                    @foreach($mlist as $v)
                                    <tr>
                                        <td>
                                            <input type='text' name='menu_name[]' value="{{$v->menu_name}}"/>
                                        </td>
                                        <td>
                                            <input type='text' name='menu_url[]' value="{{$v->menu_url}}"/>
                                        </td>
                                        <td>
                                           <select name='menu_type[]'>
                                            @if($v->menu_type==1)
                                                <option value='0'>否</option>
                                                <option value='1'  selected>是</option>
                                            @else
                                                <option value='0'>否</option>
                                                <option value='1'>是</option>
                                            @endif
                                            </select>
                                        </td>
                                        <td>
                                            <select name='menu_list[]'>
                                            @if($v->menu_list==1)
                                            <option value='0'>否</option>
                                            <option value='1'  selected>是</option>
                                            @else
                                            <option value='0'>否</option>
                                            <option value='1'>是</option>
                                            @endif
                                            </select>
                                        </td>
                                        <td>
                                            <input type='text' name='list_fields[]' value="{{$v->list_fields}}"/>
                                        </td>
                                        <td>
                                            <input type='text' name='menu_icon[]' value="{{$v->menu_icon}}"/>
                                        </td>
                                        <td>
                                            <a href='javascript:;' class='btn_del'>删除</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('super.footer')
    <script>
    $(function(){
        $("#btn_add").click(function(){
            var str="<tr><td><input type='text' name='menu_name[]'/></td><td><input type='text' name='menu_url[]'/></td><td> <select name='menu_type[]'><option value='1'>是</option><option value='0'>否</option></select></td><td><select name='menu_list[]'><option value='1'>是</option><option value='0'>否</option></select></td><td><input type='text' name='list_fields[]'/></td><td><input type='text' name='menu_icon[]'/></td><td><a href='javascript:;' class='btn_del'>删除</a></td></tr>";
            $("#setArea").append(str);
        });
        $("body").delegate("a.btn_del","click",function(){
             $(this).parents("tr").remove();
        });
    });
    
    
    </script>