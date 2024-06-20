<?php
    session_start();
    if( !isset($_SESSION["user"]) ) {
        header("location:login.php");
    }
?>

<?php
    require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="room.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    
  </head>
  <body>
  <?php
      if(isset($_GET['page_layout'])){
          switch($_GET['page_layout']) {
              case 'danhsach':
                  require_once 'kieuphong/danhsach.php';
                  break;

              case 'them':
                  require_once 'kieuphong/them.php';
                  break;
              
              case 'sua':
                  require_once 'kieuphong/sua.php';       
                  break;        
              case 'xoa':    
                  require_once 'kieuphong/xoa.php';
                  break;
              default:
                  require_once 'kieuphong/danhsach.php';
                  break;
          }
      }else{
          require_once 'kieuphong/danhsach.php';
      }
      
    ?>
  </body>
</html>