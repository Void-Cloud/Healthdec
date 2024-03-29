
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <link rel="stylesheet" href="firstpagecss.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="footer-distributed-with-address-and-phones.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
  <title>Healthdec</title>

</head>

<body>

  <div class="uppersection">
    <div class="upperbar">
      <img src="logosmall.png" alt="Healtdec" class="logo">
      <button id="logoutbutton"><i class="fa fa-sign-out"
          style="font-size:24px;  padding-right:2px; "></i>Logout</button>

    </div>
    <h1>Healthdec</h1>

    <div class="upperlist">
      <a href="FirstPage.php">Home</a>
      <a href="ourteam.html">Our Team</a>
      <a href="ContactUs.html">Contact Us</a>
    </div>

  </div>

  <nav role="navigation">
    <ul>
      <li><a href="#">Choose a form</a>
        <ul class="dropdown">
          <li data-rel="1" class="active">Blood Sugar</li>
          <li data-rel="2">Blood Pressure</li>
          <li data-rel="3">Weight</li>
        </ul>
      </li>
    </ul>
  </nav>

  <section>
    <article>
      <div class="row">

        <div class="mainleft">
          <h2>Blood Sugar</h2>
          <h5>Please enter and add your information</h5>

          <form class="formbloodsugar" id="sugar" name= "sugar">

            <div class="container">
              <label for="bloodsugar"><b>Blood Sugar</b></label>
              <input type="text" placeholder="0.0 (mmol/L)" name="bloodsugar" required>

              <label for="bloodsugar"><b>Date</b></label>
              <input type="date" placeholder="YYYY-MM-DD" value="<? echo date("Y-m-d")?>" name="date" required>

              <label for="bloodsugar"><b>Time</b></label>
              <input type="time" placeholder="HH:MM" value="<? echo date("H:i")?>" name="time" required>

              <p id="result" style="font-size: 16px; color:red"></p>

              <input type="hidden" name="bsoffset" value="0" id="bsoffset">

              <button type="submit">Add</button>

            </div>

          </form>
          <button onclick="bsdelval()" type="latest">Delete latest value</button>
          <p id="yay" style="font-size: 16px"></p>
        </div>

        <script>
        
        function increaseoffset(){

            document.getElementById("bsoffset").value = 1;

            const formData = new FormData(sugar);

            fetch('fsugar.php', {
                method: 'post',
                body: formData
                }).then(function (response) {
                    return response.text();
                }).then(function (text) {
                    document.getElementById("bsv").innerHTML = (text);
                }).catch(function (error) {
                    console.error(error);
                })
        }
        function decreaseoffset(){

            document.getElementById("bsoffset").value = 2;

            const formData = new FormData(sugar);

            fetch('fsugar.php', {
                method: 'post',
                body: formData
                }).then(function (response) {
                    return response.text();
                }).then(function (text) {
                    document.getElementById("bsv").innerHTML = (text);
                }).catch(function (error) {
                    console.error(error);
                })
        }
        function fetchnewest(){

            document.getElementById("bsoffset").value = 0;

            const formData = new FormData(sugar);

            fetch('fsugar.php', {
                method: 'post',
                body: formData
                }).then(function (response) {
                    return response.text();
                }).then(function (text) {
                    document.getElementById("bsv").innerHTML = (text);
                }).catch(function (error) {
                    console.error(error);
                })
        }
        function bsdelval(){
          const formData = new FormData(sugar);
          fetch('bsdelval.php', {
            method: 'post',
            body: formData
            }).then(function (response) {
                return response.text();
            }).then(function (text) {
                document.getElementById("yay").innerHTML = (text);
                fetchnewest();
            }).catch(function (error) {
                console.error(error);
            })
        }
        

        const sugar = document.getElementById('sugar');

        sugar.addEventListener('submit', function (e) {

            e.preventDefault();

            const formData = new FormData(this);

            fetch('sugar.php', {
                method: 'post',
                body: formData
                }).then(function (response) {
                    return response.text();
                }).then(function (text) {
                    document.getElementById("result").innerHTML = (text);
                }).catch(function (error) {
                    console.error(error);
                })

            fetchnewest();
        });
        fetchnewest();


        </script>

        <div class="mainright">
          <div class="fakeimg" id="bsv">Kaava1</div>
          <button onclick="increaseoffset()" type="direction">⇦</button>
          <button onclick="decreaseoffset()" type="direction">⇨</button>
        </div>
      </div>
    </article>
  </section>

  <section>
    <article>
      <div class="row">

        <div class="mainleft">
          <h2>Blood Pressure</h2>
          <h5>Please enter and add your information</h5>

          <form class="formbloodsugar">

            <div class="container">
              <label for="bloodsugar"><b>Systolic</b></label>
              <input type="text" placeholder="0.0 (mmHg)" name="systolic" required>

              <label for="bloodsugar"><b>Diastolic</b></label>
              <input type="text" placeholder="0.0 (mmHg)" name="diastolic" required>

              <label for="bloodsugar"><b>Date</b></label>
              <input type="text" placeholder="DD/MM/YYYY" name="Date" required>

              <label for="bloodsugar"><b>Time</b></label>
              <input type="text" placeholder="HH:MM" name="Time" required>

              <button type="addbutton">Add</button>
              <button type="latest">Delete latest value</button>

            </div>

          </form>
        </div>

        <div class="mainright">
          <div class="fakeimg">Kaava2</div>
          <button type="direction">⇦</button>
          <button type="direction">⇨</button>
        </div>
      </div>
    </article>
  </section>

  <section>
    <article>
      <div class="row">

        <div class="mainleft">
          <h2>Weight Tracker</h2>
          <h5>Please enter and add your information</h5>

          <form class="formbloodsugar">

            <div class="container">
              <label for="bloodsugar"><b>Weight</b></label>
              <input type="text" placeholder="0.0 (kg)" name="weight" required>

              <label for="bloodsugar"><b>Date</b></label>
              <input type="text" placeholder="DD/MM/YYYY" name="Date" required>

              <label for="bloodsugar"><b>Time</b></label>
              <input type="text" placeholder="HH:MM" name="Time" required>

              <button type="addbutton">Add</button>
              <button type="latest">Delete latest value</button>

            </div>

          </form>
        </div>

        <div class="mainright">
          <div class="fakeimg">Kaava3</div>
          <button type="direction">⇦</button>
          <button type="direction">⇨</button>
        </div>
      </div>
    </article>
  </section>
  <button onclick="topFunction()" id="myBtn" title="Go to top">⇧</button>
  <!-- Footer -->
  <footer class="footer-distributed">

    <div class="footer-left">

      <img src="logo1.png" alt="Healtdec" class="logo">


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
        Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus
        vehicula sit amet.
      </p>

      <div class="footer-icons">

        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>

        <a href="#"><i class="fa fa-github"></i></a>

      </div>

    </div>

  </footer>
  <!-- For same page forms-->
  <script>
    (function ($) {
      $('nav li').click(function () {
        $(this).addClass('active').siblings('li').removeClass('active');
        $('section:nth-of-type(' + $(this).data('rel') + ')').stop().fadeIn(0, 'linear').siblings('section').stop().fadeOut(0, 'linear');
      });
    })(jQuery);
  </script>
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

</body>

</html>