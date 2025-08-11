<?php

for($i=1;$i<15;$i++) {
    makerand();
}

function makerand() {

    $token = md5(uniqid(rand(), true));
    print $token."<br>";

}
