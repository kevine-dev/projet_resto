let btn=document.querySelector('button')
btn.addEventListener('click',()=>{

    body=document.body;
    let tmp='';
    let imp=document.querySelector('.imp')
        tmp=body.innerHTML
        body.innerHTML=imp.innerHTML;
        print();
        body.innerHTML=tmp
   
})