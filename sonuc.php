<?php include("baglanti.php"); ?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Sonuçlar</title>

<style>
body {
    font-family: Arial;
    background: #f4f6f9;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
}

.container {
    max-width: 900px;
    margin: auto;
}

.card {
    background: white;
    padding: 15px;
    margin: 10px 0;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card:hover {
    transform: scale(1.02);
    transition: 0.2s;
}

.fiyat {
    font-size: 18px;
    font-weight: bold;
}

.ucuz {
    color: green;
}

.pahali {
    color: red;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
}

.geri-btn {
    display: block;
    width: 200px;
    margin: 30px auto;
    text-align: center;
    padding: 15px;
    font-size: 18px;
    background: #007bff;
    color: white;
    border-radius: 10px;
    text-decoration: none;
    transition: 0.3s;
}

.geri-btn:hover {
    background: #0056b3;
    transform: scale(1.05);
}
.ozellik {
    display: none;
    color: gray;
    font-size: 13px;
}

.card:hover .ozellik {
    display: block;
}
</style>

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