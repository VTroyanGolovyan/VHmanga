function changeMenu(){
  var menu = document.getElementById('myMenu');
  if (menu.style.left == "0%"){
    menu.style.left = "-100%";
  }else{
    menu.style.left = "0%";
  }
}
function closeX(id){
  if (id == 'toggle'){
    if (document.getElementById('toggleSearch').checked)
       document.getElementById('toggleSearch').checked = false;
  }else{
    if (document.getElementById('toggle').checked)
       document.getElementById('toggle').checked = false;
  }
}
