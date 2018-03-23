<?php
require_once("../config/config.php");

$last_id=0;
require_once('dbquery.php');
$usr = new DbQuery();

$array=[];

$array['email'] = $_POST['loginEmail'];
$array['password'] = hash('sha256', $_POST['loginPassword']);
$array['phone'] = $_POST['phone'];
$array['name'] = $_POST['name'];
$array['dob'] = $_POST['dob'];
$array['gender'] = $_POST['gender'];

$usr -> insert('user', $array);
$last_id = $usr -> exec();

$add=new DbQuery();

$address = [];
$address['user_id'] = $last_id;
$address['street'] = $_POST['street'];
$address['state'] = $_POST['state'];
$address['city'] = $_POST['city'];
$address['country'] = $_POST['country'];

$add -> insert('address', $address);
$add -> exec();

$interestLength = count($_POST[ 'interests' ]);
$i = 0;
$interest = "";

while ($i < $interestLength-1) {
    $interest .= $_POST[ 'interests' ][$i].',' ;
    $i++;
}
$interest .= $_POST[ 'interests' ][$interestLength-1];
         
$int = new DbQuery();
$intrst = [];
$intrst['user_id'] = $last_id;
$intrst['interest'] = $interest;

$int -> insert('interest', $intrst);
$int -> exec();

$conn->close();
