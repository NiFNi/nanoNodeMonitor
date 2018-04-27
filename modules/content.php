<?php
require_once __DIR__ . '/api.php';
?>


<h2>Node Info</h2>

<div class="row">
    <div class="col-lg-8">
        If you choose me as your representative think about subscribing to my email list for updates about 
        this node. Check the last chapter at the about page for further information. Also check 
        my Banano node at <a href="https://banano.nifni.net">banano.nifni.net</a>. 
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Address
                <span class="truncate float-right" id="nodeAccount"><?php echo $data->nanoNodeAccount; ?></span>
                <button class="btn btn-dark btn-sm float-right" onclick="copy('nodeAccount')">Copy</button>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <ul class="list-group">
            <li class="list-group-item">
                Voting Weight
                <span class="float-right"><?php echo prettyFormatNano(rawToMnano($data->votingWeight), $nanoNumDecimalPlaces); ?> Nano</span>
            </li>
            <li class="list-group-item">
                Delegator Count
                <span class="float-right"><?php echo $data->delegCount; ?></span>
            </li>
            <li class="list-group-item">
                Current Block
                <span class="float-right"><?php echo $data->currentBlock; ?></span>
            </li>
            <li class="list-group-item">
                Unchecked Blocks
                <span class="float-right"><?php echo $data->uncheckedBlocks; ?></span>
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
                Peers
                <span class="float-right"><?php echo $data->numPeers; ?></span>
            </li>
            <li class="list-group-item">
                Ledger File Size
                <span class="float-right"><?php echo round($data->ldbSize / 1024 / 1024 / 1024, 3); ?> GiB</span>
            </li>
            <li class="list-group-item">
                Blockcount diff to <a href="https://nanonode.ninja">node ninja</a>
                <span class="float-right"><?php echo $data->ninjaBlockCount-$data->currentBlock;?></span>
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
<div class="row">
    <div class="col-lg-3">
        <h3>Protocol Versions</h3>
        <ul class="list-group">
            <?php foreach($data->networkVersions as $version=>$count): ?>
            <li class="list-group-item">
                <?php echo "v".$version?>
                <span class="float-right"><?php echo $count;  echo " (" . round(($count / $data->numPeers * 100), 2)  . "%)";?></span>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-lg-3">
        <h3>Block Types</h3>
        <ul class="list-group">
            <?php foreach($data->blockTypes as $version=>$count): ?>
            <li class="list-group-item">
                <?php echo $version?>
                <span class="float-right"><?php echo $count;?> </span>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-lg-6">
        <h3>Network Stats</h3>
        <ul class="list-group">
            <li class="list-group-item">
                Online Representatives
                <span class="float-right"><?php echo $data->onlineVotingWeight->count; ?></span>
            </li>
            <li class="list-group-item">
                Online Voting Weight
                <span class="float-right"><?php echo prettyFormatNano(rawToMnano($data->onlineVotingWeight->weight), 0); ?> Nano</span>
            </li>
            <li class="list-group-item">
                Online Voting Weight in %
                <span class="float-right"><?php echo prettyFormatNano(rawToMnano($data->onlineVotingWeight->weight) / NANO_SUPPLY * 100, $nanoNumDecimalPlaces); ?> %</span>
            </li>
        </ul>
    </div>
</div>
