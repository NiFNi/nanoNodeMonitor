<?php
// include required files
require_once __DIR__.'/modules/includes.php';
require_once __DIR__.'/modules/api-nodes.php';
include 'modules/header.php';
$ADDRESSIDENT = "xrb_";
$UNIT = "Nano";
?>

<?php 
$is_addr = false;
$is_block = false;
$search = "";
if (isset($_GET["s"]) && $_GET["s"] !== "") {
    $search = $_GET["s"];
    if (substr($search, 0, strlen($ADDRESSIDENT)) === $ADDRESSIDENT) {
        $is_addr = true;
    } else {
        $is_block = true;
    }
}
?>



<h2>Explorer</h2>
<form action="explorer.php" method="get">
<div class="row">
<div class="col-lg-8">
    <input type="text" value="<?php echo $search?>" name="s" class="form-control" id="explore" aria-describedby="" placeholder="Search for...">
    <small id="exploreHelp" class="form-text text-muted">Input an address or a transaction hash.</small>
</div>
<div class="col-lg-2">
    <button type="submit" class="btn btn-primary">Search</button>
</div>
</div>
</form>

<?php 
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
?>

<?php if($is_addr) : ?>
<?php 
$history = getAddrHistory($ch, $search, 10);
$dbconn = pg_connect("host=$pg_host dbname=$pg_dbname user=$pg_user password=$pg_password")
                or die('Could not connect: ' . pg_last_error());
?>
<div class="table-responsive">
<table class="table table-dark table-hover">
  <thead class="">
    <tr>
      <th scope="col" >Type</th>
      <th scope="col" >Account</th>
      <th scope="col" >Amount</th>
      <th scope="col" >UTC Time</th>
      <th scope="col" >Hash</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($history->history as $block): ?>
<?php
$timestamp = getTimestamp($block->hash);
if ($timestamp != 0) {
    $date = date('H:i d-m-Y', $timestamp/1000);
} else {
    $date = "N/A";
}
if ($block->type === "send") {
    $account = "to " . $block->destination;
    $accountLink = $block->destination;
    $amount = rawToMnano($block->amount) . " " . $UNIT;
}

if ($block->type === "receive") {
    $account = "from " . $block->account;
    $accountLink = $block->account;
    $amount = rawToMnano($block->amount) . " " . $UNIT;
}

if ($block->type === "change") {
    $account = "to " . $block->representative;
    $accountLink = $block->representative;
    $amount = "N/A";
}

if ($block->type === "open") {
    $account = "from " . $block->account;
    $accountLink = $block->account;
    $amount = rawToMnano($block->amount) . " " . $UNIT;
}

if ($block->type === "state") {
    if ($block->subtype === "send") {
        $complete = reset(getBlock($ch, $block->hash)->blocks);
        $destination = json_decode($complete->contents)->link_as_account;
        $account = "to " . $destination;
        $accountLink = $destination;
        $amount = rawToMnano($block->amount) . " " . $UNIT;
    }
    if ($block->subtype === "open") {
        $sender = getBlockAccount($block->link, $ch);
        $account = "from " . $sender;
        $accountLink = $sender;
        $amount = rawToMnano($block->amount) . " " . $UNIT;
    }
    if ($block->subtype === "receive") {
        $sender = getBlockAccount($block->link, $ch);
        $account = "from " . $sender;
        $accountLink = $sender;
        $amount = rawToMnano($block->amount) . " " . $UNIT;
    }
    if ($block->subtype === "change") {
        $account = "to " . $block->representative;
        $accountLink = $block->representative;
        $amount = "N/A";
    }
    $block->type = "state (".$block->subtype.")";
}
?>
        <tr>
            <td class="no-wrap"><?php echo $block->type; ?></td>
            <td class="no-wrap"><a href="?s=<?php echo $accountLink; ?>"><?php echo $account; ?></a></td>
            <td class="no-wrap"><?php echo $amount; ?></td>
            <td class="no-wrap"><?php echo $date?></td>
            <td><div class="truncatehash"><a href="?s=<?php echo $block->hash; ?>"><?php echo $block->hash; ?></a></div></td>
        </tr>
    <?php endforeach; ?>
