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

        if(count($errors) > 0){
            foreach($errors as $error){
                // echo $error . '<br />';
            }
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
                exit();
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
        }
    }

    if(isset($_POST['calculate'])){

        if(empty($_POST['x_value'])){
            $errors['x_value'] = 'An x value is required';
        } else {
            $x_value = escapeshellarg($_POST['x_value']);
            $output = shell_exec("./cos_calc $x_value");

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
    <style>
        header {
            background: url(img/umaturman.webp);
            background-size: cover;
            background-position: center;
            min-height: 1000px;
        }

        @media screen and (max-width: 670px) {
            header {
                min-height: 500px;
            }
        }

        .section {
            padding-top: 4vw;
            padding-bottom: 4vw;
        }

        .tabs .indicator {
            /* background-color: #ffc107; */
            background-color: #ffd600;
        }

        .tabs .tab a:focus,
        .tabs .tab a:focus.active {
            background: transparent;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <header>
        <nav class="nav-wraper transparent">
            <div class="container">
                <a href="" class="brand-logo">Beatrix Kiddo</a>
                <a href="" class="sidenav-trigger" data-target="mobile-menu">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#photos">Photos</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="https://www.linkedin.com/in/mariia-sharkovska-578729273/" class="tooltipped btn-floating btn-small orange deep-orange darken-4"
                            data-tooltip="Linkedin">
                            <i class="fab fa-linkedin"></i>
                        </a></li>
                    <li>
                        <a href="https://github.com/mariiasharkovskaya" class="tooltipped btn-floating btn-small orange  deep-orange darken-4"
                            data-tooltip="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>
                    <li>
                        <a href="" class="tooltipped btn-floating btn-small orange  deep-orange darken-4"
                            data-tooltip="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
                <ul class="sidenav grey lighten-2" id="mobile-menu">
                    <li><a href="">Photos</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>
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
                        <a href="#editing" class="grey-text text-darken-4">Editing</a>
                    </li>
                </ul>
                <!-- <div class="col s12" id="photography">
                    <p class="flow-text grey-text text-darken-4">PHOTOGRAPHY</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                        finibus mi, egestas dignissim metus. Fusce tempus elementum metus.
                        Donec eu nibh fringilla, dignissim arcu eu, ultrices ante. Cras
                        consectetur risus id mi condimentum aliquam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                        finibus mi, egestas dignissim metus. Fusce tempus elementum metus.
                        Donec eu nibh fringilla, dignissim arcu eu, ultrices ante. Cras
                        consectetur risus id mi condimentum aliquam.</p>
                </div> -->
                <form id="cosForm" action="index.php" method="POST">
                    <div class="col s12" id="taylor">
                        <p class="flow-text grey-text text-darken-4">Calculate cos(x)</p>
                        <div class="input-field">
                            <i class="material-icons prefix">x_value</i>
                            <input type="number" id="x_value" name="x_value" step="any" value="<?php echo htmlspecialchars($x_value ?? ''); ?>">
                            <label for="x_value">Enter x</label>
                        </div>
                        <div class="input-text center">
                            <button class="btn" name="calculate">Calculate</button>
                        </div>
                        <div id="blue-card" style="margin-top: 20px;"></div>
                    </div>
                </form>
                <div class="col s12" id="editing">
                    <p class="flow-text grey-text text-darken-4">EDITING</p>
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

    <footer class="page-footer grey darken-4">
        <div class="container">
            <div class="row">
                <div class="col s12 l6">
                    <h5>About Me</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae finibus mi, egestas dignissim
                        metus.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae finibus mi, egestas dignissim
                        metus.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae finibus mi, egestas dignissim
                        metus.</p>
                </div>
                <div class="col s12 l4 offset-l2">
                    <h5>Connect</h5>
                    <ul>
                        <li><a href="https://github.com/mariiasharkovskaya" class="grey-text text-lighten-3">GitHub</a></li>
                        <li><a href="" class="grey-text text-lighten-3">Twitter</a></li>
                        <li><a href="https://www.linkedin.com/in/mariia-sharkovska-578729273/" class="grey-text text-lighten-3">LinkedIn</a></li>
                        <li><a href="oscillations.php" class="grey-text text-lighten-3">Oscillations</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright grey darken-4">
            <div class="container center-align">&copy; 2025 Materialize Practice</div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        // $(document).ready(function(){
        //     $('.sidenav').sidenav();
        // });

        $(function () {
            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
            $('.parallax').parallax();
            $('.tabs').tabs();
            $('.datepicker').datepicker({
                disableWeekends: true
            });
            $('.tooltipped').tooltip();
            $('.scrollspy').scrollSpy();
        });
        document.getElementById('cosForm').addEventListener('submit', function(event){
            event.preventDefault();
            const xValue = document.getElementById('x_value').value;
            fetch('index.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'calculate=1&x_value=' + encodeURIComponent(xValue)
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('blue-card').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>