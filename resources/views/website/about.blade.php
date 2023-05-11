<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Dr. Ringia Hotel Website</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
       <!-- loader  -->
       <div class="loader_bg">
      <div class="loader">
  <img src="images/loading.gif" style="height:50px; width:50px" alt="#">
</div>

      </div>
        
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                           <a href="{{ url('/') }}"><img src="img/logo/logo.png" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item ">
                                 <a class="nav-link" href="{{ url('/') }}">Home</a>
                              </li>
                              <li class="nav-item active">
                                 <a class="nav-link" href="{{ route('about') }}">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ route('ourRoom') }}">Facilities</a>

                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                              </li>
                           
                              <li class="nav-item ">
                                 <a class="nav-link" href="{{url('/login')}}">PMS</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                              </li>
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <div class="back_re">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                     <h2>About Us</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about -->
      <div class="about">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-5">
                  <div class="titlepage">
                    
                     <p class="margin_0">
The Dr. Magadapa Ali Ringia Hotel was named after the late superintendent of the Mindanao State University—Maigo School of Arts and Trades, Sultan Gaos Magadapa Ali Ringia, because of the legacy of the late superintendent of the campus. The original name of the hotel was Sultan Gaos Magadapa Ali Ringia Memorial Building, but it was changed into Dr. Magadapa Ali Ringia Hotel, and the hotel is commonly known as MSU-MSAT Hotel. </p>

<p>Mission <br> 1. Lead in social tranformation through peace education and integration of the muslims and other cultural minority groups into the mainstream society:

<br> 2. Ensure excellence in instruction, research development, enovation, extension, and environmental education and discovery:

<br> 3. Advance national and international linkages through collaborations: and

<br>4. Demonstrate greater excellence, relevance and inclusiveness for Mindanao and the Filipino Nation.</p>
<p>Vision <br> MSU System aspires to be a center of excellence in instruction, research and extension transforming itself into a premiere and globally competitive national peace university.</p>
<a class="read_more" href="Javascript:void(0)"> Read More</a>
                  </div>
               </div>
               <div class="col-md-7">
                  <div class="about_img">
                     <figure ><img style="border-radius:20px;" src="images/hotelmsat.jpg" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
     
  <!--  footer -->
  <footer>
         <div class="footer">
            <div class="container">
               <div class="row" id="foot">
                  <div class=" col-md-5" id="contact">
                     <h3>Contact US</h3>
                     <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i>Maigo, Lanao del Norte</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i>227-4208</li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#">drringiahotel.03@gmail.com</a></li>
                      </ul>
                  </div>
                  <div class="col-md-5" >
                     
                     <ul class="social_icon">
                        <li><a href="https://www.facebook.com/profile.php?id=100085898087309" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li> <a href="https://twitter.com/Dr_Ringia_Hotel" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
                   <div class="row">
                     
                     <div class="col-md-10 offset-md-1">
                        
                        <p>
                        © 2022-2023 All Rights Reserved. </a>
                       

                     </div>
                     </div>
                 
                
               </div>
            </div>
            
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>