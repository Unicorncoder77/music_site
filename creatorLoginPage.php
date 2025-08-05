<!DOCTYPE html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> Creator Portal </title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
          input[type=text], input[type=password] {
             width: 100%;
             padding: 15px;
             margin: 5px 0 22px 0;
             display: inline-block;
             border: none;
             background: #F2EBD7;
          }
          input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
          }
          button {
                background-color: #588157;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
                opacity: 0.9;
         }

         button:hover {
                opacity: 1;
         }

         .cancelbtnCreatorSign {
                padding: 14px 20px;
                background-color: #f02d3a;
         }

         .cancelbtnCreatorSign, .signupbtnCreatorSign {
                float: left;
                width: 50%;
         }

         .creatorLoginBox{
                padding: 16px;
         }

         .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: #AEAEAE;
                padding-top: 50px;

         }

         .modal2 {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: #AEAEAE;
                padding-top: 50px;
        }


         .creatorLogin {
                background-color: #F2EBD7;
                margin: 5% auto 15% auto;
                border: 1px solid #888;
                width: 80%;
         }

         h1 {
                text-align: center;
         }

         h3 {
                text-align: center;
         }

         .close {
                position: absolute;
                right: 35px;
                top: 15px;
                font-size: 40px;
                font-weight: bold;
                color: black;
         }

         .close:hover, .close:focus {
                color: #f02d3a;
                cursor: pointer;
         }

         .clearfixCreatorSign {
                content: "";
                clear: both;
                display: table;
         }

         .buttonCenter {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 200px;
         }

         .creatorSign {
                background-color: #588157;
                color: black;
         }

        </style>
   </head>

   <body>
        <header>
            <h1> The Experience </h1>
            <nav class="homeNav" id="navigation-bar">
                <a href="index.php">Home</a>
                <a href="#">About</a>
                <a href="#">Articles</a>
                <a href="#">Reviews</a>
                <a href="#">Contact</a>
                <div class="search">
<!-- Add actual action to the form-->
                  <form action="#">
                     <input type="text" placeholder="Search" name="search">
                        <button class="search" type="submit">
                           <i class="fa fa-search"></i>
                        </button>
                  </form>
                </div>
           </nav>
        </header>
                <h1> Thank you for wanting to create for The Experience!</h1>
                <h3> If you're a new creator, sign up below!</h3>
        <div class="buttonCenter">
        <button class="creatorSign" onclick="document.getElementById('modal').style.display='block'" style="width:auto;">Sign Up</button>
        </div>
        <div id="modal" class="modal">
          <span onclick="document.getElementById('modal').style.display='none'" class="close" title="Close Modal">&times;</span>

        <form method="POST" action="creatorProcess.php" class="creatorLogin">
           <div class="creatorLoginBox">
                <h1> Sign Up </h1>
                <p class="fillOut"> Please Fill Out All Fields </p>
                <hr class="signLine">

                <label for="firstName" > First Name: </label>
                <input type="text" placeholder="John" name="firstName" class="firstName" required>

                <label for="lastName"> Last Name: </label>
                <input type="text" placeholder="Doe" name="lastName" class="lastName" required>

                <label for="penName"> Pen Name: </label>
                <input type="text" placeholder="BigJ" name="penNameSign" class="penNameSign" required>

                <label for="emailSign"> Email: </label>
                <input type="text" placeholder="JohnDizzyDoe25@gmail" name="emailSign" class="emailSign" required>

                <label for="pswSign"> Enter a Password: </label>
                <input type="password" placeholder="BigJohn1995" name="pswSign" class="pswSign" required>

                <label for="pswSignRepeat"> Repeat Password </label>
                <input type="password" placeholder="Repeat Password" name="pswSignRepeat" class="pswSignRepeat" required>
                <div class="clearfixCreatorSign">
                  <button type="submit" class="signupbtnCreatorSign" name="signup"> Sign Up </button>
                  <button type="button" class="cancelbtnCreatorSign" id="cancelbtnCreatorSign"> Cancel </button>

                 </div>
            </div>

          </form>
        </div>
        <h3> If you're a returning creator, login right here: </h3>
        <div class="buttonCenter">
        <button class="creatorSign" onclick="document.getElementById('modal2').style.display='block'" style="width:auto;">Login</button>
        </div>
        <div id="modal2" class="modal2">
          <span onclick="document.getElementById('modal2').style.display='none'" class="close" title="Close Modal">&times;</span>

        <form method="POST" action="creatorProcess.php" class="creatorLogin">
           <div class="creatorLoginBox">
                <h1> Login </h1>
                <p class="fillOut"> Please Fill Out All Fields </p>
                <hr class="signLine">



                <label for="penName"> Pen Name: </label>
                <input type="text" placeholder="BigJ" name="penNameLog" class="penNameSign" required>


                <label for="pswSign"> Enter your Password: </label>
                <input type="password" placeholder="BigJohn1995" name="pswLog" class="pswSign" required>

                <div class="clearfixCreatorSign">
                  <button type="submit" class="signupbtnCreatorSign" name="login"> Login </button>
                  <button type="button" class="cancelbtnCreatorSign"> Cancel </button>

                 </div>
            </div>


 <!-- Make them modal buttons -->
        <script>
          var modal = document.getElementById('modal');
          window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
          }

         var modal2 = document.getElementById('modal2');
         window.onclick = function(event){
            if (event.target == modal2) {
                modal2.style.display = "none";
           }
         }

         document.getElememtById('signupbtnCreatorSign').addEventListener('click', function() {
              window.location.href = 'creatorLoginPage.php';
         });
        </script>
   </body>
</html>