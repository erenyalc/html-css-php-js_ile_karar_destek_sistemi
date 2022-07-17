<?php
include("auth_session.php");

?>

<!DOCTYPE html>
<html>
<head>
<script>scr='jquery.min.js'</script>
<meta charset="utf-8">
<meta name="description" content="KDS">
<link href="tasarim.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))</script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/20.2.4/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/20.2.4/css/dx.light.css" />
    <script src="https://cdn3.devexpress.com/jslib/20.2.4/js/dx.all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>

<div class='solbar'>
    <div class='at'>
    <i class="fas fa-hotel"></i>
    <a href='atolye_genel.php'>Atölyeler</a>
    </div>
    <div class='yen'>
    <i class="fas fa-globe-europe"></i>
    <a href='f'>Yeni Atölyeler</a>
    </div>
</div>
<br>
<br>
<div class='soba'>
    <div class='yazi1'>
        <a href='atolye_genel.php'>Atölyeler Genel</a>
        <br>
        <br>
        <a href='yatolye_1.php'>Vizyon</a>
        <br>
        <br>
        <a href='yatolye_2.php'>Boşluk</a>
        <br>
        <br>
        <a href='yatolye_3.php'>Taş</a>
    </div>
</div>
<div class='ustbar'>
    <i class="fas fa-couch"></i>
    <span class=basliik>NORMAL MOBİLYA</span>
    <br><br>
    <span class='cik'>
    <i class="fas fa-sign-out-alt"></i>
    <a href='logout.php'>ÇIKIŞ</a></span>
</div>

<span class='baslikk'></span>
    <form action='yatolye1_1.php' method='POST'>
    <table class='adıneolaki' border='1'>
        <tr>
            <td>Adı</td>
            <td>Konumu</td>
            <td>Potansiyel Ulaştırma Giderleri</td>
            <td>Potansiyel Stok Masrafı</td>
            <td>Önerilen Çalışan Sayısı</td>
            <td>Önerilen Makine Sayısı</td>
            <td>Yıllık Kira</td>
        </tr>
        <tr>
            <td>Boşluk</td>
            <td>İstanbul-Bahçelievler</td>
            <td>2000tl</td>
            <td>4600tl</td>
            <td>5-7</td>
            <td>4-7</td>
            <td>80000</td>
            
        </tr>
        <tr>
            <td>Üretilebilecek Ürün Sayisi/Aylık</td>
            <td>Bütçe</td>
            <td>Tam açılışı İçin Beklenecek Süre</td>
        </tr>
        <tr>
            <td>35000</td>
            <td>220000tl</td>
            <td>7 ay</td>
        </tr>
    </table>
            
    <table class='adıolanolana' border='1'>
        <tr>
            <td>Bölümlerde Çalışacaklar</td>
        </tr>
        <tr>
            <td>Marangoz</td>
            <td><input type='text' name='ma1' required=''></td>
        </tr>
        <tr>
            <td>Dokumacı</td>
            <td><input type='text' name='ma2' required=''></td>
        </tr>
        <tr>
            <td>Montaj İşçisi</td>
            <td><input type='text' name='ma3' required=''></td>
        </tr>
        <tr>
            <td>Cila İşçisi</td>
            <td><input type='text' name='ma4' required=''></td>
        </tr>
        <tr>
            <td>İskelet İşçisi</td>
            <td><input type='text' name='ma5' required=''></td>
        </tr>
    </table>
    
    <table class='adınınadı' border='1'>
        <tr>
            <td>Alınacak Makineler</td>
        </tr>
        <tr>
            <td>CNC Makinesi</td>
            <td><input type='text' name='ba1' required=''></td>
        </tr>
        <tr>
            <td>Toz Emici</td>
            <td><input type='text' name='ba2' required=''></td>
        </tr>
        <tr>
            <td>Lazer Kesme</td>
            <td><input type='text' name='ba3' required=''></td>
        </tr>
        <tr>
            <td>Zımpara</td>
            <td><input type='text' name='ba4' required=''></td>
        </tr>
        <tr>
            <td>Kenar Bantlama</td>
            <td><input type='text' name='ba5' required=''></td>
        </tr>
        <tr>
            <td>Gönye Kesme</td>
            <td><input type='text' name='ba6' required=''></td>
        </tr>
        <tr>
            <td>Çoklu Delik</td>
            <td><input type='text' name='ba7' required=''></td>
        </tr>
    </table>
    
    <table class='adınınadamı' border='1'>
        <tr>
            <td>Ürünlerden Kaç Adet Üretilecek</td>
        </tr>
        <tr>
            <td>Sandalye</td>
            <td><input type='text' name='ta1' required=''></td>
        </tr>
        <tr>
            <td>Masa</td>
            <td><input type='text' name='ta2' required=''></td>
        </tr>
        <tr>
            <td>Dolap</td>
            <td><input type='text' name='ta3' required=''></td>
        </tr>
        <tr>
            <td>Kitaplık</td>
            <td><input type='text' name='ta4' required=''></td>
        </tr>
        <tr>
            <td>Baza</td>
            <td><input type='text' name='ta5' required=''></td>
        </tr>
        <tr>
            <td>Televizyon Ünitesi</td>
            <td><input type='text' name='ta6' required=''></td>
        </tr>
        <tr>
            <td>Vitrin</td>
            <td><input type='text' name='ta7' required=''></td>
        </tr>
    </table>
    <div class='but'>
    <table>
        <tr>
            <td><button type="submit">İncele</button> </td>
        </tr>
    </table>
    </div>
    </form>
</body>
</html>

