<?php
include("auth_session.php");
$baglanti=mysqli_connect('localhost', 'root', '', 'kds_mvt');
mysqli_set_charset($baglanti, "utf8");
if($baglanti){
	echo 'bağlandı';
} else{
	die('bağlantı sağlanamadı');
}
$cek="SELECT bolum.bolum_adi as ad, count(calisanlar.calisan_id) as sayi
FROM bolum, calisanlar
WHERE bolum.bolum_id=calisanlar.bolum_id
GROUP BY bolum.bolum_id ";
    $sonuc=mysqli_query($baglanti,$cek);

$ursatsay="SELECT urun.urun_adi as ura, SUM(atolye_urun.uretilen_sayi) as ursay, SUM(atolye_urun.satilan_sayi) as satsay
FROM urun, atolye_urun
WHERE urun.urun_id=atolye_urun.urun_id
GROUP BY urun.urun_id
ORDER BY ursay asc";
    $ursatsayi_sonuc=mysqli_query($baglanti, $ursatsay);

$a1="SELECT SUM(maas_tablosu.maas) as toplam_maas
FROM maas_tablosu
WHERE maas_tablosu.maas_ayi=12 and maas_tablosu.maas_yili=2020
GROUP BY maas_tablosu.maas_ayi";
    $a11= mysqli_query($baglanti,$a1);

$maksay="SELECT sum(atolye_makine.adet) as msay, makineler.makine_adi as mad
FROM atolye_makine, makineler
WHERE atolye_makine.makine_id=makineler.makine_id
GROUP BY atolye_makine.makine_id";
    $msayyi= mysqli_query($baglanti,$maksay);

$stdag="SELECT sum(stoktaki_urunler.stokta_kalan_sayi) as stok, urun.urun_adi as uad
FROM stoktaki_urunler, urun
WHERE stoktaki_urunler.urun_id=urun.urun_id
GROUP BY stoktaki_urunler.urun_id";
    $stokdag= mysqli_query($baglanti,$stdag);

$wq="SELECT yuzde.yy_adi as y_ad, yuzde.yuzd as yuzde FROM yuzde";
    $qwe= mysqli_query($baglanti,$wq);

$tpa="SELECT urun.urun_fiyati*(sum(atolye_urun.satilan_sayi)) as t_sayi, urun.urun_adi as t_ad
FROM urun, atolye_urun
WHERE atolye_urun.urun_id=urun.urun_id
GROUP BY atolye_urun.urun_id
ORDER BY t_ad asc";
    $ur_fiy= mysqli_query($baglanti, $tpa);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="KDS">
<link href="tasarim.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))</script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/20.2.4/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/20.2.4/css/dx.light.css" />
    <script src="https://cdn3.devexpress.com/jslib/20.2.4/js/dx.all.js"></script>
</head>
<body>


<div class="demo-container">
        <div id="pie"></div>
    </div>
<script>
$(function(){
    $("#pie").dxPieChart({
        size: {
            width: 450
        },
        palette: "bright",
        dataSource: dataSource,
        series: [
            {
                argumentField: "ad",
                valueField: "sayi",
                label: {
                    visible: true,
                    connector: {
                        visible: true,
                        width: 1
                    }
                }
            }
        ],
        title: "Çalışan Dağılımları",
        "export": {
            enabled: false
        },
        onPointClick: function (e) {
            var point = e.target;
    
            toggleVisibility(point);
        },
        onLegendClick: function (e) {
            var arg = e.target;
    
            toggleVisibility(this.getAllSeries()[0].getPointsByArg(arg)[0]);
        }
    });
    function toggleVisibility(item) {
        if(item.isVisible()) {
            item.hide();
        } else { 
            item.show();
        }
    }
});
var dataSource = [<?php 
    while($row1 =mysqli_fetch_array($sonuc))
    {
        $musteri_ad = $row1["ad"];
        $miktar = $row1["sayi"];
        echo "".'{'."".'ad'."".':'."".'"'."".$musteri_ad."".'"'."".','."".'sayi'."".':'."".$miktar."".'},'."";
    }?> ];
