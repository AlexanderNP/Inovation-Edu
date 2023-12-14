<?php

function timeDiff2($date) {
    $d1 = new DateTime($date);
    $d2 = new DateTime();
    $interval = $d2->diff($d1);
    
    if($interval->invert == 1) {
        return false;
    } else {
        return true;
    }
}

?>
