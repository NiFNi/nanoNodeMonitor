<?php
require_once 'api.php';
?>


<h2>Node Info</h2>

<div class="row">
    <div class="col-lg-8">
        If you choose me as your node think about subscribing to my email list for updates about 
        this node. Check the last chapter at the about page for further information. Also check 
        my Banano node at <a href="https://banano.nifni.net">banano.nifni.net</a>. 
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Address
                <a href="<?php echo $data->nanoNodeAccountUrl; ?>"
                   class="truncate float-right" id="nodeAccount"><?php echo $data->nanoNodeAccount; ?></a>
                <button class="btn btn-dark btn-sm float-right" onclick="copy('nodeAccount')">Copy</button>
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
            <li class="list-group-item">
                Peers
                <span class="float-right"><?php echo $data->numPeers; ?></span>
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
                Difference to Nanode
                <span class="float-right"><?php if ($data->nanodeData) {
                        echo $data->nanodeData->count-$data->currentBlock;
                    } else echo "Could not reach Nanode"; ?></span>
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
