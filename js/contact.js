let search_btn=document.querySelector('.search_btn');
let search=document.querySelector('.search');
search_btn.addEventListener('click',()=>{search.classList.toggle('show')})


let inputs=document.querySelectorAll('.formulaire input');

let form=document.querySelector('.formulaire form')

let print=document.querySelector('.print')
let err= document.querySelector('.err');
let lien_imp= document.querySelector('.recu');
form.addEventListener('submit',async (e)=>{

    e.preventDefault();
    err.style.color=''
    lien_imp.style.opacity=0;
    err.innerHTML=`
    <div class="spinner-border" role="status">
       <span class="visually-hidden">Loading...</span>
    </div>
 `
    let res=await fetch('list.php',{
        method:'POST',
        body:new FormData(form)
    })

    if(res.ok)
    {
        
        let data=await res.json();
        if(data.err==true)
        {
            err.style.color='red'
            err.innerHTML=data.msg
        }
        else
        {
            err.style.color='green'
            err.innerHTML=data.msg;
            lien_imp.style.opacity=1;
            lien_imp.href='recu.php'
        }
    }
 
})


let btn_list=document.querySelector('header .list');
let ul_list=document.querySelector('ul');
console.log(ul_list)
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