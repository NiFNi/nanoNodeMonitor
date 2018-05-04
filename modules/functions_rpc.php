<?php

// post curl data array
function postCurl($ch, $data)
{
  $data_string = json_encode($data);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
  );


  // Send the request and return response
  $resp = curl_exec($ch);

  if (!$resp)
  {
    myError("Nano node is not running");
  }

  // JSON decode and return
  return json_decode($resp);
}

// get version string from nano_node
function getVersion($ch)
{
  // get version string
  $data = array("action" => "version");

  // post curl
  return postCurl($ch, $data);
}

function getAddrHistory($ch, $addr, $count)
{
  // get version string
    $data = array(
        "action" => "account_history",
        "account" => $addr,
        "count" => strval($count),
        "raw" => "true"
    );

  // post curl
  return postCurl($ch, $data);
}

function getBlock($ch, $hash)
{
  // get version string
    $data = array(
        "action" => "blocks_info",
        "hashes" => array($hash),
        "pending" => "true",
        "source" => "true",
        "balance" => "true"
    );

  // post curl
  return postCurl($ch, $data);
}
