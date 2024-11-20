<?php
$id_connect = mysqli_connect('localhost', 'root', null, 'portfolio');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="./particles/particles.min.js"></script>
    <script src="./particles/particlesload.js"></script>
    <title>Portfolio</title>
</head>
<body>
    <section class="banner">
        <h1>Portfolio zespołu</h1>
        <div id="navbar">
            <ul>
                <li><a onclick="todo();" href="#">Strona główna</a></li>
                <li><a onclick="todo();" href="#">O firmie</a></li>
                <li><a onclick="todo();" href="#">Kontakt</a></li>
            </ul>
        </div>
        <!-- navbar -->
    </section>
    <section class="block-main">
        <div class="block-img">
        </div>
        <div id="particles"></div>
        <!-- php script -->
        <?php
        $q = "SELECT name, title, email, pic FROM team;";
        $query = mysqli_query($id_connect, $q);
        while($row = mysqli_fetch_array($query)) {
            echo "
            <section id='card'>
                <img src='./img/{$row['pic']}'>
                <p id='name'>{$row['name']}</p>
                <p id='title'>{$row['title']}</p>
                <button onclick=\"contact('{$row['email']}');\" id='contact'>Skontaktuj się</button>
            </section>
            ";
        }
        ?>
    </section>
    <section class="footer">
        <p>Witrynę wykonał: 12328319239</p>
    </section>
</body>
<script>
    function todo() {
        alert('Strona w budowie!');
    }
    function contact(address) {
        var mail = document.createElement('a');
        mail.href = `mailto:${address}`;
        mail.click();
    }
</script>
</html>

<?php
$id_connect->close();
?>