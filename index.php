<?php
$requirement = (float) 8.0;
if (phpversion() >= $requirement) {
    echo 'Current PHP version: ' . phpversion();
    header("Location: ./pages/views");
} else {
    echo 'Current PHP version: ' . phpversion() . ', but ' . $requirement . ' or above is required <br><br><br>';
    echo phpinfo();
}
