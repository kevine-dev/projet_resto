<?php
   
    $array=['lib_err'=>'','err_qte'=>'','err_prix'=>'','err_cat'=>'','err_file'=>'','err_bool'=>true,'err'=>false];
   
    
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //var_dump($_FILES['file']);
        if(isset($_GET['action']) and $_GET['action']=='modify')
        {
            $new_lib=secure($_POST['nomp']);
            $new_qte=secure($_POST['qte']);
            $new_prix=secure($_POST['prix']);
            $new_cat=secure($_POST['categorie']);
            $id=secure($_POST['id']);
            $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
            $up='UPDATE produit SET lib_produit=?,qte=?,prix=?,categorie=? WHERE id=?';
            $req=$db->prepare($up);
            $req->execute([$new_lib, $new_qte,$new_prix,$new_cat,$id]);
            echo json_encode(['modify'=>true]);          
        }
        $err=0;
        if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action']=='add')
        {
            if(empty($_POST['nomp']))
            {
                $array['lib_err']='Le nom du produit est vide <br/>';
                $err++;
            }
            else
            {
                $nomp=secure($_POST['nomp']);
                if(strlen($nomp)>30)
                {
                    $array['lib_err']='Le nom est trop long';
                    $err++;
                }
            }
/*----------------------------------------------------------------------------------------*/
            if(empty($_POST['qte']))
            {
                $array['err_qte']='Pas de quantite <br/>';
                $err++;
            }
            else
            {
                $qte=secure($_POST['qte']);
                $qte=intval($qte);
                if($qte<=0)
                {
                    $array['err_qte']='La quantite doit etre positif <br/>';
                    $err++;
                }
            }
/*--------------------------------------------------------------------------------------------*/
            
            if(empty($_POST['prix']))
            {
                $array['err_prix']='Pas de prix <br/>';
                $err++;
            }
            else
            {
                $prix=secure($_POST['prix']);
                $prix=intval($prix);
                if($prix<=0)
                {
                    $array['err_prix']='La prix doit etre positif <br/>';
                    $err++;
                }
            }
/*-----------------------------------------------------------------------------------------------*/
           
/*---------------------------------------------------------------------------------------------------*/

            if(empty($_POST['categorie']))
            {
                $array['err_cat']='Pas de categorie <br/>';
                $err++;
            }
            else
            {
                $cat=secure($_POST['categorie']);            
            }

        
            if(isset($_FILES['file']) && $_FILES['file']['error']==0)
            {
                $filename=secure($_FILES['file']['name']);
                $size=$_FILES['file']['size'];
                $tmp=$_FILES['file']['tmp_name'];
                if($size >200000000)
                {
                    $array['err_file']='Le fichier est top lourd';
                    $err++;
                }
                else
                {
                    $allow_ext=['jpg','png'];
                    $extension=pathinfo($filename);
                    $extension=$extension['extension'];
                    if(!in_array($extension,$allow_ext))
                    {
                        $array['err_file']='extension non autoriser';
                        $err++;
                    }

                }

            }
            else
            {
                $array['err_file']='Une erreur s\'est produite';
                $err++;
            }

            if($err==0)
            {
                try
                {
                  
                    $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
                    $sel='SELECT * FROM produit WHERE lib_produit=? AND categorie=?';
                    $req=$db->prepare($sel);
                    $req->execute([$nomp,$cat]);
                    $data=$req->fetchAll();
                    
                    if(empty($data))
                    {
                        $sel='SELECT MAX(id) FROM produit';
                        $req=$db->prepare($sel);
                        $req->execute();
                        $d=$req->fetch();
                        $d=$d['MAX(id)']+1;
                        $filename=$d.'.jpg';
                        

                        if(move_uploaded_file($tmp,'upload/'.$filename))
                        {
                            $ins='INSERT INTO produit(lib_produit,qte,prix,categorie,lien) VALUES(?,?,?,?,?)';
                            $req=$db->prepare($ins);
                            $req->execute([$nomp,$qte,$prix,$cat,$filename]);
                            $array['msg']='Le produit a ete ajouter';
                            $array['err_bool']=false;
                            $array['err']=false;
                        }
                        else
                        {
                            $array['err']='une erreur s\'est produite pendant l\'enregistrement';
                        }
                    
                    }
                    else
                    {
                        $up='UPDATE produit SET qte=? WHERE lib_produit=? AND categorie=?';
                        $req=$db->prepare($up);
                        $req->execute([$qte,$nomp,$cat]);
                        $array['err']=true;
                    }
                  

                }
                catch(Exception $e)
                {
                    die('ERREUR '.$e->getMessage());
                }
                
                
            }
            echo json_encode($array); 


        }
//----------------------------------------------------------------------------------------------------------------------/*


    }
    if(isset($_GET['action']) && isset($_GET['id']))
    {
        $id=intval($_GET['id']);
        if($_GET['action']=='del')
        {

            $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
        
            $del='DELETE FROM produit WHERE id=?';
            $req=$db->prepare($del);
            $req->execute([$id]);
            unlink("upload/$id."."jpg");

            $sel='SELECT * FROM produit';
            $req=$db->prepare($sel);
            $req->execute();
            $data=$req->fetchAll();
            if(empty($data))
            {
                $tr='TRUNCATE TABLE produit';
                $req=$db->prepare($tr);
                $req->execute();
            }


            echo json_encode(['suppression valider']);

        }
    }
//-----------------------------------------------------------------------------------------------------------
    if(isset($_GET['action']) && $_GET['action']=='list')
    {
    
        
            $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
            $sel='SELECT * FROM produit ORDER BY id DESC';
            $req=$db->prepare($sel);
            $req->execute();
            $data=$req->fetchAll();
            echo json_encode($data);
        
    }
//-----------------------------------------------------------------------------------------------------------
    if(isset($_GET['action']) && $_GET['action']=='modify')
    {

        if(isset($_GET['id']))
        {
            $id=intval($_GET['id']);
            $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
            $sel='SELECT * FROM produit WHERE id=?';
            $req=$db->prepare($sel);
            $req->execute([$id]);
            $datas=$req->fetchAll();
            echo json_encode($datas);
        }

        
    }

    if(isset($_GET['action']) && $_GET['action']=='search')
    {
        $q=secure($_POST['q']); 
        $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
        $sel="SELECT * FROM produit WHERE lib_produit LIKE \"%\"?\"%\"";
        $req=$db->prepare($sel);
        $req->execute([$q]);
        $datas=$req->fetchAll();
        echo json_encode($datas);

    }


    function secure($data)
    {
        $data=strip_tags($data);
        $data=trim($data);
        $data=stripslashes($data);
        return $data;
    }

?>