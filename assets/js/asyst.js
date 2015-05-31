  

// $(function(){
//   $("#exp-company-name").autocomplete({
//     source: "../c_user/get_companies_name",
//     minLength: 3,
//   });
// });

// $(function(){
//   $("#exp-company-loc").autocomplete({
//     source: "../c_user/get_companies_loc",
//     minLength: 3,
//   });
// });

// $(function(){
//   $("#educ-school-name").autocomplete({
//     source: "../c_user/get_school_name",
//     minLength: 3,
//   });
// });

// $(function(){
//   $("#educ-school-add").autocomplete({
//     source: "../c_user/get_school_add",
//     minLength: 3,
//   });
// });

$( "#view-list" ).change(function() {
  
  if(this.value==1){
    $("#college-list").prop('disabled', false);
    $("#degree-list").prop('disabled', true);
  }
  else if(this.value==2){
    $("#college-list").prop('disabled', true);
    $("#degree-list").prop('disabled', false);
  }
  else{
    $("#college-list").prop('disabled', true);
    $("#degree-list").prop('disabled', true);
  }

});

$("#degree-list").change(function(){
  $(".graduate").hide();
  var $id = "[id='"+this.value+"']";
  $($id).fadeIn();
});


function enableTertiary(value){
  if (value!="Tertiary")
    document.getElementById('educ-course').disabled = true;
  else
    document.getElementById('educ-course').disabled = false;
}

function enableViewList(value){
  if (value=="-1"){
    $("#view-list").prop('disabled', true);
    $("#view-list").prop('selectedIndex', 0);
    $("#college-list").prop('disabled', true);
    $("#college-list").prop('selectedIndex', 0);
    $("#degree-list").prop('disabled', true);
    $("#degree-list").prop('selectedIndex', 0);

  }
  else{
    document.getElementById('view-list').disabled = false;
  }
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

function loadStudents(classOf){
  var dataString = 'classOf='+ classOf;
  // $("#"+loadType+"_loader").show();
  // $("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="image/loading.gif" />');
  $.ajax({
    type: "POST",
    url: "loadStudents",
    data: dataString,
    cache: false,
    success: function(result){
      // $("#"+loadType+"_loader").hide();
      $("#Students").empty();
      $("#Students").append(result);
    }
 });
};

$(document).foundation({
  orbit: {
    animation: 'slide',
    slide_number: false,
    circular: false,
    bullets: false,
    timer: false,
    next_on_click: false
  }
});