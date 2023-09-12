<?php
function numberToWordsIDR($x) {
    $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

    if ($x < 12)
        return " " . $angka[$x];
    elseif ($x < 20)
        return numberToWordsIDR($x - 10) . " belas";
    elseif ($x < 100)
        return numberToWordsIDR(floor($x / 10)) . " puluh" . numberToWordsIDR($x % 10);
    elseif ($x < 200)
        return "seratus" . numberToWordsIDR($x - 100);
    elseif ($x < 1000)
        return numberToWordsIDR(floor($x / 100)) . " ratus" . numberToWordsIDR($x % 100);
    elseif ($x < 2000)
        return "seribu" . numberToWordsIDR($x - 1000);
    elseif ($x < 1000000)
        return numberToWordsIDR(floor($x / 1000)) . " ribu" . numberToWordsIDR($x % 1000);
    elseif ($x < 1000000000)
        return numberToWordsIDR(floor($x / 1000000)) . " juta" . numberToWordsIDR($x % 1000000);
}
