<?php 

if(isset($_FILES['file'])) loadringFile($_FILES);
if(isset($_GET['load'])) OutPutFiles();
if(isset($_GET['delete'])) deleteFiles($_GET['delete']);

function loadringFile($file){
    print_r($_FILES);
    copy($_FILES['file']['tmp_name'], './files/' . $_FILES['file']['name']);
}

function OutPutFiles(){
    $folder = array_diff(scandir("./files/"), array('.', '..'));
    $folder = \array_values($folder);

    foreach($folder as $key => $file){
        $size = filesize('./files/' . $file);
        $file_type = (pathinfo($file)['extension']);
        $file_icon = null;

        if($file_type == "bmp" || $file_type == "gif" || $file_type == "png" ||
           $file_type == "jpeg" || $file_type == "tiff" || $file_type == "pcx" ||
           $file_type == "tga" || $file_type == "jpg"){
            $file_icon = "./icons/image.png";
        }
        else if($file_type == "avi" || $file_type == "mpeg" || $file_type == "wmv" ||
                $file_type == "mp4" || $file_type == "mov" || $file_type == "webm"){
                    $file_icon = "./icons/video.png";
                }
        else{
            $file_icon = "./icons/text.png";
        }

        echo 
        '<div class="element">
            <img src="' . $file_icon . '" class="file_image"></img>
            <p class="file"> File: ' . $file .'; </p>
            <p class="size"> Size: ' . $size .'; </p>
            <a href="./server.php?delete=' . $key . '">
                <button class="remove_btn">Удалить</button>
            </a>
        </div>';
    }
}

function deleteFiles($id){
    $folder = array_diff(scandir("./files/"), array('.', '..'));
    $folder = \array_values($folder);
    print_r($folder);
    unlink('./files/' . $folder[$id]);
    Header("Location: ./index.html");
}

?>