


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

