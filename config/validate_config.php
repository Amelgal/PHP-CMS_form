<?php

$form_data=array();

$name = $_POST[full_name][first_n] .' '. $_POST[full_name][middle_n].' '.$_POST[full_name][last_n];
$email = $_POST[email];
$birth_date = $_POST[birth_data][year] .'-'. $_POST[birth_data][month].'-'.$_POST[birth_data][day];
$gender = $_POST[gender];
$address = $_POST[full_address][country].' '.$_POST[full_address][city].' '.$_POST[full_address][street_address].' '.$_POST[full_address][zip_code];
$course = $_POST[course];
$comment = $_POST[textarea];

$file = $_FILES;

