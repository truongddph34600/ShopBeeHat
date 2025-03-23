<?php
      $check=$_SESSION['admin'];
      if(isset($_GET['action'])){
          $action=$_GET['action'];
          switch ($action) {
                    case 'logout':
                        header('location:logout.php');
                    case 'danhmuc':
                        if($check['Quyen']>2){
                            echo('<center> BẠN KHÔNG CÓ QUYỀN TRUY CẬP!</center>');
                        }else{
                            include('danhmuc/danhmuc.php');
                        }

                        break;


    ?>