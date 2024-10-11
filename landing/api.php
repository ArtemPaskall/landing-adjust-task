<?php

if (!empty($_POST['phone'])) {
    send_the_order ($_POST);
}

function send_the_order ($post){
    $params=array(
        'goal_id' => 83,
        'aff_click_id' => '156484efwe4re98b4rev4wr84',
        'firstname' => $post['firstname'],
        'phone' => $post['phone'],
        'sub_id1' => 'traff',
        'sub_id2' => 'fb',
        'sub_id3' =>  $post['sub_id3'],
    );

    $url = 'http://wapi.leadbit.com/api/pub/new-order/_66279fccd3b10256089676';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $return= curl_exec($ch);
    curl_close($ch);

    $array=json_decode($return, true);

    header('Location: success.php?pixel='.$_POST['pixel'].'&name='.$_POST['firstname']); 
  }
?>