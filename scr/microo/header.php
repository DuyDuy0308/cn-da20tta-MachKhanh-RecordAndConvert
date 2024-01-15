<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>microo</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css" />
      <link rel="stylesheet" href="plugins/dropzone/min/dropzone.css" />
      
   </head>
   <body class="main-layout">
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="" /></div>
      </div>
      <div id="mySidepanel" class="sidepanel">
         <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
         <a href="index.php" onclick="resetAudio() ">Home</a>
         <a href="record.php" onclick="resetAudio()">Record</a>
         <a href="upload.php" onclick="resetAudio()">Upload</a>
         <a href="question.php" onclick="resetAudio()">Question</a>
      </div>
      <header>
         <div class="head-top">
            <div class="container-fluid">
               <div class="row d_flex">
                  <div class="col-sm-3">
                     <div class="logo">
                           <a href="index.php"><img src="images/logo.png" /></a>              
                     </div>
                     <li> <button class="openbtn" onclick="openNav()"><img src="images/menu_btn.png"></button></li>
                  </div>
                  <div class="col-sm-9">
                     <ul class="email text_align_right">                
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </header>
