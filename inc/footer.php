
<br><br><br>Copyright &copy; <?php echo  date('Y'); ?> Susan Rodgers, <a href = 'https://lilaavenue.com'>Lila Avenue</a><br><br><br><br>
<?php
if (isset ($_SESSION['admin'])){
    echo "<br><a href = 'logout.php'>Log Out </a>";
}
?>
</div>
<script src = 'inc/scripts.js'></script>
</body>
</html>