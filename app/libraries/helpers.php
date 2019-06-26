<?php
/**
 * 获取当前菜单配置
 */
function menus(){
    $menu=array();

    //$action = Request::path();
    $menu['now']=Request::getRequestUri();
    $result=DB::table("msets")->get();
    $menu['list']=$result->toArray();
    return $menu;
}
/**
 * 数据库操作相关
 */
/**
 * 操作数据表结构
 * ->after('column')   将该列置于另一个列之后 (仅适用于MySQL)
 * ->comment('my comment') 添加注释信息
 * ->default($value)  指定列的默认值
 * ->first()   将该列置为表中第一个列 (仅适用于MySQL)
 * ->nullable()    允许该列的值为NULL
 * ->storedAs($expression)    创建一个存储生成列（只支持MySQL）
 * ->unsigned()    设置 integer 列为 UNSIGNED
 * ->virtualAs($expression)   创建一个虚拟生成列（只支持MySQL
 */
function operateDB($tableName,$fields){
   
    if(!Schema::hasTable($tableName)){
        Schema::create($tableName, function ($table) use ($fields) {
            $table->increments('id')->comment("自增id");
            foreach($fields as $v){
                if($v['field_type']==6){//富媒体
                    $table->text($v['field_flag'])->comment($v['field_name'])->default($v['field_value']);
                }else if($v['field_type']==3){//下拉选项
                    $table->integer($v['field_flag'])->comment($v['field_name'].";".$v['field_value']);
                }else if($v['field_type']==7){//外关联
                    $table->integer($v['field_flag'])->comment($v['field_name']);
                }else{
                    $table->string($v['field_flag'])->comment($v['field_name'])->default($v['field_value']);
                }
            }
            $table->dateTime('created');
        });
    }else{
        Schema::table($tableName, function($table) use ($fields,$tableName){
 
            foreach($fields as $v){
                //如果不存在该列
                if(!Schema::hasColumn($tableName,$v['field_flag'])){
                    if($v['field_type']==6){//富媒体
                        $table->text($v['field_flag'])->comment($v['field_name'])->default($v['field_value']);
                    }else if($v['field_type']==3){//下拉选项
                        $table->integer($v['field_flag'])->comment($v['field_name'].";".$v['field_value']);
                    }else if($v['field_type']==7){//外关联
                        $table->integer($v['field_flag'])->comment($v['field_name']);
                    }else{
                        $table->string($v['field_flag'])->comment($v['field_name'])->default($v['field_value']);
                    }
                }
            }

        });   
    }
}
/** 
 * 获取关联表信息
 */
function linkDB($myTable){

    $ind=strpos($myTable,"_");
    $tableName=substr($myTable,0,$ind);
    $fieldName=substr($myTable,$ind+1);
    $result=DB::table($tableName)->select($fieldName,'title')->get()->toJson();
    $data=json_decode($result,true);
    return $data;
}
/** 
 * 获取关联表信息
 */
function linkField($myTable,$id){

    $ind=strpos($myTable,"_");
    $tableName=substr($myTable,0,$ind);
    $fieldName=substr($myTable,$ind+1);
    $result=DB::table($tableName)->where("id","=",$id)->select('title')->first();
    return $result->title;
}
/** 
 * 获取网站信息
 */
function webInfo(){
    $result=DB::table("website")->get()->toJson();
    $data=json_decode($result,true);
    return $data[0];
}
/** 
 * 删除数据表
 */
function delTable($tableName){
    Schema::dropIfExists($tableName);
}