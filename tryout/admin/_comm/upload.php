<?php
	function file_newname($path, $filename){
	    if ($pos = strrpos($filename, '.')) {
	           $name = substr($filename, 0, $pos);
	           $ext = substr($filename, $pos);
	    } else {
	           $name = $filename;
	    }

	    $newpath = $path.'/'.$filename;
	    $newname = $filename;
	    $counter = 0;
	    while (file_exists($newpath)) {
	           $newname = $name .'_'. $counter . $ext;
	           $newpath = $path.'/'.$newname;
	           $counter++;
	     }
	    return $newname;
	}

	if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
            	if(empty($_POST['id_pertanyaan'])) {
            		require '../_inc/connect.php';
            		$data = $connect->query('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "tryout" AND TABLE_NAME = "pertanyaan"')->fetch_object();
            		$id = $data->AUTO_INCREMENT;
            	}
                else {
                	$id = (int) $_POST['id_pertanyaan'];
                }

                $type = $_FILES['file']['type'];

                if($type == 'image/jpg' || $type == 'image/jpeg') $ext = '.jpg';
                else if($type == 'image/gif') $ext = '.gif';
                else if($type == 'image/bmp') $ext = '.bmp';
                else if($type == 'image/png') $ext = '.png';
                else {
                	header('HTTP/1.0 403 Forbidden'); die('error');
                }

                $name = 'pertanyaan'.$id.$ext;
                $path = '../../../assets/images/gambar-soal';
                $name = file_newname($path, $name);
                
                $destination = $path.'/'.$name;
                $location = $_FILES['file']['tmp_name'];
                move_uploaded_file($location, $destination);
                echo 'http://emasenterprise.com/assets/images/gambar-soal'.$name;//change this URL
            }
            else
            {
              header('HTTP/1.0 403 Forbidden'); die('error');
            }
        }