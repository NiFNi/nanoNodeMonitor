<?php

// include required files
require_once __DIR__ . '/includes.php';
require_once __DIR__ . '/config.php';

// get curl handle
$ch = curl_init();

if (!$ch) {
    myError('Could not initialize curl!');
}

// we have a valid curl handle here
// set some curl options
curl_setopt($ch, CURLOPT_URL, 'https://'.$nanoNodeRPCIP.':'.$nanoNodeRPCPort.$nanoNodeRPCPath);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$data = new stdClass();
$data->nanoNodeAccount = $nanoNodeAccount;

// -- Get Version String from nano_node ---------------
$rpcVersion = getVersion($ch);
$data->version = $rpcVersion->{'node_vendor'};

// -- Get get current block from nano_node
$data->currentBlock = (int) file_get_contents(__DIR__."/../data/blockcount");
$data->uncheckedBlocks = (int) file_get_contents(__DIR__."/../data/unchecked");

// -- Get number of peers from nano_node
$data->numPeers = (int) file_get_contents(__DIR__."/../data/peers");

$data->nanoNodeName = $nanoNodeName;
$data->nodes = json_decode(file_get_contents((__DIR__."/../data/nodes.json")));

// close curl handle
curl_close($ch);