</script>

<div class="demo-container">
        <div id="pier"></div>
    </div>
<script>
$(function(){
    $("#pier").dxPieChart({
        size: {
            width: 450
        },
        palette: "bright",
        dataSource: dataSourcem,
        series: [
            {
                argumentField: "mad",
                valueField: "msay",
                label: {
                    visible: true,
                    connector: {
                        visible: true,
                        width: 1
                    }
                }
            }
        ],
        title: "Makine Dağılımları",
        "export": {
            enabled: false
        },
        onPointClick: function (e) {
            var point = e.target;
    
            toggleVisibility(point);
        },
        onLegendClick: function (e) {
            var arg = e.target;
    
            toggleVisibility(this.getAllSeries()[0].getPointsByArg(arg)[0]);
        }
    });
    function toggleVisibility(item) {
        if(item.isVisible()) {
            item.hide();
        } else { 
            item.show();
        }
    }
});
var dataSourcem = [<?php 
    while($rowwa =mysqli_fetch_array($msayyi))
    {
        $mad = $rowwa["mad"];
        $msay = $rowwa["msay"];
        echo "".'{'."".'mad'."".':'."".'"'."".$mad."".'"'."".','."".'msay'."".':'."".$msay."".'},'."";
        
    }?> ];
</script>

<div class="demo-container">
        <div id="piez"></div>
    </div>
<script>
$(function(){
    $("#piez").dxPieChart({
        size: {
            width: 500
        },
        palette: "bright",
        dataSource: dataSourceq,
        series: [
            {
                argumentField: "uad",
                valueField: "stok",
                label: {
                    visible: true,
                    connector: {
                        visible: true,
                        width: 1
                    }
                }
            }
        ],
        title: "Stoktaki Ürünlerin Dağılımları",
        "export": {
            enabled: false
        },
        onPointClick: function (e) {
            var point = e.target;
    
            toggleVisibility(point);
        },
        onLegendClick: function (e) {
            var arg = e.target;
    
            toggleVisibility(this.getAllSeries()[0].getPointsByArg(arg)[0]);
        }
    });
    
    function toggleVisibility(item) {
        if(item.isVisible()) {
            item.hide();
        } else { 
            item.show();
        }
    }
});
var dataSourceq = [<?php 
    while($rowwa =mysqli_fetch_array($stokdag))
    {
        $uad = $rowwa["uad"];
        $stok = $rowwa["stok"];
        echo "".'{'."".'uad'."".':'."".'"'."".$uad."".'"'."".','."".'stok'."".':'."".$stok."".'},'."";
        
    }?> ];
</script>

<div class="urdag">
<div id="chart"></div>
<script>
$(function(){
    $("#chart").dxChart({
        dataSource: dataSource17,
        commonSeriesSettings:{
            argumentField: "ura"
        },
        panes: [{
                name: "topPane"
            }, {
                name: "bottomPane"
            }],
        defaultPane: "bottomPane",
        series: [{
                pane: "topPane", 
                valueField: "ursay",
                name: "Üretilen sayi",
                label: {
                    visible: true,
                    customizeText: function (){
                        return this.valueText;
                    }
                }
            }, {
                type: "bar",
                valueField: "satsay",
                name: "Satilan Sayi",
                label: {
                    visible: true,
                    customizeText: function (){
                        return this.valueText ;
                    }
                }
            }
        ],    
        valueAxis: [{
            pane: "bottomPane",
            grid: {
                visible: true
            },
            title: {
                text: "satılan sayı"
            }
        }, {
            pane: "topPane",
            grid: {
                visible: true
            },
            title: {
                text: "uretilen sayı"
            }
        }],
        legend: {
            verticalAlignment: "bottom",
            horizontalAlignment: "center"
        },
        "export": {
            enabled: true
        },
        title: {
            text: "Ürünlerin Üretim Ve Satış Grafiği"
        }
    });
});
var dataSource17 = [<?php 
    while($row87 =mysqli_fetch_array($ursatsayi_sonuc))
    {
        $ura = $row87["ura"];
        $ursay = $row87["ursay"];
        $satsay = $row87["satsay"];
        echo "".'{'."".'ura'."".':'."".'"'."".$ura."".'"'."".','."".'satsay'."".':'."".'"'."".$satsay."".'"'."".','."".'ursay'."".':'."".$ursay."".'},'."";
        
    }?>];
