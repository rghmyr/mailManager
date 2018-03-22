$(".table").on("click",".domain-select",function(){
  var domain = $(this).data("domain");
  console.log(domain);
});

// Domains
if($("#domain-list-content").length > 0) {
  $('#domain-list-content').load("./domain-get-list.php");
}
$("#domain-list").on("click", ".domain-delete", function(e){
  e.preventDefault();
  var domain = $(this).data("domain");
  var domainid = $(this).data("domainid");
  if(confirm("Soll "+domain+" wirklich gelöscht werden?")){
    $.ajax({
      method: "POST",
      url: "domain-delete.php",
      data: { id: domainid, domain: domain }
    }) .done(function(msg) {
      if(msg.length==0) {
        $('#domain-list-content').load("./domain-get-list.php");
      } else {
        alert("Es ist ein Fehler aufgetreten."+msg);
      }
    });
  }
});

// Accounts
if($("#account-list-content").length > 0) {
  $('#account-list-content').load("./account-get-list.php");
}
$("form").on("change","#domain",function(){
  var domain = $(this).val();
  $('#account-list .grd-row').removeClass("active");
  $('#account-list .grd-row').each(function(){
    if($(this).data("domain") == domain)
      $(this).addClass("active");
  });
});

$("#account-list").on("click", ".account-delete", function(e){
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
        $('#account-list-content').load("./account-get-list.php");
      } else {
        alert("Es ist ein Fehler aufgetreten."+msg);
      }
    });
  }
});

// Umleitungen
if($("#alias-list-content").length > 0) {
  $('#alias-list-content').load("./alias-get-list.php");
}
$("form").on("change","#domain",function(){
  var domain = $(this).val();
  $('#alias-list .grd-row').removeClass("active");
  $('#alias-list .grd-row').each(function(){
    if($(this).data("domain") == domain)
      $(this).addClass("active").find(".grd-row").addClass("active");
  });
});

$("#alias-list").on("click", ".alias-delete", function(e){
  e.preventDefault();
  var domain = $(this).data("domain");
  var username = $(this).data("user");
  var userid = $(this).data("userid");
  if(confirm("Soll "+username+"@"+domain+" wirklich gelöscht werden?")){
    $.ajax({
      method: "POST",
      url: "alias-delete.php",
      data: { username: username, id: userid, domain: domain }
    }) .done(function(msg) {
      if(msg.length==0) {
        $('#alias-list-content').load("./alias-get-list.php");
      } else {
        alert("Es ist ein Fehler aufgetreten."+msg);
      }
    });
  }
});
