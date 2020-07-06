var p=0
liste()
function liste(){
    $.ajax({
        method:'POST',
        url:'/listChambres',
        data:{id:4},
        dataType:'JSON',
        success:function(data) {
            max=p+2
            min=max-2
            for (let i = min; i < max; i++) {
                var tr=document.createElement('tr')
                var td1=document.createElement('td')
                td1.innerText=data[i].numero
                var td2=document.createElement('td')
                td2.innerText=data[i].numBatiment
            
                var td3=document.createElement('td')
                td3.innerText=data[i].type

                var td4=document.createElement('td')
                var td7=document.createElement('td')
                var mod=document.createElement('button')
                mod.setAttribute('id',data[i].id)
                mod.setAttribute('class','btn btn-success')
                mod.setAttribute('onClick','modifier(this)')
                mod.setAttribute('data-toggle','modal')
                mod.setAttribute('data-target','#staticBackdrop')
                mod.innerText='Modifier'

                td7.append(mod)
                var td8=document.createElement('td')
                var sup=document.createElement('button')
                sup.setAttribute('id',data[i].id)
                sup.setAttribute('class','btn btn-danger')
                sup.setAttribute('onClick','supprimer(this)')

                sup.innerText='Supprimer'
                td8.append(sup) 
              
                tr.append(td1)
                tr.append(td2)
                tr.append(td3)
              

                tr.append(td7)  
                 tr.append(td8)
                $('#table').append(tr)         
            }
            console.log(data);
            
        }
    
    })
    
    
    
    
    
    
    
}









function supprimer(e) {
    var f=e.getAttribute('id')
    var cf=confirm('Voulez vous vraiment supprimer?')
    if(cf){
        $.ajax({
            method:'POST',
            url:'/deleteRooms',
            data:{id:f},
            success:function(data){
                console.log(data)
            }
        })

    }
    
}

function modifier(e) {
    var f=e.getAttribute('id')
     $.ajax({
        method:'POST',
        url:'/modifChambre',
        data:{id:f},
        dataType:'JSON',
        success:function(data){
            // alert(data.numero)

            $('#id').attr('value',data.id)

            $('#numChambre').attr('value',data.numero)
            $('#numBatiment').attr('value',data.numBatiment)
            $('#type').attr('value',data.type)

        }
    })
    
}

$('#myModif').submit(function(e) {
    e.preventDefault()
    $.ajax({
        method:'POST',
        url:'/updateRooms',
        data:$(this).serialize(),
        success:function (data) {
            console.log(data);
            
            
        }
    })
})

function suivant(){
    $('#table').html('')            
    p+=2

    liste()

}
function precedent(){
    $('#table').html('')         
    p-=2
    

    liste()
    
}