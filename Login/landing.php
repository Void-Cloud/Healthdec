<?php
    require_once('HTTPS.php');
?>
<!DOCTYPE html>
<html>
<head>
<!DOCTYPE html>
<html lang="en">
<head>
 
<meta charset="utf-8"/>
<link rel="stylesheet" href="landingcss.css">

<!-- FONTS AND FOOTER STYLE  -->
<link rel="stylesheet" href="footer-distributed-with-address-and-phones.css">	
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">

<title>Healthdec</title>
</head>
    <body>

        
            <header class="header">

            <nav>
                <div class="logo-box">
                    <img src="Logo1.png" alt="LOGO">
                </div>
                <!-- <ul>
                    <li><a href="#">AAAAA</a></li>
                    <li><a href="#">BBBBB</a></li>
                    <li><a href="#">CCCCC</a></li>
                </ul> -->
            </nav>
            </header>

        <div id="first" class="page"></div>
            <div class="heading">
                <span class="title1">Healthdec</span>
                <span class="title2">Insert slogan here@@@</span>

                <div class="parent">
                <button onclick="document.getElementById('id01').style.display='inline-block'" style="width:16vh;">Login</button>
                <button onclick="document.getElementById('id02').style.display='inline-block'" style="width:16vh;">Register</button>
                </div>
                <div id="id01" class="modal">
                
                    <form class="modal-content animate" id="login">
                        <div class="imgcontainer">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close"
                                title="Close Modal">&times;</span>
                            <img src="Logo1.png" alt="Healtdec" class="logo">
                        </div>
                
                        <div class="container">
                            <label for="email"><b>Email</b></label>
                            <input type="text" placeholder="Enter email address" name="email" required>
                
                            <label for="psw"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                            <p id="error"></p>
                            <button type="submit">Login</button>
                            <label>
                                <input type="checkbox" checked="checked" name="remember">
                                <span class="remembertext">Remember me</span>
                            </label>
                        </div>
                
                        <div class="container">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                class="cancelbtn">Cancel</button>



                                <span class="psw"> Forgot <a href="#" onclick="document.getElementById('id03').style.display='block'" style="width:auto;">password?</a>
              
                                </span>

                        </div>
                    </form>
                </div>
                
                <div id="id02" class="modal">
                
                    <form class="modal-content animate" id="register">
                        <div class="imgcontainer">
                            <span onclick="document.getElementById('id02').style.display='none'" class="close"
                                title="Close Modal">&times;</span>
                            <img src="Logo1.png" alt="Healtdec" class="logo">
                        </div>
                
                        <div class="container">
                            <label for="email"><b>Email</b></label>
                            <input type="text" placeholder="Enter email address" name="email" required>
                
                            <label for="psw"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                
                            <label for="psw2"><b>Re-enter password</b></label>
                            <input type="password" placeholder="Enter Password again" name="psw2" required>
                            <p id="regerror"></p>
                            <button type="submit">Register</button>
                        </div>
                
                        <div class="container" style="background-color:#f1f1f1">
                            <button type="button" onclick="document.getElementById('id02').style.display='none'"
                                class="cancelbtn">Cancel</button>
                        </div>
                    </form>
                </div>

                <div id="id03" class="modal">
          
                    <form class="modal-content animate" action="/action_page.php">
                      <div class="imgcontainer">
                        <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <img src="Logo1.png" alt="Healtdec" class="logo">
                      </div>
                  
                      <div class="container">
                            <label for="email"><b>Email</b></label>
                            <input type="text" placeholder="Enter email address" name="email" required>
                        <button type="submit">Send password</button>
                      </div>
                  
                      <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
                      </div>
                    </form>
                  </div>
                
                <script>
                    // Get the modal
                    var modal = document.getElementById('id01');
                    var modal2 = document.getElementById('id02');
                    var modal3 = document.getElementById('id03');

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function (event) {
                        console.log(event)
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                        if (event.target == modal2) {
                            modal2.style.display = "none";
                        }
                        if (event.target == modal3) {
                            modal3.style.display = "none";
                        }
                    }
                    const login = document.getElementById('login');

                    login.addEventListener('submit', function (e) {

                        e.preventDefault();

                        const formData = new FormData(this);

                        fetch('login.php', {
                            method: 'post',
                            body: formData
                            }).then(function (response) {
                                return response.text();
                            }).then(function (text) {
                                document.getElementById("error").innerHTML = (text);
                                if((text) == "Success!"){
                                    window.location.href = "account.php";
                                }
                            }).catch(function (error) {
                                console.error(error);
                            })
                    });

                    const register = document.getElementById('register');

                    register.addEventListener('submit', function (e) {

                        e.preventDefault();

                        const formData = new FormData(this);

                        fetch('register.php', {
                            method: 'post',
                            body: formData
                            }).then(function (response) {
                                return response.text();
                            }).then(function (text) {
                                document.getElementById("regerror").innerHTML = (text);
                                if((text) == "Success!"){
                                    modal.style.display = "inline-block";
                                    modal2.style.display = "none";
                                    modal3.style.display = "none";
                                }
                            }).catch(function (error) {
                                console.error(error);
                            })
                    });


                </script>
            </div>

            
        </div>

        <div id="second" class="page">

                <div class="secondone">
                    <h1>About Healthdec</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum laoreet metus id congue facilisis. Nulla facilisi. Donec eget risus ut lectus convallis aliquet a et purus. Nulla maximus rhoncus velit, vitae iaculis sem sollicitudin ut. Quisque neque leo, luctus non ultricies in, cursus nec ipsum. Nulla magna nibh, lobortis sit amet egestas quis, tincidunt in tellus. Phasellus aliquet, sapien nec cursus scelerisque, turpis felis accumsan odio, sit amet tempus velit enim eu nulla. Sed vel euismod augue, in viverra mi. Morbi eu laoreet leo. In tempor nulla arcu, sit amet imperdiet nisi maximus finibus. Nullam gravida sagittis quam, a laoreet dui volutpat et.</p>
                </div>

                <div class="secondtwo">
                    <h1>No en kyllä tiedä</h1>
                    <p>Vestibulum dictum, erat ut condimentum varius, eros nisi gravida ligula, et rutrum purus eros ut dui. Proin facilisis a erat sit amet finibus. Duis sed maximus libero, in imperdiet elit. Phasellus lobortis justo a ornare laoreet. Etiam ut lacus vel dolor luctus facilisis. Maecenas sagittis ornare auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam non eros sit amet odio facilisis fermentum. Nullam laoreet urna a sapien viverra mattis.</p>

                </div>     
        </div>

        <footer class="footer-distributed">

			<div class="footer-left">

				<h3>Healthdec</h3>


				<p class="footer-company-name">Healthdec &copy; 2019</p>
			</div>

			<div class="footer-center">

				<div>
					<i class="fa fa-map-marker"></i>
					<p><span>28 Metropöliätie</span> Helsinki, Finland</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+123 123123123</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="#">healthdec@examplemail.com</a></p>
				</div>

			</div>

			<div class="footer-right">

				<p class="footer-company-about">
					<span>About the company</span>
					Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
				</p>

				<div class="footer-icons">

					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					
					<a href="#"><i class="fa fa-github"></i></a>

				</div>

			</div>

		</footer>

    </body>
</html>