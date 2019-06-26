<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {   
        $mysql_version=DB::select("select VERSION() as version");
        $data['mysql_version']=$mysql_version[0]->version;
        return view('super.index',$data);
    }
    /** 
     * 用户密码修改 
     * */
    public function uset(Request $request){
        $data=array();
        if($request->isMethod('post')){
            $opwd=$request->input('oldpwd');
            $opwd=md5($opwd);
            $npwd=$request->input('newpwd');
            $npwd=md5($npwd);
            $username=session("user");
            //查询用户
            $user=DB::table("users")->where([
                ['username', '=', $username],
                ['userpwd', '=', $opwd],
            ])->exists();
            //更新密码
            if($user){
               $result=DB::table("users")->where('username',$username)->update(['userpwd'=>$npwd]);
            }
        }
        return view('super.userset',$data);
    }
    /** 
     * 页面配置 
     * */
    public function pset(Request $request){
        $data=array();
        if($request->isMethod('post')){
            $dataset=array();
            $dataset['tname']=$request->input('tname');
            $dataset['pname']=$request->input('pname');
            $info=array();
            $field_name=$request->input('field_name');
            $field_flag=$request->input('field_flag');
            $field_type=$request->input('field_type');
            $field_value=$request->input('field_value');

            for($i=0;$i<count($field_name);$i++){
                $info[$i]['field_name']=$field_name[$i];
                $info[$i]['field_flag']=$field_flag[$i];
                $info[$i]['field_type']=$field_type[$i];
                $info[$i]['field_value']=$field_value[$i];
            }
            operateDB($dataset['tname'],$info);
            $dataset['content']=json_encode($info,JSON_UNESCAPED_UNICODE);
            $dataset['created']=date("Y-m-d H:i:s",time());
            
            $dtype=$request->input("dtype");
            if($dtype){
                $result=DB::table("psets")->where("id","=",$dtype)->update($dataset);
            }else{
                $result=DB::table("psets")->insert($dataset);
            }
        }
        $data['plist']=DB::table("psets")->select('id','tname','pname')->get();

        $data['items']=DB::table("tsets")->select()->get();

        

        return view('super.pageset',$data);
    }
    /** 
     * 获取单个页面配置 
     * */
    public function ajax_pinfo(Request $request){
        $id=$request->input("id");
        $result=DB::table("psets")->where("id","=",$id)->first();
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    /** 
     * 菜单配置 
     * */
    public function mset(Request $request){
        $data=array();
        if($request->isMethod('post')){
            $dataset=array();
            $menu_name=$request->input("menu_name");
            $menu_url=$request->input("menu_url");
            $menu_type=$request->input("menu_type");
            $menu_list=$request->input("menu_list");
            $list_fields=$request->input("list_fields");
            $menu_icon=$request->input("menu_icon");

            for($i=0;$i<count($menu_name);$i++){
                $dataset[$i]['menu_name']=$menu_name[$i];
                $dataset[$i]['menu_url']=$menu_url[$i];
                $dataset[$i]['menu_type']=$menu_type[$i];
                $dataset[$i]['menu_list']=$menu_list[$i];
                $dataset[$i]['list_fields']=$list_fields[$i];
                $dataset[$i]['menu_icon']=$menu_icon[$i];

            }
            
            //更新菜单配置表
            $result=DB::table('msets')->delete();

            $result=DB::table("msets")->insert($dataset);
        }
        $data['mlist']=DB::table("msets")->get();
        return view('super.menuset',$data);
    }
    /** 
     * 列表页面 
     * */
    public function apage(Request $request){
        $data=array();
        $list=$request->input("list");
        $data['page']=DB::table("msets")->where('menu_url',$list)->first();
        $data['list']=DB::table("psets")->where('tname',$list)->first();

        $data['fields_title']=json_decode($data['list']->content,true);
        $data['fields']=explode(",",$data['page']->list_fields);
        
        $data['info']=array();
        $info=DB::table($list)->get()->toJson();
        $data['info']=json_decode($info,true);
 
        return view('super.activepage',$data);
    }
    /** 
     * 内容编辑页面 
     * */
    public function apsave(Request $request){
       
        $data=array();
        $list=$request->input("list");
        $id=$request->input("id");

        $data['id']=$id;
        $data['info']=null;

        if($id){
            $result=DB::table($list)->where("id","=",$id)->get()->toJson();
            $a=json_decode($result,true);
            $data['info']=$a[0];
        }
        
        $data['list']=DB::table("psets")->where('tname',$list)->first();
        $data['page']=DB::table("msets")->where('menu_url',$list)->first();

        if($data['page']->menu_type==1 && $data['page']->menu_list==null){
            $result=DB::table($list)->get()->toJson();
            $a=json_decode($result,true);
            if($a){
                $data['info']=$a[0];
            }
        }

        if($request->isMethod('post')){
            $dataset=array();
            $content=$request->post();

            $files=$request->file();
            while ($key = key($files)) {
                $path = $request->file($key)->store($list);
                if($data['info'][$key]){
                    if($path){
                        $content[$key]=$path;
                    }else{
                        $content[$key]= $data['info'][$key];
                    }    
                }else{
                    $content[$key]=$path; 
                }
                next($files);
            }
            array_shift($content);

            foreach($content as $index=>$value){
                if(is_array($value)){
                    $dataset[$index]=implode(",",$value);
                }else{
                    $dataset[$index]=$value;  
                }
            }

            $dataset['created']=date("Y-m-d H:i:s",time());
            
            if($id>0){
                $result=DB::table($list)->where("id","=",$id)->update($dataset);
            }else{
                $result=DB::table($list)->insert($dataset);
            }
            $url=$request->getRequestUri();
            return redirect($url);
        }

        return view('super.apagesave',$data);
    }
    /** 
     * 列表删除
     * */
    public function ajax_adel(Request $request){
        $id=$request->input("id");
        $list=$request->input("list");
        $result=DB::table($list)->where('id', '=', $id)->delete();
        echo $result;

    }
    /** 
     * 页面删除
     * */
    public function ajax_pdel(Request $request){
        $id=$request->input("id");
        $result=DB::table("psets")->where('id', '=', $id)->delete();
        echo $result;
    }
    /** 
     * 数据库清理
     * */
    public function   clearDB(){
        $data=array();
        $result=DB::select("select table_name from information_schema.tables where table_schema='xcms'");
        $data['list']=$result;
        //var_dump($data);
        return view('super.dbpage',$data);
    }
    /** 
     * 数据表删除
     * */
    public function ajax_dbdel(Request $request){
        $did=$request->input("did");
        //删除页面记录
        $result=DB::table("psets")->where('tname', '=', $did)->delete();
        //删除数据表
        delTable($did);
        echo $result;
    }
}