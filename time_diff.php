<?php

function timeDiff($date) {

    $d1 = new DateTime($date);
    $d2 = new DateTime();
    $interval = $d2->diff($d1);

    return $interval->days . 'д ' . $interval->h . 'ч';
}

?>