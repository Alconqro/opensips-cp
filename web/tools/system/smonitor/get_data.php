<?php
	session_start();
    require_once("../../../../config/tools/system/smonitor/db.inc.php");
    require_once("../../../../config/db.inc.php");
	require("../../../../config/tools/system/smonitor/local.inc.php");
    
    $dsn = $config->db_driver . ':host=' . $config->db_host . ';dbname='. $config->db_name;
    try {
        $link = new PDO($dsn, $config->db_user, $config->db_pass);
    } catch (PDOException $e) {
        error_log(print_r("Failed to connect to: ".$dsn, true));
        print "Error!: " . $e->getMessage() . "<br/>";
        die;
    }

    $stat = $_GET['stat'];
    $fstat = $_GET['full_stat'];
    $zoomOut = $_GET['zoomOut'];
    $box = $_GET['box'];
    $sampling_time = $_SESSION['sampling_time'];
    $vals ="";
    $vals.="date,value";
    $chart_size = $_SESSION['chart_size'];
    if ($zoomOut == 'true') {
        $chart_size = $_SESSION['chart_history'];
    }

    $sql = "SELECT * FROM ".$config->table_monitoring." WHERE name = ? AND box_id = ? AND time > ? ORDER BY time DESC";
    $stm = $link->prepare($sql);
	$stm->execute(array($fstat, $box, time() - $chart_size * 3600));
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    $last = $row[0]['time'];
    $sum = 0;
    foreach ($row as $r){
        $d = date("U", substr($r['time'], 0, 10));
        if (($last - intval($d)) / 60 > $sampling_time * 1.5) {
            $vals.="\n".date("Y-m-d-H-i-s", substr($r['time'], 0, 10));
            $vals.=",f";
        }
        if ($r['value'] == null) $r['value'] = "f";
        $vals.="\n".date("Y-m-d-H-i-s", substr($r['time'], 0, 10));
        $vals.=",".$r['value'];
        $last = intval($d);
    }
    echo($vals);
    ?>