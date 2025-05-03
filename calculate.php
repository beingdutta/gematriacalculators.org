<?php
header('Content-Type: application/json');

// 1. Get and sanitize input
$inputRaw = $_POST['input'] ?? '';
$letters = preg_replace('/[^A-Za-z]/', '', strtoupper($inputRaw));

// 2. Define your mappings
$hebrewMap = [
    'A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6,'G'=>7,'H'=>8,'I'=>9,'J'=>10,
    'K'=>10,'L'=>20,'M'=>30,'N'=>40,'O'=>50,'P'=>60,'Q'=>70,'R'=>80,'S'=>90,
    'T'=>100,'U'=>200,'V'=>300,'W'=>400,'X'=>500,'Y'=>600,'Z'=>700
];

// 3. Initialize totals & breakdowns
$hebrewTotal = $simpleTotal = $englishTotal = 0;
$hebrewBreak = $simpleBreak = $englishBreak = [];

foreach (str_split($letters) as $ch) {
    $h = $hebrewMap[$ch] ?? 0;
    $s = ord($ch) - 64;         // A=1…Z=26
    $e = $s * 6;                // English = simple × 6

    $hebrewTotal  += $h;
    $simpleTotal  += $s;
    $englishTotal += $e;

    $hebrewBreak[]  = "$ch:$h";
    $simpleBreak[]  = "$ch:$s";
    $englishBreak[] = "$ch:$e";
}

// 4. Build response
$response = [
    'hebrew'  => ['total'=>$hebrewTotal,  'breakdown'=>$hebrewBreak],
    'simple'  => ['total'=>$simpleTotal,  'breakdown'=>$simpleBreak],
    'english' => ['total'=>$englishTotal, 'breakdown'=>$englishBreak]
];

echo json_encode($response);
