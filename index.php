<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('config/db_connect.php');

    $email = $title = $date = $message = '';
    $errors = array('email'=>'', 'date'=>'');

    if(isset($_POST['submit'])){

        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required';
        } else {
            $email = $_POST['email'];
        }
        if(empty($_POST['date'])){
            $errors['date'] = 'A date is required';
        } else {
            $date = $_POST['date'];
        }
        if(isset($_POST['message'])){
            $message = $_POST['message'];
        }

        if(array_filter($errors)){
            //echo 'errors in form';
        } else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $message = mysqli_real_escape_string($conn, $_POST['message']);
            $date_input = mysqli_real_escape_string($conn, $_POST['date']);
            $date = date('Y-m-d', strtotime($date_input));
            $photo = isset($_POST['photo']) ? 1 : 0;
            $edit = isset($_POST['editing']) ? 1 : 0;

            $sql = "INSERT INTO customers(email,message,date,photo,editing) VALUES ('$email', '$message', '$date', '$photo', '$edit')";

            if(mysqli_query($conn, $sql)){
                header('Location: success.php');
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
        }
    }

    if(isset($_POST['calculate'])){

        if(empty($_POST['x_value'])){
            $errors['x_value'] = 'An x value is required';
        } 
        if(empty($_POST['eps_value'])){
            $errors['eps_value'] = 'An ε value is required';
        }
        else {
            $x_value = escapeshellarg($_POST['x_value']);
            $eps_value = escapeshellarg($_POST['eps_value']);
            $output = shell_exec("./cos_calc_eps $x_value $eps_value");

            $clean_x = htmlspecialchars(trim($_POST['x_value'], "'\""));
            $clean_output = htmlspecialchars(trim($output));
            echo '
                <div style="margin-top: 20px; border-left: 4px solid #ffd600; padding: 15px;">
                    <p class="flow-text grey-text text-darken-4">
                        cos(' . $clean_x . ') = <strong>' . $clean_output . '</strong>
                    </p>
                </div>
            ';
        }
        exit;

        if(count($errors) > 0){
            foreach($errors as $error){
                // echo $error . '<br />';
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <title>Photo Ninja</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <!-- photo / grid -->
    <section class="container section scrollspy" id="photos">
        <div class="row">
            <div class="col s12 l4 ">
                <img src="img/Angel_A.webp" alt="" class="responsive-img materialboxed">
            </div>
            <div class="col s12 l4 offset-l1">
                <h2 class="grey-text text-darken-4">Love</h2>
                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                    finibus mi, egestas dignissim metus. Fusce tempus elementum metus.
                    Donec eu nibh fringilla, dignissim arcu eu, ultrices ante. Cras
                    consectetur risus id mi condimentum aliquam.</p>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4 push-l5 offset-l1">
                <img src="img/biggersplash.jpg" alt="" class="responsive-img materialboxed">
            </div>
            <div class="col s12 l4 pull-l4">
                <h2 class="grey-text text-darken-4">Lust</h2>
                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                    finibus mi, egestas dignissim metus. Fusce tempus elementum metus.
                    Donec eu nibh fringilla, dignissim arcu eu, ultrices ante. Cras
                    consectetur risus id mi condimentum aliquam.</p>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4">
                <img src="img/nikita.avif" alt="" class="responsive-img materialboxed">
            </div>
            <div class="col s12 l4 offset-l1">
                <h2 class="grey-text text-darken-4">Liberation</h2>
                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                    finibus mi, egestas dignissim metus. Fusce tempus elementum metus.
                    Donec eu nibh fringilla, dignissim arcu eu, ultrices ante. Cras
                    consectetur risus id mi condimentum aliquam.</p>
            </div>
        </div>
    </section>
    <!-- parallax -->
    <div class="parallax-container">
        <div class="parallax">
            <img src="img/tarantino.jpg" alt="" class="responsive-img">
        </div>
    </div>
    <!-- services / tabs -->
    <section class="container section scrollspy" id="services">
        <div class="row">
            <div class="col s12 l4">
                <h2 class="grey-text text-darken-4">What I do...</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                    finibus mi, egestas dignissim metus. Fusce tempus elementum metus.
                    Donec eu nibh fringilla, dignissim arcu eu, ultrices ante. Cras
                    consectetur risus id mi condimentum aliquam.</p>
            </div>
            <div class="col s12 l6 offset-l2">
                <ul class="tabs">
                    <li class="tab col s6">
                        <!-- <a href="#photography" class="grey-text text-darken-4">Photography</a> -->
                         <a href="#taylor" class="grey-text text-darken-4">Taylor series</a>
                    </li>
                    <li class="tab col s6">
                        <a href="#animation" class="grey-text text-darken-4">Animation</a>
                    </li>
                </ul>
                <form id="cosForm" action="index.php" method="POST">
                    <div class="col s12" id="taylor">
                        <p class="flow-text grey-text text-darken-4">Calculate cos(x)</p>
                        <div class="input-field">
                            <i class="material-icons prefix">x_value</i>
                            <input type="number" id="x_value" name="x_value" step="any" value="<?php echo htmlspecialchars($x_value ?? ''); ?>">
                            <label for="x_value">Enter x</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">eps_value</i>
                            <input type="number" id="eps_value" name="eps_value" step="any" value="<?php echo htmlspecialchars($eps_value ?? ''); ?>">
                            <label for="eps_value">Enter ε</label>
                        </div>
                        <div class="input-text center">
                            <button class="btn" name="calculate">Calculate</button>
                        </div>
                        <div id="blue-card" style="margin-top: 20px;"></div>
                    </div>
                </form>
                <div class="col s12" id="animation">
                    <p class="flow-text grey-text text-darken-4">Animation</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                        finibus mi, egestas dignissim metus. Fusce tempus elementum metus.
                        Donec eu nibh fringilla, dignissim arcu eu, ultrices ante. Cras
                        consectetur risus id mi condimentum aliquam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                        finibus mi, egestas dignissim metus. Fusce tempus elementum metus.
                        Donec eu nibh fringilla, dignissim arcu eu, ultrices ante. Cras
                        consectetur risus id mi condimentum aliquam.</p>
                </div>
            </div>
        </div>
    </section>
    <div class="parallax-container">
        <div class="parallax">
            <img src="img/tarantinp.jpg" alt="" class="responsive-img">
        </div>
    </div>

    <!-- contact form -->
    <section class="section container scrollspy" id="contact">
        <div class="row">
            <div class="col s12 l5">
                <h2 class="grey-text text-darken-4">Get In Touch</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae finibus mi, egestas dignissim
                    metus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae finibus mi, egestas dignissim
                    metus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae finibus mi, egestas dignissim
                    metus.</p>
            </div>
            <div class="col s12 l5 offset-l2">
                <form action="index.php" method="POST">
                    <div class="input-field">
                        <i class="material-icons prefix">email</i>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
                        <label for="email">Your Email</label>
                        <div class="red-text"><?php echo $errors['email']; ?></div>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">message</i>
                        <textarea id="message" class="materialize-textarea" name="message"><?php echo htmlspecialchars($message) ?></textarea>
                        <label class="active" for="message">Your Message</label>
                    </div>
                    <div class="input-field">
                        <input type="text" class="datepicker" id="date" name="date" value="<?php echo htmlspecialchars($date) ?>">
                        <label for="date">Choose a date you need me for...</label>
                        <div class="red-text"><?php echo $errors['date']; ?></div>
                    </div>
                    <div class="input-field">
                        <p>Services required...</p>
                        <p>
                            <label>
                                <input type="checkbox" name="photo">
                                <span>Photography</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="editing">
                                <span>Editing</span>
                            </label>
                        </p>
                    </div>
                    <div class="input-text center">
                        <button class="btn" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>