<?php

function public_auth_report_datasheet($data){
    $output ="";
    if($data == false){
       $output="";
    }else{
       foreach($data as $r){
        $time = $r['time'];
        $distr = $r['district'];
        $public = $r['public_name'];
        $long = $r['longitude'];
        $lat = $r['latitude'];
        $file = $r['file']; 
        $output.="
            <tr>
                <td>$time</td>
                <td>$distr</td>
                <td>$public</td>
                <td>$long,$lat</td>
                <td>
                    <div class='d-flex'>
                        <a href='javascript:void(0);' class='btn btn-primary shadow btn-xs sharp me-1'><i
                                class='fas fa-pencil-alt'></i></a>
                        <a href='javascript:void(0);' class='btn btn-danger shadow btn-xs sharp'><i
                                class='fa fa-trash'></i></a>
                    </div>
                </td>
            </tr>
        ";
       }
    }
    return $output;
}




?>