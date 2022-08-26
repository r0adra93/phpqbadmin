<?php
require("includes/config.inc.php");
require("includes/functions.inc.php");
$query = "SELECT * FROM `vehicles`";
$sql = sqlrun($query);
$fh = fopen("C:\\Program Files\\FXServer\\txData\\QBCoreFramework\\resources\\[qb]\\qb-core\\shared\\vehicles.lua",'w');
$input = null;
$timestamp = null;
$timestamp = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
$timestamp = date('YmdHis', $timestamp);
$input = "-- Date and Time Edited: " . date("Y-m-d H:i:s") . "
QBShared = QBShared or {}
QBShared.Vehicles = {}
QBShared.VehicleHashes = {}
QBShared.Vehicles = {
";
foreach($sql as $k => $v){
  $input .= " ['{$v['model']}'] = {['name'] = '{$v['name']}',['brand'] = '{$v['brand']}',['model'] = '{$v['model']}',['price'] = '{$v['price']}',['category'] = '{$v['category']}',['hash'] = '{$v['model']}'},\r";
}
$input .= "}
for _, v in pairs(QBShared.Vehicles) do
 QBShared.VehicleHashes[v.hash] = v
end
";
if(fwrite($fh,$input)){
 echo "<html><head><title>phpqbadmin Happy Potato</title></head><body><h1>Happy Potato</h1><p>The vehicles.lua file was <em>successfully</em> updated.</p></body></html>";
 fclose($fh);
}else{
 echo "<html><head><title>phpqbadmin Sad Potato</title></head><body><h1>Sad Potato</h1><p>The vehicles.lua file was <em>not</em> updated.</p></body></html>";
}
?>