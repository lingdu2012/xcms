
    @include('super.header')
    <!-- 内容区域 -->
    <div class="tpl-content-wrapper">
        <!--首页标题-->
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-wrench am-icon-mid page-header-heading-icon"></span>&nbsp;&nbsp;页面设置</div>
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
                                <div class="widget-title am-fl">页面配置使用说明</div>
                            </div>
                            <div class="widget-body tpl-amendment-echarts am-fr">
                                <p>
                                    本页面主要用于配置表单内容，其中【新建页面】相当于创建一个新的表单内容，保存后将在Mysql数据库中生成对应的表tables。
                                    【字段标识】与数据库中字段名称一一对应【字段类型】中外联类型指的是与其它表作关联，通过表_ID的形式例如books_id指的是关联books表的id字段，在列表页面将显示表的title 
                                      【字段类型】中 下拉选项值与选项标题用逗号","隔开，选项间用分号";"隔开。例如 1,男;2,女<br/>
                                      特别指出：列表页默认使用title，所以建议表单标题使用title字段,也可以根据需要更改代码。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--操作页面-->        
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
            <form class="am-form tpl-form-line-form" method="post" action="">
                <div class="widget-body am-fr">
                        @csrf
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">操作内容</label>
                            <div class="am-u-sm-9">
                               <select name="dtype" id="dtype">
                               <option value="0">新建页面</option>
                               @foreach($plist as $v)
                               <option value="{{$v->id}}">{{$v->pname}}</option>
                               @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">新建表</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="tname" name="tname" class="tpl-form-input" placeholder="请输入表名">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label  class="am-u-sm-3 am-form-label">页面名称</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="pname" name="pname" class="tpl-form-input" placeholder="请输入页面名称">
                            </div>
                        </div>
                </div>
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">页面表单配置</div>
                    <div class="widget-function am-fr">
                        <a id="btn_add" href="javascript:;" class="am-icon-plus">&nbsp;&nbsp;新增</a>
                    </div>
                </div>
                <div class="widget-body am-fr">
                    <div class="am-scrollable-horizontal ">
                        <table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " id="example-r">
                            <thead>
                                <tr>
                                    <th>字段名称</th>
                                    <th>字段标识(EN)</th>
                                    <th>字段类型</th>
                                    <th>初始值</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="setArea">
                               
                            </tbody>
                        </table>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="button" id="btn_del_page" class="am-btn am-btn-default tpl-btn-bg-color-success ">删除</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    @include('super.footer')
    <script>
    $(function(){
        var items='{!!$items!!}';
        $("#btn_add").click(function(){
            var str='<tr><td><input type="text" name="field_name[]"/></td><td><input type="text" name="field_flag[]"/></td><td><select name="field_type[]">';
            var dataObj2=eval("("+items+")");
            $.each(dataObj2,function(n,op){
                str=str+'<option value="'+op['t_value']+'">'+op['t_name']+'</option>';
            });
            var str=str+'</select></td><td><input type="text" name="field_value[]"/></td><td><a href="javascript:void(0);" class="btn_del">删除</a></td></tr>';
            $("#setArea").append(str);
        });
        $("body").delegate("a.btn_del","click",function(){
             $(this).parents("tr").remove();
        });
        $("#dtype").change(function(){

            var id=$(this).val();
            console.log(id);
            if(id>0){
                $.ajax({
                    url:'/super/ajax_pinfo',
                    data:{id:id},
                    type:'get',
                    dataType:'json',
                    async:false,
                    success:function(data){
                        $("#setArea").empty();
                        $("#tname").val(data['tname']);
                        $("#pname").val(data['pname']);
                        var dataObj=eval("("+data['content']+")");
                        $.each(dataObj,function(i,item){
                            var str='<tr><td><input type="text" name="field_name[]" value="'+item['field_name']+'"/></td><td><input type="text" name="field_flag[]" value="'+item['field_flag']+'"/></td>'
                            var slt='<td><select name="field_type[]">';
                            var dataObj2=eval("("+items+")");
                            $.each(dataObj2,function(n,op){
                                if(item['field_type']==op['t_value']){
                                    slt=slt+"<option value='"+op['t_value']+"' selected>"+op['t_name']+"</option>";
                                }else{
                                    slt=slt+"<option value='"+op['t_value']+"'>"+op['t_name']+"</option>";
                                }  
                            });
                            slt=slt+'</select></td></td><td><input type="text" name="field_value[]" value="'+item['field_value']+'"/></td><td><a href="javascript:void(0);" class="btn_del">删除</a></td></tr>';
                            str=str+slt;
                            // //var str2='<option value="1">纯文本</option><option value="2">文件</option><option value="3">下拉选项</option><option value="4">多选</option><option value="5">文本域</option><option value="6">富媒体</option></select></td><td><input type="text" name="field_value[]"/></td><td><a href="javascript:void(0);" class="btn_del">删除</a></td></tr>';
                            $("#setArea").append(str);
                        });
                    }
                });
            }else{
                $("#tname").val("");
                $("#pname").val("");
                $("#setArea").empty();
            }
        });
        $("#btn_del_page").click(function(){
            if(confirm("是否确认删除?")){
			    var id=$("#dtype").val();
                alert(id);
                $.ajax({
                    url:'/super/ajax_pdel',
                    data:{id:id},
                    type:'get',
                    dataType:'text',
                    async:false,
                    success:function(data){
                        console.log(data);
                        if(data){
                            window.location.reload();
                        }
                    }
                });
			}
        });
    });
    </script>