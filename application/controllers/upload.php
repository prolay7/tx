<?php

class Upload_Rename{


    const ALLOWED_TYPES = "jpg,gif,png";

    public static function generate_new_name($extension,$uppercase=true,$prefix='',$sufix=''){
        $new_name = $prefix.uniqid().'_'.time().$sufix;
        return ($uppercase ? strtoupper($new_name) : $new_name).'.'.$extension;
    }

    public static function check_and_get_extension($file){

        $file_part      = pathinfo($file);
        $allowed_types  = explode(",",Upload_Rename::ALLOWED_TYPES);

        if(!in_array($file_part['extension'], $allowed_types)){
            throw new Exception('Not ok.. bad bad file type.');
        }

        return $file_part['extension'];
    }


    public function upload($file,$target_destination){

        if(!isset($file['tmp_name'])){
            throw new Exception('Whaaaat?');
        }

        $_name   = $file['name'];
        $_tmp    = $file['tmp_name'];
        $_type   = $file['type'];
        $_size   = $file['size'];


        $file_extension = '';

        try{
            $file_extension = Upload_Rename::check_and_get_extension($_name);
        }catch(Exception $e){
            throw new Exception('Ops.. file extension? what? '.$e->getMessage());
        }

        $new_name    = Upload_Rename::generate_new_name($file_extension,true,'whaat_','_okey');
        $destination = $target_destination . DIRECTORY_SEPARATOR . $new_name;

        return move_uploaded_file($_tmp, $destination);
    }

    public function multiple_files($files,$destination){

        $number_of_files = isset($files['tmp_name']) ? sizeof($files['tmp_name']) : 0;

        $errors = array();

        for($i=0;$i<$number_of_files;$i++){
            if(isset($files['tmp_name'][$i]) && !empty($files['tmp_name'][$i])){
                try{
                    $this->upload(array(
                        'name'=>$files['name'][$i],
                        'tmp_name'=>$files['tmp_name'][$i],
                        'size'=>$files['size'][$i],
                        'type'=>$files['type'][$i]
                    ),$destination);
                }catch(Exception $e){
                    array_push($errors,array('file'=>$files['name'][$i],'error'=>$e->getMessage()));
                }
            }
        }

        print_r($errors);
    }

}

if($_FILES){
    $upload = new Upload_Rename();
    $destination = dirname(__FILE__);
    $upload->multiple_files($_FILES['myfile'],$destination);
}
?>

<form  method="post" enctype="multipart/form-data">
    <?php for($i=0;$i<10;$i++): ?>
    file: <input type="file" name="myfile[]"><hr>
    <?php endfor; ?>
    <input type="submit">
</form>