<?php

define("IN_SITEDRIVE", 1);
	
# INCLUDES ##############################################################################



    function cleanStr($str) {
        $link = mysqli_connect("localhost", "root", "kvBzpqw6PP", "sidelkag_ehome");
		$str = strip_tags($str);
		$str = htmlspecialchars($str);
		$str = mysqli_real_escape_string($link, $str);

		return $str;
    }
    
    function file_force_download($file) {
        $file = './files/'.$file;

        if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: '.filesize($file));
            
            // читаем файл и отправляем его пользователю
            readfile($file);
            exit;
        }else{
            exit;
        }
    }

    session_start();

    if (isset($_SESSION['id'])) {
        $file = cleanStr($_GET['file']);

        file_force_download($file);
    }
?>