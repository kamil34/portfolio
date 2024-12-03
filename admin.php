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
                <li><a href="./index.php">Strona główna</a></li>
                <li><a onclick="todo();">O firmie</a></li>
                <li><a href="./contact.html">Kontakt</a></li>
                <li><a id="admin" href="#">Panel administratora</a></li>
            </ul>
        </div>
        <!-- navbar -->
    </section>
    <section class="block-main">
        <div class="block-img">
        </div>
        <div id="particles"></div>
            <section class="admin_panel">
                <h1>Panel administratora - dodawanie pracowników do bazy</h1>

                <form action="admin.php" method="post" enctype="multipart/form-data">
                <label for="name">Imię i nazwisko pracownika:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Adres e-mail:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="status">Status pracownika:</label><br>
                <input type="text" id="status" name="status" required><br><br>

                <label for="fileToUpload">Zdjęcie profilowe pracownika:</label><br>
                <br><input type="file" name="fileToUpload" id="fileToUpload"><br><br>
                <button type="submit" name="submit">Dodaj użytkownika</button>
                </form>
                <!-- php script -->
                <?php
                    if(isset($_POST['submit'])) {
                        if(!empty($_POST['status']) && !empty($_POST['email']) && !empty($_POST['name']) && isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
                            $target_dir = "img/";
                            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                            // Check if image file is a actual image or fake image
                            // if(isset($_POST["submit"])) {
                            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                            if($check !== false) {
                                echo "Zdjęcie - " . $check["mime"] . ".";
                                $uploadOk = 1;
                            } else {
                                echo "Plik nie jest zdjęciem!";
                                $uploadOk = 0;
                            }
                            // }

                            // Check if file already exists
                            if (file_exists($target_file)) {
                            echo "Zdjęcie już istnieje na serwerze!";
                            $uploadOk = 0;
                            }

                            // Check file size
                            if ($_FILES["fileToUpload"]["size"] > 10000000) {
                            echo "Twoje zdjęcie ma za duży rozmiar!";
                            $uploadOk = 0;
                            }

                            // Allow certain file formats
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                            echo "Serwer akceptuje tylko następujące formaty: JPG, JPEG, PNG & GIF!";
                            $uploadOk = 0;
                            }

                            // Check if $uploadOk is set to 0 by an error
                            if ($uploadOk == 0) {
                            // if everything is ok, try to upload file
                            } else {
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                echo "Zdjęcie ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " zostało pomyślnie zuploadowane na serwer!";
                            } else {
                                echo "Wystąpił błąd podczas uploadu!";
                            }
                            }
                            $q = "INSERT INTO team (name, title, email, pic) VALUES ('{$_POST['name']}', '{$_POST['status']}', '{$_POST['email']}', '{$_FILES['fileToUpload']['full_path']}');";
                            mysqli_query($id_connect, $q);
                        } else {
                            echo "Należy wypełnić wszystkie pola!";
                        }
                    }
                ?>
            </section>
            <section id="alert_form" hidden></section>
    </section>
    <section class="footer">
        <p>Witrynę wykonał: 12328319239</p>
    </section>
</body>
<script>
    function todo() {
        alert('Strona w budowie!');
    }
</script>
</html>
<?php
$id_connect->close();
?>