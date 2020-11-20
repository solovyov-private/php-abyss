<?php
    $phone = $_POST['phone'];
    
    if(strlen($phone) == 0){
        exit();
    }
    elseif(strlen($phone) != 10 || preg_match('/^[0][0-9]*$/', $phone) == false){
        print 'Invalid phone format!';
        exit();
    }

    $blacklist = array();
    $blacklist = file('blacklist.txt');
    sort($blacklist);

    foreach ($blacklist as &$value) {
        $value = rtrim($value);
        
        if($value == $phone){
            print 'Already exists!';
            exit();
        }
    }

    array_push($blacklist, $phone);

    file_put_contents('blacklist.txt', implode(PHP_EOL, $blacklist), LOCK_EX);

    print 'Added!';
?>
