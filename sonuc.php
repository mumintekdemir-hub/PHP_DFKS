<?php include("baglanti.php"); ?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Sonuçlar</title>

<link rel="stylesheet" href="sonuc.css">

</head>
<body>

<div class="container">

<h2>🔎 Arama Sonuçları</h2>

<?php
if (isset($_GET['arama'])) {
    $arama = $_GET['arama'];

    $sql = "SELECT * FROM urunler WHERE urun_adi LIKE '%$arama%' ORDER BY fiyat ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $en_ucuz = null;
        $urunler = [];

        while($row = $result->fetch_assoc()) {
            $urunler[] = $row;
        }

        $en_ucuz = $urunler[0]['fiyat'];

       foreach($urunler as $row) {

    $class = ($row['fiyat'] == $en_ucuz) ? "ucuz" : "";

    echo "<div class='card'>

            <div>
                <b>".$row['urun_adi']."</b><br>
                ".$row['magaza']."<br>

                <div class='ozellik'>
                    ".$row['ozellikler']."
                </div>
            </div>

            <div class='fiyat $class'>
                ".$row['fiyat']." TL
            </div>

          </div>";
}

    } else {
        echo "<p style='text-align:center;'>Sonuç bulunamadı</p>";
    }
}
?>

<a href="index.html" class="geri-btn">⬅ Geri Dön</a>

</div>

</body>
</html>