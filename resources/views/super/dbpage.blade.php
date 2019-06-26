
@include('super.header')
<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <!--首页标题-->
    <div class="container-fluid am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                <div class="page-header-heading"><span class="am-icon-recycle am-icon-mid page-header-heading-icon"></span>&nbsp;&nbsp;清理数据</div>
                <p class="page-header-description"></p>
            </div>
        </div>
    </div>
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl">当前数据库内数据表</div>
            </div>
            <div class="widget-body am-fr">
                <div class="am-scrollable-horizontal ">
                    <table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " id="example-r">
                        <thead>
                            <tr>
                                <th>ID</th>
                               <th>数据表名</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $k=> $v)
                            <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$v->TABLE_NAME}}</td>
                            <td><a href="javascript:;" data-id="{{$v->TABLE_NAME}}" class="btn_del">删除</a></td>
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
        var did=$(this).attr("data-id");
        $.ajax({
            url:'/super/ajax_dbdel',
            data:{did:did},
            type:'get',
            dataType:'text',
            async:false,
            success:function(data){
                console.log(data);
            }
        });
        $(this).parents("tr").remove();
    });
   
});
</script>