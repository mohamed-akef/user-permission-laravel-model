<?php
class UserPermission extends Eloquent{

    protected $table = 'users_permissions';

    public function addNew($user_id,$permission,$status,$key)
    {
        $data = UserPermission::where('user_id','=',$user_id)->where('permission','=',$permission)->get();
        if(empty($data->count())){
            $model = new UserPermission;
            $model->user_id = $user_id;
            $model->permission = $permission;
            $model->status = $status;
            $model->key = $key;
            $model->save();
            return true;
        }else{
            $this->updateStatus($user_id,$permission,$status);
        }
        return FALSE;
    }

    public function deleteUser($id){
        $this->where('user_id','=',$id)->delete();
    }

    public function updateStatus($user_id,$type,$status)
    {
        $data = $this->where('user_id','=',$user_id)->where('permission','=',$type)->get()->first();
        if(!empty($data)){
            $data->status = $status;
            $data->save();
        }
    }

    public function user(){
        return $this->belongsTo('User','user_id');
    }

}
