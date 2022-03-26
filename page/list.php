<?php

    session_start();             
    $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
    if(isset($_GET['action']) && $_GET['action']=='list')
    {

        
         
            $sel='SELECT * FROM produit';
            $req=$db->prepare($sel);
            $req->execute();
            $data=$req->fetchAll();
            echo json_encode($data);
        
    }

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
           $arr=[];
           $name=$_POST['nom'];
           $prenom=$_POST['prenom'];
           $date=$_POST['date'];
           $nb=$_POST['nb'];
           $tel=$_POST['tel'];
           $heure=$_POST['heure'];
           if(empty($name) || empty($prenom) || empty($name) || empty($date) || empty($nb)|| empty($tel) || empty($heure))
           {
           
               $arr['err']=true;
               $arr['msg']='Renseignez tout les champs';
           }

           else
           {
               
                    $rand=rand();    
                    $ins='INSERT INTO reservation(nom,prenom,date_r,nbre_table,tel,heure,aleatoire)
                    VALUES
                    (?,?,?,?,?,?,?)
                    ';
                    $req=$db->prepare($ins);
                    $req->execute([$name,$prenom,$date,$nb,$tel,$heure,$rand]);
                    $arr['err']=false;
                    $arr['msg']='Votre reservation a ete enregistrer';
                    $_SESSION['al']=$rand;
  

           }

           echo json_encode($arr);

    }



?>
