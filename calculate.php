<?php
/**
 * calculate.php
 *  - defines gematria()
 *  - if hit via POST, returns JSON exactly as before
 */

// === 1) Library function ===
function gematria(string $raw): array {
    // 1. sanitize & uppercase
    $letters = preg_replace('/[^A-Za-z]/', '', strtoupper($raw));
    // 2. mapping
    $hebrewMap = [
        'A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6,'G'=>7,'H'=>8,'I'=>9,'J'=>10,
        'K'=>10,'L'=>20,'M'=>30,'N'=>40,'O'=>50,'P'=>60,'Q'=>70,'R'=>80,'S'=>90,
        'T'=>100,'U'=>200,'V'=>300,'W'=>400,'X'=>500,'Y'=>600,'Z'=>700
    ];

    $hTotal = $sTotal = $eTotal = 0;
    $hBreak = $sBreak = $eBreak = [];

    foreach (str_split($letters) as $ch) {
        $h = $hebrewMap[$ch] ?? 0;
        $s = ord($ch) - 64;    // A=1…Z=26
        $e = $s * 6;           // English = simple × 6

        $hTotal += $h;
        $sTotal += $s;
        $eTotal += $e;

        $hBreak[] = "$ch:$h";
        $sBreak[] = "$ch:$s";
        $eBreak[] = "$ch:$e";
    }

    return [
        'hebrew'  => ['total'=>$hTotal, 'breakdown'=>$hBreak],
        'simple'  => ['total'=>$sTotal, 'breakdown'=>$sBreak],
        'english' => ['total'=>$eTotal, 'breakdown'=>$eBreak],
    ];
}

// === 2) If called via AJAX (POST), return JSON ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $in = $_POST['input'] ?? '';
    echo json_encode( gematria($in) );
    exit;
}