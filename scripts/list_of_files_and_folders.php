<?php
$list_of_files = scandir(getcwd());
foreach($list_of_files as $file_or_folder){
    if(getcwd() == "/var/www/files.khomyart.com/public_html/users/".$_SESSION["auth"]["login"]."/files") {
        if($file_or_folder !== ".." && $file_or_folder !== ".") {
?>
<!--HTML-->
            <button type = "submit"
                    name = "<?=IsFileOrFolder($file_or_folder);?>"
                    value = "<?="/".$file_or_folder?>"
                    class = "list-group-item list-group-item-action">
                <?=$file_or_folder?>
            </button>
<!--HTML end-->
<?php
        } 
    } elseif ($file_or_folder !== "."){
?>
<!--HTML-->
        <button type = "submit"
                name = "<?= IsFileOrFolder($file_or_folder);?>"
                value = "<?="/".$file_or_folder?>"
                class="list-group-item list-group-item-action">
            <?=$file_or_folder?>
        </button>
<!--HTML end-->
<?php
    }
}
?>