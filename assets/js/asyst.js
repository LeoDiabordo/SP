  

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

$(function(){
  $("#educ-school-name").autocomplete({
    source: "../c_user/get_school_name",
    minLength: 3,
  });
});

$(function(){
  $("#educ-school-add").autocomplete({
    source: "../c_user/get_school_add",
    minLength: 3,
  });
});

function enableTertiary(value){
  if (value!="Tertiary")
    document.getElementById('educ-course').disabled = true;
  else
    document.getElementById('educ-course').disabled = false;
}


function selectEducState(country_id){
  if(country_id!="-1"){
    loadData('educ_state',country_id);
    $("#city_dropdown").html("<option value='-1'>Select city</option>");
  }else{
    $("#state_dropdown").html("<option value='-1'>Select state</option>");
    $("#city_dropdown").html("<option value='-1'>Select city</option>");
  }
};


//Address Dropdown Autofill
function selectState(country_id){
  if(country_id!="-1"){
    loadData('state',country_id);
    $("#city_dropdown").html("<option value='-1'>Select city</option>");
  }else{
    $("#state_dropdown").html("<option value='-1'>Select state</option>");
    $("#city_dropdown").html("<option value='-1'>Select city</option>");
  }
};



function loadData(loadType,loadId){
  var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
  // $("#"+loadType+"_loader").show();
  // $("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="image/loading.gif" />');
  $.ajax({
    type: "POST",
    url: "loadData",
    data: dataString,
    cache: false,
    success: function(result){
      // $("#"+loadType+"_loader").hide();
      $("#"+loadType+"_dropdown").html("<option value='-1'>Select </option>");
      $("#"+loadType+"_dropdown").append(result);
    }
 });
};
