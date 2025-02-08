<?php
const API_URL = "https://whenisthenextmcufilm.com/api";

$ch = curl_init(API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$result = curl_exec($ch);
curl_close($ch);

$data = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Página donde puedes consultar cuál será la próxima película de Marvel y cuándo se estrenará">
  <meta name="language" content="Spanish">
  <title>La proxima película de Marvel</title>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
  <style>
    :root {
      color-scheme: light dark;
    }

    body {
      display: grid;
      place-content: center;
    }

    h1 {
      text-align: center;
    }

    section {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body>
  <main>
    <h1>La próxima película de Marvel</h1>
    <section>
      <img
        src="<?= $data["poster_url"]; ?>" width="300" alt="Poster de la película <?= $data["title"]; ?>"
        style="border-radius: 16px; box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5);">
    </section>
    <hgroup>
      <h3><?= $data["title"]; ?> se estrena dentro de <?= $data["days_until"]; ?> días</h3>
      <p>Fecha de estreno: <?= (new DateTime($data["release_date"]))->format('d/m/Y'); ?></p>
      <p>La siguiente película es: "<?= $data["following_production"]["title"]; ?>"</p>
    </hgroup>
  </main>
</body>

</html>