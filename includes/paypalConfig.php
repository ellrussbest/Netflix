<?php
    require_once("./PayPal-PHP-SDK/autoload.php");

    $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'ARA8n-QKRbZTdVT-ORIGKA7kw8vvinoYzhacGw7YZXyXDOXPSG1PDdWi7pNuytBxxZzsdIr2tTZ5PFll',     // ClientID
                'ECNFP5pgwjfwaQEGivSVF5DYFTZh-yVm51hM4euLYKAW6QvGU792KnKQdTA8YgRQRBfg8U8fTuAVhMdA'      // ClientSecret
            )
    );
?>