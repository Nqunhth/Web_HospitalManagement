<?php
class ImageUploader{
    public static function upload(){
        $img=$_FILES['img'];
    if(isset($_POST['submit'])){ 
        if($img['name']==''){  
            return "No new image chosen";
        }
        else{ 
            $filename = $img['tmp_name'];
            // echo json_encode($img, JSON_UNESCAPED_UNICODE);
            $client_id="2ea9bd6c41d0bf2";
            $handle = fopen($filename, "r");
            $data = fread($handle, filesize($filename));
            $pvars   = array('image' => base64_encode($data));
            $timeout = 30;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
            $out = curl_exec($curl);
            curl_close ($curl);
            $pms = json_decode($out,true);
            $url=$pms['data']['link'];
            if($url!=""){
                $db = new DataBase();
                if ($db->dbConnect()) {
                    // echo $db->uploadImg("personal_info", $_SESSION['user_id'], $url);
                    if($db->uploadImg("personal_info", $_SESSION['user_id'], $url)){
                        $_SESSION['avatar'] = $url;
                        return "Img uploaded to db successfully!";
                    }
                    else {
                        return "Couldn't upload to db" ;
                    };                        
                }
                else{
                    return "DB Connection Error";
                };
            }
        }
    }
    }
}
// session_start();

//     $img=$_FILES['img'];
//     if(isset($_POST['submit'])){ 
//         if($img['name']==''){  
//             echo "No new image chosen";
//         }
//         else{ 
//             $filename = $img['tmp_name'];
//             // echo json_encode($img, JSON_UNESCAPED_UNICODE);
//             $client_id="2ea9bd6c41d0bf2";
//             $handle = fopen($filename, "r");
//             $data = fread($handle, filesize($filename));
//             $pvars   = array('image' => base64_encode($data));
//             $timeout = 30;
//             $curl = curl_init();
//             curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
//             curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
//             curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
//             curl_setopt($curl, CURLOPT_POST, 1);
//             curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//             curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
//             $out = curl_exec($curl);
//             curl_close ($curl);
//             $pms = json_decode($out,true);
//             $url=$pms['data']['link'];
//             if($url!=""){
//                 $db = new DataBase();
//                 if ($db->dbConnect()) {
//                     // echo $db->uploadImg("personal_info", $_SESSION['user_id'], $url);
//                     if($db->uploadImg("personal_info", $_SESSION['user_id'], $url)){
//                         $_SESSION['avatar'] = $url;
//                         echo "Img uploaded to db successfully!";
//                     }
//                     else {
//                         echo "Couldn't upload to db" ;
//                     };                        
//                 }
//                 else{
//                     echo "DB Connection Error";
//                 };
//             }
//         }
//     }
?>