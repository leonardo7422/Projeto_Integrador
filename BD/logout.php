<?php

setcookie("login", "", time()-1);

    header('Location: login.html');