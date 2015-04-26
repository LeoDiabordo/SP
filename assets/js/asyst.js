$(function(){
  $("#exp-company-name").autocomplete({
    source: "../c_user/get_companies_name",
    minLength: 3,
  });
});

$(function(){
  $("#exp-company-loc").autocomplete({
    source: "../c_user/get_companies_loc",
    minLength: 3,
  });
});