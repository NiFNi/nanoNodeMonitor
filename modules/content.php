<?php
require_once 'api.php';
?>


<h2>Node Info</h2>
<div class="row">

    <div class="col-lg-12">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Address
                <a href="<?php echo $data->nanoNodeAccountUrl; ?>" class="truncate float-right"><?php echo $data->nanoNodeAccount; ?></a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <ul class="list-group">
            <li class="list-group-item">
                Balance
                <span class="float-right"><?php echo $data->accBalanceMnano; ?> Nano</span>
            </li>
            <li class="list-group-item">
                Pending
                <span class="float-right"><?php echo $data->accPendingMnano; ?> Nano</span>
            </li>
            <li class="list-group-item">
                Voting Weight
                <span class="float-right"><?php echo $data->votingWeight; ?> Nano</span>
            </li>
        </ul>
    </div>
    <div class="col-lg-4">
        <ul class="list-group">
            <li class="list-group-item">
                Version
                <span class="float-right"><?php echo $data->version; ?></span>
            </li>
            <li class="list-group-item">
                Current Block
                <span class="float-right"><?php echo $data->currentBlock; ?></span>
            </li>
            <li class="list-group-item">
                Unchecked Blocks
                <span class="float-right"><?php echo $data->uncheckedBlocks; ?></span>
            </li>
            <li class="list-group-item">
                Peers
                <span class="float-right"><?php echo $data->numPeers; ?></span>
            </li>
        </ul>
    </div>


    <div class="col-lg-4">
        <ul class="list-group">
            <li class="list-group-item">
                Hostname
                <span class="float-right"><?php echo $data->nanoNodeName; ?></span>
            </li>
            <li class="list-group-item">
                Uptime
                <span class="float-right"><?php echo $data->systemUptime; ?></span>
            </li>
            <li class="list-group-item">
                Load
                <span class="float-right"><?php echo $data->systemLoad; ?></span>
            </li>
            <li class="list-group-item">
                Memory Usage
                <span class="float-right"><?php echo $data->usedMem; ?> / <?php echo $data->totalMem; ?> MB</span>
            </li>
        </ul>
    </div>


</div>