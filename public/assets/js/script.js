$('#select').hide()
$('#radio').hide()
$('#input').hide()

$('#form_type').focusout(function(){
    if($('#form_type').val()=='0'){
        $('#select').hide()
        $('#input').hide()
    }
    if($('#form_type').val()=='1'){
        $('#select').hide()
        $('#input').show()

        $('#radio').hide();
    }
    if($('#form_type').val()=='2'|| $('#form_type').val()=='3'){
        $('#radio').show();
        $('#input').hide()

    }
})
function teste(e){
    var p= e.getAttribute('value')
    if(p=='oui'){
        $('#select').show()
        $('#input').hide()

    }else {
        $('#input').show()

        $('#select').hide()

    }

}
/*
$('#form_type').focusout(function(){

    if($('#form_type').val()=='1'){

        $('#div').html('');
        $('#dive').html('');
        var input=document.createElement('input')
        input.setAttribute('type','text')
        input.setAttribute('name','adresse')
        input.setAttribute('id','adresse')

        input.setAttribute('class','form-control border border-primary bg bg-dark text-white rounded rounded-pill')
        $('#div').append(input)
    }
    if($('#form_type').val()=='2' || $('#form_type').val()=='3'){

        $('#div').html('');
        $('#dive').html('');
        var input=document.createElement('input')
        input.setAttribute('type','text')
        input.setAttribute('name','adresse')
        input.setAttribute('class','form-control float-left border border-primary bg bg-dark text-white rounded rounded-pill')
        var radio=document.createElement('input')
        radio.setAttribute('type','radio')
        radio.setAttribute('name','loge')
        radio.setAttribute('value','no')

        radio.setAttribute('class','fot ')
        radio.setAttribute('onChange','teste(this)')

        radio.setAttribute('id','loge ')
        var checkbox=document.createElement('input')
        checkbox.setAttribute('type','radio')
        checkbox.setAttribute('name','loge')
        checkbox.setAttribute('value','yes')
        var span=document.createElement('span')
        span.innerText='Logé'
        var span1=document.createElement('span')
        span1.innerText='Non logé'

        checkbox.setAttribute('class','float- ')
        checkbox.setAttribute('onChange','teste(this)')

        checkbox.setAttribute('id','loge ')
        span.append(checkbox)
        span1.append(radio)

     //   $('#div').append(input)

        // $('#div').append(checkbox)
        $('#div').append(span)
        $('#div').append('&nbsp;&nbsp;&nbsp;')
        $('#div').append(span1)

        // $('#div').append(radio)

    }
 

})
function teste(e){
   var p= e.getAttribute('value')
   if(p=='yes'){
    $('#dive').html('');
var y=4;
    $.ajax({
        method:"POST",
        url:"/addEtudiant",
        data:{search:y},
        dataType:'JSON',
        success:function(data){
            console.log(data);
            var select=document.createElement('select')
            select.setAttribute('name','list')
            select.setAttribute('class','form-control bg bg-dark rounded rounded-pill border border-primary text-white')

            for (let i = 0; i < data[0].length; i++) {
               var option=document.createElement('option')
               option.setAttribute('value',data[0][i].id)
               option.innerText=data[0][i].type
                select.append(option)
                
            }
            for (let i = 0; i < data[1].length; i++) {
                var option=document.createElement('option')
                option.setAttribute('value',data[1][i].id)
                option.innerText=data[1][i].type
                 select.append(option)
                 
             }
            $('#dive').append(select)
        }
    })

   }
   if(p=='no'){
    $('#dive').html('');
    var input=document.createElement('input')
    input.setAttribute('type','text')
    input.setAttribute('name','adresse')
    input.setAttribute('class','form-control border border-primary bg bg-dark text-white rounded rounded-pill')
    $('#dive').append(input)
   }
}


$('#myForm').submit(function(e){
    if($('#prenom').val()==''){
        $('#errPrenom').text('Remplir prenom')
        e.preventDefault()
    }else{
        $('#errPrenom').text('')

    }
    if($('#date').val()==''){
        $('#errDate').text('Remplir date')
        e.preventDefault()
    }else{
        $('#errDate').text('')

    }
    if($('#bourse').val()==''){
        $('#errBourse').text('Remplir bourse')
        e.preventDefault()
    }else{
        $('#errBourse').text('')

    }
    if($('#nom').val()==''){
        $('#errNom').text('Nom invalide')

        e.preventDefault()
    }else{
        $('#errNom').text('')

    }
    if($('#email').val()==''){
        $('#errEmail').text('Remplir email')

        e.preventDefault()
    }else{
        $('#errEmail').text('')

    }
    if($('#telephone').val()==''){
        $('#errTelephone').text('Remplir telephone')

        e.preventDefault()
    }else{
        $('#errTelephone').text('')

    }
    
})
*/
