<?php
    foreach($alerts as $key => $alert) {
        foreach($alert as $mensaje) {
?>
    <div class="alert alert__<?php echo $key; ?>"><?php echo $mensaje; ?></div>
<?php 
        }
    }
?>
