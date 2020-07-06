$('#room').submit(function(e){
if($('#type').val()==''){
    e.preventDefault()
$('#errType').text('Champ type vide')
}else{
    $('#errType').text('')
 
}


if($('#numBatiment').val()==''){
    e.preventDefault()
$('#errnumBatiment').text('Champ numero batiment vide')
}else{
    $('#errnumBatiment').text('')
 
}
})