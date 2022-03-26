<?php


    if(isset($_GET['q']))
    {

        $q=$_GET['q']; 
        if(!empty($q))
        {
            $db=new PDO("mysql:host=localhost;dbname=delice",'root','');
            $sel="SELECT * FROM produit WHERE lib_produit LIKE \"%\"?\"%\"";;
            $req=$db->prepare($sel);
            $req->execute([$q]);
            $datas=$req->fetchAll();
           
        }

        else
        {
             header('location:index.php');
        }
    
    }



?>

<?php require("../include/header.html")?>

    <div class="container">
         <div class="row">
             

               <div class="items">
                    <?php if(!empty($datas)):?>
                        <?php foreach($datas as $data) :?>
                            
                        
                            
                            <div class="card item">
                                    <img src="../admin/upload/<?= $data['lien']?>" alt="" srcset="">
                                    <p><?= $data['lib_produit']?></p>
                                    
                                    <div class="prix">
                                        <span><?= $data['prix']?> </span>
                                        <span>Fcfa</span>
                                    </div>
                                    <p><a href="../panier/add.php?action=add&amp;id=<?= $data['id']?> " class='add'><button class="btn btn-danger ajout" id=${el}>commandez</button></a></p>
                               </div>
                                
    
                          <?php endforeach ?>
                    <?php endif?>
                    <?php if(empty($datas)):?>
                        <div class="noresult">
                             <h1>Aucun results pour <span style='color:crimson'><?php echo $q ?></span></h1>
                        </div>
                    <?php endif?>
               </div>

              
         </div>
    </div><br/>

<a href="../panier/panier.php">
    <div class="panier">
            <span class='nb'></span>
            <i class='fa fa-shopping-cart'></i>
    </div> <br/><br/>
</a>

    <script>

                     
let lien_add=document.querySelectorAll('.add');
      
      lien_add.forEach((lien)=>{

           
             lien.addEventListener('click',async(e)=>{
                 e.preventDefault();
                 let req=await fetch(lien.getAttribute('href')); 
                 if(req.ok)
                 {
                     count()

                 }
             
                 
             })
      })

      async function  count()
      {
            let res=await fetch('../panier/add.php?action=list');
            let data=await res.json();
            let span=document.querySelector('.nb')
            span.innerHTML=data
     }

     count();

     let btn_list=document.querySelector('header .list');
     let ul_list=document.querySelector('ul');

    btn_list.addEventListener('click',()=>{
        
        if(ul_list.classList.contains('show_nav'))
        {
            ul_list.classList.remove('show_nav')
            ul_list.classList.add('hide_nav')
        }

        else
        {
            ul_list.classList.remove('hide_nav')
            ul_list.classList.add('show_nav')
        }
    })



    </script>





<?php require("../include/footer.html")?>

</body>
</html>
