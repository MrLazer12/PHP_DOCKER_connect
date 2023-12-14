<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            background-color: #B0BEC5;
        }

        .send-data-form, #emails_section {
            background: white;
            padding: 20px;
            margin-top: 1.5vh;
        }
    </style>
</head>

<body>
    <section class="container d-flex">  
        <form action="index.php" method="POST" class="send-data-form w-50">
            <div class="form-group">
                <label for="inputEmail4">Nume</label>
                <input name="userName" type="text" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Mesaj</label>
                <textarea name="userMessage" class="form-control"></textarea>
            </div>
            <div>
                <button name="submitBtn" type="submit" class="btn btn-success">Send Data</button>
            </div>
        </form>

        <article id="emails_section" class="w-75">
            <?php
                $conn = mysqli_connect("db-mysql", "test", "test", "php_docker");
                if (!$conn) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    $query = "SELECT * FROM test_table";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="email-content">
                                <h3 class="email-content__from">'.$row["name"] .'</h3>
                                <p>'. $row["message"] .'</p>
                                <hr>
                            </div>';
                        }
                    } else {
                        echo "0 results";
                    }
                }
                mysqli_close($conn);
            ?>
        </article>
    </section>

    <?php
        if (isset($_POST['submitBtn'])) {
            $userName = $_POST['userName'];
            $userMessage = $_POST['userMessage'];

            $conn = mysqli_connect("db-mysql", "test", "test", "php_docker");
            if (!$conn) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $query = "INSERT INTO test_table (name, message) VALUES ('$userName', '$userMessage')";

                if (!mysqli_query($conn, $query)) {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                }                
            }
            mysqli_close($conn);
        }
    ?>
</body>

</html>