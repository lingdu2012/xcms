
@include('super.header')
<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <!--首页标题-->
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="{{$page->menu_icon}} am-icon-mid page-header-heading-icon"></span>&nbsp;&nbsp;{{$page->menu_name}}</div>
                <p class="page-header-description"></p>
            </div>
        </div>
    </div>
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl">{{$list->pname}}列表</div>
                <div class="widget-function am-fr">
                    <a id="btn_add" href="/super/apsave?list={{$list->tname}}" class="am-icon-plus">&nbsp;&nbsp;新增{{$list->pname}}</a>
                </div>
            </div>
            <div class="widget-body am-fr">
                <div class="am-scrollable-horizontal ">
                    <table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " id="example-r">
                        <thead>
                            <tr>
                                <th>ID</th>
                                @foreach($fields as $k=> $v)
                                    @foreach($fields_title as $f)
                                        @if($f['field_flag']==$v)
                                        <th>{{$f['field_name']}}</th>
                                        @endif
                                    @endforeach
                                @endforeach
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($info as $v)
                            <tr>
                            <td>{{$v['id']}}</td>
                            @foreach($fields as $f)
                                @foreach($fields_title as $f2)
                                    @if($f2['field_type']==7 && $f2['field_flag']==$f)
                                        <td><?php echo linkField($f2['field_flag'],$v[$f]);?></td>
                                    @elseif($f2['field_flag']==$f && $f2['field_type']!=7)
                                        <td>{{$v[$f]}}</td>
                                    @endif
                                @endforeach
                            @endforeach
                            <td>{{$v['created']}}</td>
                            <td><a href="javascript:;" class="btn_del" data-id="{{$v['id']}}" data-list="{{$list->tname}}">删除</a>&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="btn_edit" data-id="{{$v['id']}}">编辑</a></td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@include('super.footer')
<script>
$(function(){
    $("a.btn_del").click(function(){
        var id=$(this).attr("data-id");
        console.log(id);
        var list=$(this).attr("data-list");
        $.ajax({
            url:'/super/ajax_adel',
            data:{id:id,list:list},
            type:'get',
            dataType:'text',
            async:false,
            success:function(data){
                console.log(data);
            }
        });
        $(this).parents("tr").remove();
    });
    $("a.btn_edit").click(function(){
        var id=$(this).attr("data-id");
        location.href="/super/apsave?list={{$list->tname}}&id="+id;
    });
});
</script>