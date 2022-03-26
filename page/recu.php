<?php
    session_start();
    if(isset($_SESSION['al'])):

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recu a imprimer</title>
    <style>
          .imp
          {
        
               width: 80%;
               margin: 0 auto;
               
          }

          .imp h1
          {
              text-align:center;
          }
          .imp table
          {
              position: relative;
              left: 50%;
              transform:translateX(-50%);
              border:1px black solid;
              padding: 20px;
              border-collapse:collapse;
              width: 100%;
          }

          td
          {
            border:1px black solid;
            padding: 20px;
            font-weight:bold;
          }

          button
          {
              position: relative;
              left: 10%;
              margin-top:20px;
              padding: 15px;
              background-color:crimson;
              color:#fff;
              font-weight:bolder;
              border:none;
              
          }
          button:hover
          {
            background-color:#fff;
            border:1px crimson solid;
            color:#000;
           
          }
          @media all and (max-width:600px)
          {
                .imp
                {
                
                    width: 100%;
                    margin: 0 auto;
                    
                }
                .imp table
                {
                    width: 100%;
                }
          }
    </style>
</head>
<body>
        <?php

                        
               $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
                $sel='SELECT * FROM reservation WHERE aleatoire=? ';
                $req=$db->prepare($sel);
                $req->execute([$_SESSION['al']]);
                $data=$req->fetchAll();
               
        ?>
        <div class="imp">
            <h1>Les delices</h1>
            <table>
                <tbody>
                     <tr>
                         <td>Nom :</td>
                         <td><?= $data[0]['nom'];?></td>
                     </tr>
                     <tr>
                         <td>Prenom </td>
                         <td><?= $data[0]['prenom'];?></td>
                     </tr>
                     <tr>
                         <td>nombre de table </td>
                         <td><?= $data[0]['nbre_table'];?></td>
                     </tr>

                     <tr>
                         <td>
                              date de reservation 
                         </td>
                         <td><?= $data[0]['date_r'];?></td>
                     </tr>

                     <tr>
                         <td>
                              Heure de reservation 
                         </td>
                         <td><?= $data[0]['heure'];?></td>
                     </tr>

                     <tr>
                         <td>
                              Telephone 
                         </td>
                         <td><?= $data[0]['tel'];?></td>
                     </tr>
                     
                </tbody>
            </table>

        </div>
        <button>Imprimer</button>
 
    <script src="../js/recup.js"></script>
</body>
</html>


<?php endif ?>


