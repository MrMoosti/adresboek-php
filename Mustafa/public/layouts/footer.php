</div>
<div id="footer">
    Copyright <?php echo date("Y", time()); ?>, Jelmer Hilhorst</div>
</body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>