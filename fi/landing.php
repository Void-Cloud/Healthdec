<?php
    require_once('HTTPS.php');
    session_start([
        'read_and_close'  => true,
    ]);
    if(!($_SESSION['name'] == "")){
        header("Location: FirstPage.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
<!DOCTYPE html>
<html lang="en">
<head>
 
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="landingcss.css">

<!-- FONTS AND FOOTER STYLE  -->
<link rel="stylesheet" href="footer-distributed-with-address-and-phones.css">	
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">

<title>Healthdec</title>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#237afc"
    },
    "button": {
      "background": "#fff",
      "text": "#237afc"
    }
  },
  "theme": "classic",
  "content": {
    "message": "Tämä nettisivu käyttää evästeitä parhaan käyttökokemuksen varmistamiseksi.Käyttämällä sivustoa hyväksyt evästeiden käytön.",
    "dismiss": "Jatka!",
    "link": "Lisätietoa"
  }
})});
</script>
</head>
    <body>

            
            <header class="header">
                
            <nav>
                
                 <ul>
                    <li><a href="../en/landing.php"><img src="Engflag.jpg" alt="ENG"></a></li>
                    <li><a href="../fi/landing.php"><img src="Finflag.png" alt="FI"></a></li>
                </ul> 
            </nav>
            
            </header>
            <!--<div id="ac-wrapper" style='display:none'>
                    <div id="popup">
                        <center>
                             <h2>This website uses cookies. By continuing you agree to our terms.</h2>
                
                            <input type="submit" name="submit" value="Continue" onClick="PopUp('hide')" />
                        </center>
                    </div>
                </div>
            window.onload = function () {
                setTimeout(function () {
                    PopUp('show');
                }, 2000);
            }
            -->

        <div id="first" class="page"></div>
            <div class="heading">
                <span class="title1">Healthdec</span>
                <span class="title2">Step into the Healthdec!</span>

                <div class="parent">
                <button onclick="document.getElementById('id01').style.display='inline-block'" >Kirjaudu</button>
                <button onclick="document.getElementById('id02').style.display='inline-block'" >Rekisteröidy</button>
                </div>
                <div id="id01" class="modal">
                
                    <form class="modal-content animate" id="login">
                        <div class="imgcontainer">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close"
                                title="Close Modal">&times;</span>
                            <img src="Logo1.png" alt="Healtdec" class="logo">
                        </div>
                
                        <div class="container">
                            <label for="email"><b>Sähköposti</b></label>
                            <input type="text" placeholder="Enter email address" name="email" required>
                
                            <label for="psw"><b>Salasana</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                            <p id="error" style="font-size: 16px; color:red"></p>
                            <button type="submit">Kirjaudu sisään</button>
                            <label>
                                <input type="checkbox" checked="checked" name="remember">
                                <span class="remembertext">Pidä minut kirjautuneena</span>
                            </label>
                        </div>
                
                        <div class="container">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                class="cancelbtn">Peruuta</button>



                                <span class="psw"> Unohtuiko <a href="#" onclick="document.getElementById('id03').style.display='block'" style="width:auto;">salasana?</a>
              
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
                            <label for="email"><b>Sähköposti</b></label>
                            <input type="email" placeholder="Enter email address" name="email" required>

                            <label for="psw"><b>Salasana</b></label>
                            <p style="font-size: 16px">Salasanassa täytyy olla pieni kirjain, iso kirjain ja numero ja sen täytyy olla 4-30 merkkiä pitkä.</p>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                
                            <label for="psw2"><b>Syötä salasana uudestaan</b></label>
                            <input type="password" placeholder="Enter Password again" name="psw2" required>
                            <p id="regerror" style="font-size: 16px; color:red"></p>
                            <button type="submit">Rekisteröidy</button>
                        </div>
                
                        <div class="container" style="background-color:rgba(255, 255, 255, 0)">
                            <button type="button" onclick="document.getElementById('id02').style.display='none'"
                                class="cancelbtn">Peruuta</button>
                        </div>
                    </form>
                </div>

                <div id="id03" class="modal">
          
                    <form class="modal-content animate">
                      <div class="imgcontainer">
                        <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <img src="Logo1.png" alt="Healtdec" class="logo">
                      </div>
                  
                      <div class="container">
                            <label for="email"><b>Salasana</b></label>
                            <input type="text" placeholder="Enter email address" name="email" required>
                        <button type="submit">Lähetä salasana</button>
                      </div>
                  
                      <div class="container" style="background-color:#fff">
                        <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Peruuta</button>
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
                                    window.location.href = "FirstPage.php";
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
                                    alert("Registeration successful, please login.");
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
                    <h1>Tietoa Healthdec:stä</h1>
                    <p>Healthdec on uusi terveyden seurantaan tarkoitettu sovellus. Sovelluksen 
                        avulla voi seurata verensokeria, verenpainetta, sekä ruumiinpainoa. 
                        Sovellus generoi helposti luettavia kuvaajia, joiden avulla käyttäjän 
                        on helppo seurata omia arvojaan. Tietojen syötön jälkeen käyttäjä voi halutessaan  
                        kätevästi ladata arvonsa PDF-tiedostona ja lähettää tiedostot vaikka lääkärille. 
                        Yksityisyytesi on meille tärkeää, emmekä me luovuta tietoja eteenpäin ilman suostumusta.
                    </p>
                </div>

                <div class="secondtwo">
                    <h1>Keitä me olemme</h1>
                    <p>Olemme neljä terveys- ja hyvinvointitekniikan korkeakouluopiskelijaa Metropolian Ammattikorkeakoulusta. 
                        Sivusto on tehty osana opintojamme.
                    </p>

                </div>     
        </div>

        <button onclick="topFunction()" id="myBtn" title="Go to top">⇧</button>
        <footer class="footer-distributed">

			<div class="footer-left">

				<div class="logo-box">
                    <img src="Logo1.png" alt="LOGO">
				</div>


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
					<span>Tietoa sivusta</span>
					Tämä sivu on tehty osana Metropolian Ammattikorkeakoulun kurssiprojektia.
				</p>

				<div class="footer-icons">

					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					
					<a href="#"><i class="fa fa-github"></i></a>

				</div>

			</div>

        </footer>
        <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};
            
            function scrollFunction() {
              if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
              } else {
                document.getElementById("myBtn").style.display = "none";
              }
            }
            
            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
              document.body.scrollTop = 0;
              document.documentElement.scrollTop = 0;
            }
            </script>
            <script>
            function PopUp(hideOrshow) {
                if (hideOrshow == 'hide') document.getElementById('ac-wrapper').style.display = "none";
                else document.getElementById('ac-wrapper').removeAttribute('style');
            }
            
            </script>

    </body>
</html>