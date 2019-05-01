<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'BOOSTDEACTIVEAD') {
    
    $activeads = Advertisement::getBoostActiveAds();

    foreach ($activeads as $ad) {
        
        $start_date = $ad['boost_activated_date'];
        $boosted = $ad['boosted'];
        date_default_timezone_set('Asia/Colombo');
        $today = date('Y-m-d H:i:s');

        
        $end_date = date('Y-m-d H:i:s', strtotime($start_date . ' + ' . $ad['boost_period'] . ' days'));

        if ($today > $start_date && $today > $end_date && $boosted === 'active') {
            $ADVERTISEMENT = new Advertisement($ad['id']);
            $ADVERTISEMENT->boosted = 'deactive';
            $ADVERTISEMENT->deactiveBoostAd();
            
        }
    }
}