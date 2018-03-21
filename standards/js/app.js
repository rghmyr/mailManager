$(".table").on("click",".domain-select",function(){
  var domain = $(this).data("domain");
  console.log(domain);
});

$("form").on("change","#domain",function(){
  var domain = $(this).val();
  $('#account-list .grd-row').removeClass("active");
  $('#account-list .grd-row').each(function(){
    if($(this).data("domain") == domain)
      $(this).addClass("active");
  });
});

$(".account-edit").on("click", function(e){
  e.preventDefault();
});
$(".account-delete").on("click", function(e){
  e.preventDefault();
  var domain = $(this).data("domain");
  var username = $(this).data("user");
  var userid = $(this).data("userid");
  if(confirm("Soll "+username+"@"+domain+" wirklich gelöscht werden?")){
    $.ajax({
      method: "POST",
      url: "account-delete.php",
      data: { username: username, id: userid, domain: domain }
    }) .done(function(msg) {
      if(msg.length==0) {
        $('#account-list-content').load("./standards/include/account-list.php");
      } else {
        alert("Es ist ein Fehler aufgetreten.");
      }
    });
  }
});