</script>
</div>

<div class='scg'>
    <span class='scgg'> Anlık Ödenen Maaşlar (12.2020):
    <?php 
    while($row4 =mysqli_fetch_array($a11))
    {
        $toplam_maas = $row4["toplam_maas"];
        echo $toplam_maas;
        
    }?>
    </span>
</div>

<div class='fener'>
<canvas id="ur_kaz"></canvas>
<script>
var ctx = document.getElementById('ur_kaz').getContext('2d');
var ayi = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Baza','Dolap','Kitaplık','Masa','Sandalye','Televizyon Ünitesi','Vitrin'],
        datasets: [{
            label: 'Ürünlerden kazanılan para',
            data: [<?php 
    while($row5 =mysqli_fetch_array($ur_fiy))
    {
        $t_sayi = $row5["t_sayi"];
        $t_ad = $row5["t_ad"];
        echo "".$t_sayi."".','."";
        
    }?>  ],
            backgroundColor: [
                'rgb(189,21,80)',
                'rgb(157,65,156)',
                'rgb(189,21,80)',
                'rgb(157,65,156)',
                'rgb(189,21,80)',
                'rgb(157,65,156)',
                'rgb(189,21,80)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
</div>

<div class='pkar'>
<div id="kars"></div>
<script>
$(function(){
    $("#kars").dxPieChart({
        size: {
            width: 500
        },
        palette: "bright",
        dataSource: dataSourcet,
        series: [
            {
                argumentField: "y_ad",
                valueField: "yuzde",
                label: {
                    visible: true,
                    connector: {
                        visible: true,
                        width: 1
                    }
                }
            }
        ],
        title: "Stok/Üretilen Ürün Miktarı",
        "export": {
            enabled: true
        },
        onPointClick: function (e) {
            var point = e.target;
    
            toggleVisibility(point);
        },
        onLegendClick: function (e) {
            var arg = e.target;
    
            toggleVisibility(this.getAllSeries()[0].getPointsByArg(arg)[0]);
        }
    });
    
    function toggleVisibility(item) {
        if(item.isVisible()) {
            item.hide();
        } else { 
            item.show();
        }
    }
});
var dataSourcet = [
    <?php 
    while($row1 =mysqli_fetch_array($qwe))
    {
        $y_ad = $row1["y_ad"];
        $yuzde = $row1["yuzde"];
        echo "".'{'."".'y_ad'."".':'."".'"'."".$y_ad."".'"'."".','."".'yuzde'."".':'."".$yuzde."".'},'."";
        
    }?>

];
</script>
</div>
 
<div class='solbar'>
    <div class='at'>
    <i class="fas fa-hotel"></i>
    <a href='atolye_genel.php'>Atölyeler</a>
    </div>
    <div class='yen'>
    <i class="fas fa-globe-europe"></i>
    <a href='yatolye_1.php'>Yeni Atölyeler</a>
    </div>
</div>
<br>
<br>

<div class='soba'>
    <div class='yazi1'>
        <a href='atolye_genel.php'>Atölyeler Genel</a>
        <br>
        <a href='atolye_1.php'> Güven Atölye</a>
        <br>
        <br>
        <a href='atolye_2.php'>Masif Atölye</a>
        <br>
        <br>
        <a href='atolye_3.php'>Murat Atölye</a>
        <br>
        <br>
        <a href='atolye_4.php'>Elit Atölye</a>
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

<form action='atolye_genel.php' method='POST'>
</form>
</body>
</html>