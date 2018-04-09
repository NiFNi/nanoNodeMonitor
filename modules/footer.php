<?php 
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/constants.php');
require_once(__DIR__ . '/config.php');
?>

<footer id="footer">
    <div class="truncateFoot">
        <?php echo getVersionInformation(); ?><br>
        Source available on <a href="<?php echo PROJECT_URL; ?>">GitHub</a>.<br>
        Donations: <span id="donationFoot"><?php echo $nanoDonationAccount; ?></span><br>
        <button class="btn btn-dark btn-sm" onclick="copy('donationFoot')">Copy Address</button>
    </div>
</footer>

</div><!-- /container -->

<script src="static/js/jquery-3.3.1.min.js"></script>
<script src="static/js/bootstrap.min.js"></script>
<script src="static/js/main.js"></script>

</body>
</html>
