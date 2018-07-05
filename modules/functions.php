<?php
require_once(__DIR__ . "/config.php");

// print error and die
function myError($errorMsg)
{
  header("HTTP/1.1 503 Service Unavailable");
  echo '<p class="error">' . $errorMsg . '</p>';
  die();
}

// check whether php-curl is installed
function phpCurlAvailable()
{
    return function_exists('curl_version');
}

// raw to Mnano
function rawToMnano($raw)
{
  return ($raw / 1000000000000000000000000000000.0);
}

function prettyFormatNano($nano, $precision)
{
  return number_format($nano, $precision,'.',',');
}


// get system load average
function getSystemLoadAvg()
{
  return sys_getloadavg()[2];
}

// get system memory info
function getSystemMemInfo() 
{       
    $data = explode("\n", file_get_contents("/proc/meminfo"));
    $meminfo = array();
    foreach ($data as $line) {
        list($key, $val) = explode(':', $line.':');
        $meminfo[$key] = trim($val);
    }
    return $meminfo;
}

// get system total memory in MB
function getSystemTotalMem()
{
    return intval(getSystemMemInfo()["MemTotal"] / 1024);
}

// get system used memory in MB
function getSystemUsedMem()
{
    $meminfo = getSystemMemInfo();
    return intval(($meminfo["MemTotal"] - $meminfo["MemAvailable"]) / 1024);
}

// get system uptime array with secs, mins, hours and days
function getSystemUptime()
{
    $str   = file_get_contents('/proc/uptime');
    $num   = intval($str);
    $array = array();
    $array["secs"] = $num % 60;
    $num = (int)($num / 60);
    $array["mins"] = $mins  = $num % 60;
    $num = (int)($num / 60);
    $array["hours"] = $num % 24;
    $num = (int)($num / 24);
    $array["days"] = $num;
    return $array;
}

// returns JSON data to the client
function returnJson($data)
{
  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  echo json_encode($data);
}

// converts boolean to a string
function bool2string($boolean)
{
    return ($boolean) ? 'true' : 'false';
}

// get a string with information about the 
// current version and possible updates
function getVersionInformation()
{
  $currentVersion = PROJECT_VERSION;
  $versionInfo = "Version: " . $currentVersion;
  return $versionInfo;

}

// get Node Uptime
function getNodeUptime($apiKey, $uptimeRatio = 30)
{
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.uptimerobot.com/v2/getMonitors",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 5,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "api_key=$apiKey&format=json&custom_uptime_ratios=$uptimeRatio",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "content-type: application/x-www-form-urlencoded"
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  if ($err) {
    return "API error";
  }

  // decode JSON response
  $response = json_decode($response);
  
  return $response->monitors[0]->custom_uptime_ratio;
}

function blockSubType($block, $fullblock) {
    if (intval($block->previous, 16) === 0) {return "open";} 
    if (intval($block->link, 16) === 0) {return "change";} 
    if ($fullblock->source_account === "0") {return "send";} 
    return "receive";
}

function getBlockAccount($hash, $ch) {
    return reset(getBlock($ch, $hash)->blocks)->block_account;
}

function getTimeStamp($hash) {
    // Performing SQL query
    $query = "SELECT timestamp FROM timestamps where hash='$hash' LIMIT 1";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    $row = pg_fetch_row($result);
    pg_free_result($result);
    return $row[0];
}
