<?php
// M=1000
// D=500
// C=100
// L=50
// X=10
// V=5
// I=1
function KonDecRomawi($angka)
{
    $hasil = "";
    if ($angka < 1 || $angka > 5000) { 
        // Statement di atas buat nentuin angka ngga boleh dibawah 1 atau di atas 5000
        $hasil = "Batas Angka 1 s/d 5000";
    } else {
        while ($angka >= 1000) {
            // While itu termasuk kedalam statement perulangan
            // Jadi misal variable angka lebih dari sama dengan 1000
            // Kondisi ini akan di jalankan
            $hasil .= "M"; 
            // jadi pas di jalanin , kondisi ini akan menambahkan M ke dalam
            // Varible hsl
            $angka -= 1000;
            // Lalu setelah itu varible angka di kurangi 1000 ,
            // Kenapa di kurangi
            // Karena statment ini mengambil 1000 untuk di konversi menjadi M
        }
    }
    if ($angka >= 500) {
        // statement di atas akan bernilai true / benar
        // Jika var angka lebih dari sama dengan 500
        if ($angka > 500) {
            if ($angka >= 900) {
                $hasil .= "CM";
                $angka -= 900;
            } else {
                $hasil .= "D";
                $angka-=500;
            }
        }
    }
    while ($angka>=100) {
        if ($angka>=400) {
            $hasil .= "CD";
            $angka -= 400;
        } else {
            $angka -= 100;
        }
    }
    if ($angka>=50) {
        if ($angka>=90) {
            $hasil .= "XC";
            $angka -= 90;
        } else {
            $hasil .= "L";
            $angka-=50;
        }
    }
    while ($angka >= 10) {
        if ($angka >= 40) {
            $hasil .= "XL";
            $angka -= 40;
        } else {
            $hasil .= "X";
            $angka -= 10;
        }
    }
    if ($angka >= 5) {
        if ($angka == 9) {
            $hasil .= "IX";
            $angka-=9;
        } else {
            $hasil .= "V";
            $angka -= 5;
        }
    }
    while ($angka >= 1) {
        if ($angka == 4) {
            $hasil .= "IV"; 
            $angka -= 4;
        } else {
            $hasil .= "I";
            $angka -= 1;
        }
    }
    return ($hasil);
}
echo KonDecRomawi(7);
?>