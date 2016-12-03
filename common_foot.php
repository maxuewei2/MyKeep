        </div> <!-- end of content_body div-->
        <script src="../js/common.js" type="text/javascript"></script>
        <?php
        if(php_self()=='show_tasks.php'){
            echo '<script src="../js/edit.js" type="text/javascript"></script>';
            echo '<script src="../js/task.js" type="text/javascript"></script>';
        }
        ?>
        <?php
        if(php_self()=='show_dones.php'){
            echo '<script src="../js/done.js" type="text/javascript"></script>';
        }
        ?>
        <?php
        if(php_self()=='show_timer.php'){
            echo '<script src="../js/timer.js" type="text/javascript"></script>';
        }
        ?>
        <?php
        if(php_self()=='show_setting.php'){
            echo '<script src="../js/setting.js" type="text/javascript"></script>';
        }
        ?>
    </body>
    <a name="end_of_docu"></a>
</html>

