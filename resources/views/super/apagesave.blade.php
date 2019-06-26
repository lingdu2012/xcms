
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
        <form class="am-form tpl-form-line-form" method="post" action="" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl">新增{{$list->pname}}&nbsp;&nbsp;
                @if($info)
                <input type="hidden" name="id" value="{{$info['id']}}"/>
                上次更新时间：{{$info['created']}}
                @endif
                </div>
            </div>
            <div class="widget-body am-fr">
               @foreach(json_decode($list->content) as $v)
                <div class="am-form-group">
                    <label class="am-u-sm-3 am-form-label">{{$v->field_name}}</label>
                    <div class="am-u-sm-9">
                        @if($v->field_type==1)
                        <input type="text" name="{{$v->field_flag}}" class="tpl-form-input" value="{{$info[$v->field_flag]}}"/>
                        @elseif($v->field_type==2)
                            @if(isset($info[$v->field_flag]))
                                <img src="/uploads/{{$info[$v->field_flag]}}"/>
                            @endif
                        <input type="file" name="{{$v->field_flag}}" class="tpl-form-input"/>
                        @elseif($v->field_type==3)
                        <select name="{{$v->field_flag}}">
                        <?php $f=explode(";",$v->field_value);
                            foreach($f as $val){
                                $k=explode(",",$val);
                                if($k[0]==$info[$v->field_flag]){
                                    echo "<option value='".$k[0]."' selected>".$k[1]."</option>";
                                }else{
                                    echo "<option value='".$k[0]."'>".$k[1]."</option>";
                                }
                            }  
                        ?>
                        </select>
                        @elseif($v->field_type==4)
                        <?php $f=explode(";",$v->field_value);
                            $m=explode(",",$info[$v->field_flag]);
                            foreach($f as $val){
                                $k=explode(",",$val);
                                if(in_array($k[0],$m)){
                                    echo "<input type='checkbox' name='".$v->field_flag."[]' value='".$k[0]."' checked>".$k[1]."&nbsp;&nbsp;";
                                }else{
                                    echo "<input type='checkbox' name='".$v->field_flag."[]' value='".$k[0]."'/>".$k[1]."&nbsp;&nbsp;";
                                }
                                
                            }  
                        ?>
                        @elseif($v->field_type==5)
                        <textarea name="{{$v->field_flag}}" class="tpl-form-input">{{$info[$v->field_flag]}}</textarea>
                        @elseif($v->field_type==6)
                        <div id="editor">
                            {!!$info[$v->field_flag]!!}
                        </div>
                        <textarea id="editor_text" name="{{$v->field_flag}}" style="width:100%; height:200px;display:none;">{{$info[$v->field_flag]}}</textarea>
                        @elseif($v->field_type==7)
                            <select name="{{$v->field_flag}}">
                            @foreach(linkDB($v->field_flag) as $t)
                            @if($t['id']==$info[$v->field_flag])
                            <option value="{{$t['id']}}" selected="selected">{{$t['title']}}</option>
                            @else
                            <option value="{{$t['id']}}">{{$t['title']}}</option>
                            @endif
                            @endforeach
                            </select>   
                        @endif
                    </div>
                </div>
                @endforeach
                <div class="am-form-group">
                    <div class="am-u-sm-9 am-u-sm-push-3">
                        <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
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

});
</script>
<!-- 注意， 只需要引用 JS，无需引用任何 CSS ！！！-->
<script type="text/javascript" src="/weditor/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#editor')
    var $text1 = $('#editor_text')
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $text1.val(html)
    }
    editor.create()
    // 初始化 textarea 的值
    $text1.val(editor.txt.html())
</script>