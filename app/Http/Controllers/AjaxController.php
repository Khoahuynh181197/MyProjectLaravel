<?php

namespace App\Http\Controllers;
use App\Models\ModelOfPhone;
class AjaxController extends Controller
{
    public function getModelByBrandId($id)
    {
        $model_list = ModelOfPhone::where('id_brand',$id)->get();
        echo "<option value=''>--Choose Model--</option>";
        if(count($model_list)>0)
        {
            foreach($model_list as $model)
            {
                echo "<option value='".$model->id."'>".$model->name."</option>";
            }
        }      
    }
}

?>