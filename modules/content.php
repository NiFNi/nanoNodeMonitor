<?php
require_once __DIR__ . '/api.php';
?>


<h2>Node Info - <?php echo $data->nanoNodeName; ?></h2>

<div class="row">
    <div class="col-lg-6">
        If you choose me as your representative think about subscribing to my email list for updates about 
        this node. Check the last chapter at the about page for further information. Also check 
        my Banano node at <a href="https://banano.nifni.net">banano.nifni.net</a>. 
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-lg-4">
        <ul class="list-group">
            <h3>Rep Infos</h3>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Address
                <span class="truncate float-right" id="nodeAccount"><?php echo $data->nanoNodeAccount; ?></span>
                <button class="btn btn-dark btn-sm float-right btn-cpy" onclick="copy('nodeAccount')">Copy</button>
            </li>
            <li class="list-group-item">
                Voting Weight
                <span class="float-right"><?php echo prettyFormatNano(rawToMnano($data->votingWeight), $nanoNumDecimalPlaces); ?> Nano</span>
            </li>
            <li class="list-group-item">
                Delegator Count
                <span class="float-right"><?php echo $data->delegCount; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Donations
                <span class="truncate float-right" id="donations"><?php echo $nanoDonationAccount;; ?></span>
                <button class="btn btn-dark btn-sm float-right btn-cpy" onclick="copy('donations')">Copy</button>
            </li>
        </ul>
    </div>
    <div class="col-xl-3 col-lg-4">
        <ul class="list-group">
            <h3>Node Stats</h3>
            <li class="list-group-item">
                Version
                <span class="float-right"><?php echo $data->version; ?></span>
            </li>
            <li class="list-group-item">
                Peers
                <span class="float-right"><?php echo $data->numPeers; ?></span>
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


    <div class="col-xl-3 col-lg-4">
        <ul class="list-group">
            <h3>Hardware Stats</h3>
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
            <li class="list-group-item">
                Ledger File Size
                <span class="float-right"><?php echo round($data->ldbSize / 1024 / 1024 / 1024, 3); ?> GiB</span>
            </li>
        </ul>
    </div>
    <div class="col-xl-3 col-lg-4">
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

</div>
<div class="row">
    <div class="col-xl-4 col-lg-4">
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
            <li class="list-group-item">
                Transactions per hour
                <span class="float-right"><?php echo end($data->txh) ?></span>
            </li>
        </ul>
    </div>

    <div class="col-xl-3 col-lg-4">
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
<!--    <div class="col-xl-3 col-lg-4">
        <h3>Transactions per hour</h3>
        <canvas id="myChart" width="400" height="300"></canvas>
    </div>-->
</div>
<!--<script src='static/js/Chart.bundle.min.js'></script>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [{
            label: '# of transactions',
            data: <?php echo json_encode($data->txh);?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>-->
