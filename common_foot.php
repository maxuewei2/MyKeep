<?php
if(!defined('WEB_ROOT')){
    header("HTTP/1.1 404 Not Found");
    exit;
}
?>
        </div> <!-- end of content_body div-->
        <script src="js/common.js" type="text/javascript"></script>
        <?php
        if($act=='tasks'){
            echo '<script src="js/edit.js" type="text/javascript"></script>';
            echo '<script src="js/task.js" type="text/javascript"></script>';
        }
        if($act=='dones'){
            echo '<script src="js/done.js" type="text/javascript"></script>';
        }
        if($act=='timer'){
            echo '<script src="js/timer.js" type="text/javascript"></script>';
        }
        if($act=='setting'){
            echo '<script src="js/setting.js" type="text/javascript"></script>';
        }
        ?>
    </body>
    <a name="end_of_docu"></a>
</html>

