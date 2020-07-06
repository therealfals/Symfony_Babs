/*$.ajax({
    method:'POST',
          url:"listEtudiantsRkk",
          data:{search:34},
          dataType:"JSON",
          success:function(data){
              console.log(data);
              
          }

})
*/

const date = $('#date').val();
let offset = 0;
const tbody = $('#tbody');
$.ajax({
    method:'POST',
    url:"/listEtudiantsRkk",
        data: {limit:7,offset:offset},
        dataType: "JSON",
        success: function (data) {
            // tbody.html('')
            // printData(data,tbody);
            console.log(data)
            for (let i = 0; i < data.length; i++) {
               // console.log(data[i]);

                var tr=document.createElement('tr')
                var td1=document.createElement('td')
                td1.innerText=data[i].matricule
                var td2=document.createElement('td')
                td2.innerText=data[i].prenom
            
                var td3=document.createElement('td')
                td3.innerText=data[i].nom

                var td4=document.createElement('td')
                td4.innerText=data[i].email
                var tdf4=document.createElement('td')
                tdf4.innerText=data[i].telephone
                var type=document.createElement('td')
                type.innerText=data[i].type
                var td5=document.createElement('td')
                var td6=document.createElement('td')

                if(data[i].adresse){
                    td5.innerText=data[i].adresse
                }else{
                    td5.innerText="Neant"

                }
                if(data[i].numChambre){
                    td6.innerText=data[i].numChambre
                }else{
                    td6.innerText="Neant"

                }

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
                tr.append(td4)
                tr.append(tdf4)
                tr.append(type)

                
                 
                tr.append(td5)
                tr.append(td6)
                tr.append(td7)  
                 tr.append(td8)
                $('#table').append(tr)
            
            
            
            
                
            }
            offset +=7
        }
    });

    //  Scroll
const scrollZone = $('#scrollZone')
scrollZone.scroll(function(){

const st = scrollZone[0].scrollTop;
const sh = scrollZone[0].scrollHeight;
const ch = scrollZone[0].clientHeight;

console.log(st,sh, ch);

if(sh-st <= ch){
    $.ajax({
        type: "POST",
        url:"/listEtudiantsRkk",
        data: {limit:7,offset:offset},
        dataType: "JSON",
        success: function (data) {
            
            for (let i = 0; i < data.length; i++) {
                console.log(data[i]);

                var tr=document.createElement('tr')
                var td1=document.createElement('td')
                td1.innerText=data[i].matricule
                var td2=document.createElement('td')
                td2.innerText=data[i].prenom
            
                var td3=document.createElement('td')
                td3.innerText=data[i].nom

                var td4=document.createElement('td')
                td4.innerText=data[i].email
                var tdf4=document.createElement('td')
                tdf4.innerText=data[i].telephone
                var type=document.createElement('td')
                type.innerText=data[i].type
                 
                var td5=document.createElement('td')
                var td6=document.createElement('td')

                if(data[i].adresse){
                    td5.innerText=data[i].adresse
                }else{
                    td5.innerText="Neant"

                }
                if(data[i].numChambre){
                    td6.innerText=data[i].numChambre
                }else{
                    td6.innerText="Neant"

                }

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
                tr.append(td4)
                tr.append(tdf4)
                
                tr.append(type)

                tr.append(td5)
                tr.append(td6)
                tr.append(td7)  
                 tr.append(td8)
                $('#table').append(tr)
            
            
            
            
                
            }
            offset +=7
        }
    });
}
   
})
function supprimer(e){
    var id=e.getAttribute('id')
    var f=confirm('Voulez vous vraiment supprimer?')
    if(f){
        alert('ok')
       $.ajax({
        method:'POST',
        url:"/deleteEtudiant",
        data:{id:id},
        dataType:'JSON',
        success:function(data){
alert(data)
        }  
       })
    }else{
        // alert('yt')
    }
}

function modifier(e){
    console.log(e)
    var p=e.getAttribute('id')
     alert(p)
    $.ajax({
        method:'POST',
       url:"/modifierEtudiant",
       data:{id:p},
       dataType:'JSON',
       success:function(data){
           console.log(data)

           $('#id').attr('value',data.id)

           $('#matricule').attr('value',data.matricule)
           $('#prenom').attr('value',data.prenom)
           $('#nom').attr('value',data.nom)
           $('#email').attr('value',data.email)
           $('#telephone').attr('value',data.telephone)

           if(data.adresse){
            $('#adresse').attr('value',data.adresse)

           }else{
            $('#adresse').attr('value',"Neant")

           }
           if(data.logement){
            $('#logement').attr('value',data.logement)

           }else{
            $('#logement').attr('value',"Neant")

           }


       }
    })
}
$('#updateEtudiant').submit(function(e) {
    e.preventDefault()
    $.ajax({
        method:'POST',
        url:'/updateEtudiant',
        data:$(this).serialize(),
        success:function (data) {
            console.log(data)
        }
    })
    
})














$('#search').submit(function(e){
e.preventDefault()
$.ajax({
    method:'POST',
    url:'/searching',
    data:$(this).serialize(),
    dataType:'JSON',
    success:function(data){
        $('#serse').html('')
        console.log(data)
        if(data){

            $('#serse').append("<thead><tr><th scope='col'>Matricule</th> <th scope='col'>Prenom</th><th scope='col'>Nom</th><th scope='col'>Email</th><th scope='col'>telephone</th><th scope='col'>Adresse</th><th scope='col'>Logement</th><th scope='col'> Type</th>     </thead>")

        }else{
            $('#serse').append("<h3 class='text-center'>Aucun Resultat</h3>")
        }
      //  for (let i = 0; i < data.length; i++) {
           var tr=document.createElement('tr')
           var tds=document.createElement('td')
           tds.innerText=data.matricule
           var td=document.createElement('td')
           td.innerText=data.prenom
           var td1=document.createElement('td')
           td1.innerText=data.nom
           var td2=document.createElement('td')
           td2.innerText=data.email
           var td3=document.createElement('td')
           td3.innerText=data.telephone
           var td4=document.createElement('td')
           td4.innerText=data.adresse
           var td5=document.createElement('td')
           td5.innerText=data.type
           var td6=document.createElement('td')
        if(data.numChambre){
            td6.innerText=data.numChambre
        }else{
            td6.innerText='Neant'
        }

           tr.append(tds)
            tr.append(td)
         
            tr.append(td1)
            tr.append(td2)
            tr.append(td3)
            tr.append(td4)
      
            tr.append(td6)
            tr.append(td5)
            $('#serse').append(tr)

      
    }

})
})
