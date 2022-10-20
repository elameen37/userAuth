<?php 
$storage = "../storage/users.csv";
function db() {
    $data = array();
    if(($csv_file = fopen($GLOBALS['storage'], "r")) !== FALSE) { // csv directory
        while (($info = fgetcsv($csv_file, 1000, ",")) !== FALSE) {
            $data[] = $info;
        }
        fclose($csv_file);
    }

    return $data;
}

function checkUserLogin(array $users) {
    [$email, $password ] = $users;
    $db = db();
    $error = '';
    foreach($db as $kdb => $info) 
    {        
        foreach($info as $key => $data) 
        {
            if($info[1] == $email && $info[2] == $password) 
            {
                return ["Auth" =>true,"message"=>$info];
            }else {
                $error = ["Auth" =>false,"message"=> "username or password does not match"];
            }
        }
    }
    return $error;
}

function checkUser_Exist(string $email) {
    $db = db();
    foreach($db as $kdb => $info) {
        foreach($info as $key => $data) {
            if($info[1] == $email) {
                return true;
            }else {
                return false;
            }
        }
    }
}

function getUserRegistered(array $users) {
    $db = db();
    [$username, $email, $password] = $users;
    
    array_push($users, date('d-m-Y'),1);
    array_push($db,$users);
    
    if (checkUser_Exist($email)) {
        return ["Auth" =>false,"message"=> "Users with \'$email\' is already existing"];
    }else {
        $fh = fopen($GLOBALS['storage'],"w");    
        
        foreach($db as $fields) {
            fputcsv($fh, $fields);
        }
        fclose($fh);
        return ["Auth" =>true,"message"=>$users];
    }
}


function updateUser(array $users) {
    [$email, $password ] = $users;
    $db = db();
    $error = '';
    foreach($db as $kdb => $info) {
        foreach($info as $key => $data) {
            if($info[1] == $email) {
                $info[1] = $email;
                $info[2] = $password;
                $db[$kdb] = $info;
                $fh = fopen($GLOBALS['storage'],"w");    
        
                foreach($db as $fields) {
                    fputcsv($fh, $fields);
                }
                fclose($fh);
                return ["Auth" =>true,"message"=>$info];

            }else {
                $error = ["Auth" =>false,"message"=> "Email not found"];
            }
        }
    }

    return $error;
}

?>