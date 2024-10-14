<?php

if (!empty($_POST['phone'])) {
    send_the_order ($_POST);
}

function send_the_order ($post){
    $params=array(
        'goal_id' =>      $post['goal_id'],
        'aff_click_id' => $post['aff_click_id'],
        'firstname' =>    $post['firstname'],
        'phone' =>        $post['phone'],
        'sub_id1' =>      $post['sub_id1'],
        'sub_id2' =>      $post['sub_id2']
    );

    $url = 'https://tracking.affscalecpa.com/api/v2/affiliate/leads?api-key=adsbdb45dhnjcbd4567ghjdd';
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

    if ($httpcode == 200) {
        header('Location: success.php?pixel=' . $post['pixel'] . '&name=' . $post['firstname']);
        exit;
    } else {
        header('Location: error.php');
        exit;
    }
  }
?>