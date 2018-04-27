<?php
// include required files
require_once __DIR__.'/modules/includes.php';
require_once __DIR__.'/modules/api-nodes.php';
include 'modules/header.php';
?>


<h2>Nodes</h2>
red nodes = more than 5k blocks behind, orange nodes = 2k - 5k blocks behind<br>
To sort click on a header!
<table class="table table-dark table-hover table-sm" id="nodes">
  <thead class="">
    <tr>
      <th scope="col" >Name</th>
      <th scope="col" >Blockcount</th>
      <th scope="col" >Unchecked</th>
      <th scope="col" >Peers</th>
      <th scope="col" >Version</th>
      <th scope="col" >Block diff</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data->nodes as $name=>$node): ?>
      <?php $diff = $data->currentBlock - $node->currentBlock;
if ($diff > 5000) {
    $row = "bg-danger";
} else if ($diff > 2000) {
    $row = "bg-warning";
} else {
    $row = "";
};
      ?>
      <tr class="<?php echo $row?>">
      <th scope="row"><a href="<?php echo $node->url; ?>"><?php echo $name; ?></a></th>
        <td><?php echo intval($node->currentBlock); ?></td>
        <td><?php echo intval($node->uncheckedBlocks); ?></td>
        <td><?php echo intval($node->numPeers); ?></td>
        <td><?php echo $node->version; ?></td>
        <td><?php echo $diff ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script src='static/js/tablesort/tablesort.js'></script>
<script src='static/js/tablesort/sorts/tablesort.number.js'></script>
<script>
new Tablesort(document.getElementById('nodes'));
</script>

<?php include 'modules/footer.php'; ?>