<?php
pg_close($dbconn);
?>
  </tbody>
</table>
</div>
<?php endif; ?>

<?php if($is_block) : ?>
<?php 
$fullblock = reset(getBlock($ch, $search)->blocks);
?>
<?php endif ?>
<?php if($fullblock) : ?>
<?php
$block = json_decode($fullblock->contents);
$dbconn = pg_connect("host=$pg_host dbname=$pg_dbname user=$pg_user password=$pg_password")
                or die('Could not connect: ' . pg_last_error());
$timestamp = getTimestamp($search);
pg_close($dbconn);
if ($block->type === "state") {
    $block->type = "state (" .blockSubType($block, $fullblock) . ")";
}
if ($block->type === "state (receive)" or $block->type === "state (open)") {
    $block->source = $block->link;
}
if ($block->type === "state (send)") {
    $block->destination = $block->link_as_account;
}
?>
<ul class="list-group col-lg-8">
    <h3>Block Information</h3>
    <li class="list-group-item">
        Type
        <span class="float-right"><?php echo $block->type; ?></span>
    </li>
<?php if($block->type === "change" or $block->type === "state (change)") : ?>
    <li class="list-group-item">
        Changed Account
        <span class="float-right truncate"><a href="?s=<?php echo $fullblock->block_account; ?>"><?php echo $fullblock->block_account; ?></a></span>
    </li>
    <li class="list-group-item">
        To
        <span class="float-right truncate"><a href="?s=<?php echo $block->representative; ?>"><?php echo $block->representative; ?></a></span>
    </li>
<?php endif ?>
<?php if($block->type === "send" or $block->type === "state (send)") : ?>
    <li class="list-group-item">
        Amount
        <span class="float-right"><?php echo rawToMnano($fullblock->amount) . " " . $UNIT; ?></span>
    </li>
    <li class="list-group-item">
        From
        <span class="float-right truncate"><a href="?s=<?php echo $fullblock->block_account; ?>"><?php echo $fullblock->block_account; ?></a></span>
    </li>
    <li class="list-group-item">
        To
        <span class="float-right truncate"><a href="?s=<?php echo $block->destination; ?>"><?php echo $block->destination; ?></a></span>
    </li>
<?php endif ?>
<?php if($block->type === "receive" or $block->type === "open" or $block->type === "state (receive)" or $block->type === "state (open)") : ?>
    <li class="list-group-item">
        Amount
        <span class="float-right"><?php echo rawToMnano($fullblock->amount) . " " . $UNIT; ?></span>
    </li>
    <li class="list-group-item">
        From
        <span class="float-right truncate"><a href="?s=<?php echo $fullblock->source_account; ?>"><?php echo $fullblock->source_account; ?></a></span>
    </li>
    <li class="list-group-item">
        To
        <span class="float-right truncate"><a href="?s=<?php echo $fullblock->block_account; ?>"><?php echo $fullblock->block_account; ?></a></span>
    </li>
    <li class="list-group-item">
        Source
        <span class="float-right truncate"><a href="?s=<?php echo $block->source; ?>"><?php echo $block->source; ?></a></span>
    </li>
<?php endif ?>
<?php if($block->type !== "open" && $block->type !== "state (open)") : ?>
    <li class="list-group-item">
        Previous
        <span class="float-right truncate"><a href="?s=<?php echo $block->previous; ?>"><?php echo $block->previous; ?></a></span>
    </li>
<?php endif ?>
    <li class="list-group-item">
        Work
        <span class="float-right"><?php echo $block->work; ?></span>
    </li>
    <li class="list-group-item">
        Signature
        <span class="float-right truncate"><?php echo $block->signature; ?></span>
    </li>
    <li class="list-group-item">
        UTC Time
        <span class="float-right truncate"><?php echo date('H:i d-m-Y', $timestamp/1000); ?></span>
    </li>
</ul>

<?php endif;; ?>

<?php include 'modules/footer.php'; ?>
