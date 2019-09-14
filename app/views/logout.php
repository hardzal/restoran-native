<?php

 use \app\config\Authentication;
 
 $auth = new Authentication($db->getConnection());
 if($auth->logout()) {
     header('Location: ./?show=index');
 } else {
     echo "<div class='bg bg-error'>Gagal logout</div>";
 }
