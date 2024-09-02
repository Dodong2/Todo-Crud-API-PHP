<?php

function sanitize($input) {
    return htmlspecialchars(strip_tags($input));
}

?>