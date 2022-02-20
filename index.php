<!doctype html>
<html>
<head>
 
   <meta name="robots" content="noindex,nofollow">
   <title>AJAX Pet Adoption Agency</title>
   <style>
       #myForm div{
        margin-bottom:2%;
        }
     
          /*changes font and highlights the pet name */
        .petName {
          font-family: Lucida Sans;
          background-color: yellowgreen;
          font-size: 20px;
          
        }
     
   </style>
   <script src="https://code.jquery.com/jquery-latest.js"></script>
   
</head>
<body>
<h2>AJAX Pet Adoption Agency</h2>
<p>Make some choices, and reveal your pet!</p>
<div id="output">
  
<p>This page uses AJAX and jQuery, the website gives a choice of 3 radio questions and a textbox that prompts the user to name their pet. There is a different pet for every possible combination! These questions appear one at a time, and the data is transmitted to a server-side page via AJAX. This project also uses the jQuery library for processing and transmitting the data.</p>
<p>The form below allows individuals to adopt a pet based on their preferences! The following questions will allow the user to 'choose a pet' for adoption, each question must be answered before the application can be submitted. Once the user has made their selections, their new pet is revealed, complete with an image and description of their new pet!</p>
<p>Choose below to pick a pet:</p>
  
<form id="myForm" action="" method="get">

   <div id="pet_feels">
       <h3>Feels</h3>
       <p>Please choose how you would like your pet to feel:</p>
       <input type="radio" name="feels" value="fluffy" required="required">fluffy <br />
       <input type="radio" name="feels" value="scaly">scaly <br />
   </div>
   <div id="pet_likes">
       <h3>Likes</h3>
       <p>Please tell us what your pet will like:</p>
       <input type="radio" name="likes" value="petted" required="required">to be petted <br />
       <input type="radio" name="likes" value="ridden">to be ridden <br />
   </div>
    <div id="pet_eats">
       <h3>Eats</h3>
       <p>Please tell us what your pet likes to eat:</p>
       <input type="radio" name="eats" value="carrots" required="required">carrots <br />
       <input type="radio" name="eats" value="pets">other people's pets <br />
   </div>
    <div id="pet_name">
       <h3>Name</h3>
       <p>Please tell us what you want your pet to be called:</p>
       <input type="text" name="petName" value="" placeholder="Name" required="required"> <br />
   </div>
  
   <div><input type="submit" value="submit it!" /></div>
</form>
</div>
<p><a href="index.php">RESET</a></p>
<script>
  
    //titleCase function
    function titleCase(str){
      str = str.toLowerCase().split(' ');
      for (var i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
      }
      return str.join(' ');
    };

    $("document").ready(function(){
        
        //hide likes and eats
        $('#pet_likes').hide();
        $('#pet_eats').hide();
        $('#pet_name').hide();

        //on click of feels, likes is shown
        $('#pet_feels').click(function(e){
          $('#pet_likes').slideDown(200);
        });

        //on click of likes, eats is shown
        $('#pet_likes').click(function(e){
          $('#pet_eats').slideDown(200);
        });

      //on click of eats, name is shown
        $('#pet_eats').click(function(e){
          $('#pet_name').slideDown(200);
        });
      
        
        $('#myForm').submit(function(e){
            e.preventDefault();//no need to submit as you'll be doing AJAX on this page
            let feels = $("input[name=feels]:checked").val();
            let likes = $("input[name=likes]:checked").val();
            let eats = $("input[name=eats]:checked").val();
            let petName = $("input[name=petName]:contains()").val()
            let pet = "";
            var output = "";

            if(feels == "fluffy" && likes == "petted" && eats == "carrots"){
              pet = "rabbit";
            }
          
            if(feels == "scaly" && likes == "ridden" && eats == "pets"){
              pet = "velociraptor";
            }

            if(feels == "scaly" && likes == "petted" && eats == "carrots"){
              pet = "hedgehog";
            }

            if(feels == "fluffy" && likes == "ridden" && eats == "carrots"){
              pet = "dane";
            }
          
            if(feels == "fluffy" && likes == "petted" && eats == "pets"){
              pet = "bad-dog";
            }

            if(feels == "scaly" && likes == "petted" && eats == "pets"){
              pet = "bird";
            }
            if(feels == "fluffy" && likes == "ridden" && eats == "pets"){
              pet = "greyhound";
            }
       
            if(feels == "scaly" && likes == "ridden" && eats == "carrots"){
              pet = "cat";
            }
           // alert(feels);

             //this titleCase
            petName = titleCase(petName);

            //the span class is created here, so that we can refer to it in the <style> tag for css
            output += `<p>A new addition to your family! You have a ${pet} as a new pet! Your pet's name is <span class="petName">${petName}</span>. </p> 
            <p>Take care, we will miss ${petName}!</p>`

              
          output += `<p>Congratulations! You have a new pet ${pet}:</p>`;
          output += `<p>Your pet feels ${feels}.</p>`;
          output += `<p>Your pet likes to be ${likes}.</p>`;
          output += `<p>Your pet likes to eat ${eats}.</p>`;
          output += `<p>Your pet is called ${petName}.</p>`;


          // get data from server side page using AJAX
          $.get( "includes/get_pet.php", { critter: pet } )
           .done(function( data ) {
           //alert( "Data Loaded: " + data );
           $('#output').html(data + output);
           })
             .fail(function(xhr, status, error) {
             //Ajax request failed.
             var errorMessage = xhr.status + ': ' + xhr.statusText
             alert('Error - ' + errorMessage);
           })
          ;

          // lets output info about the pet to the page
     
          
        });

    });

   </script>
</body>
</html>
