<div id="content-box" class="content-box clearfix" style="display: block;">
    <h2>Add Connections</h2>
    <!-- <?php var_dump($suggestions);?> -->

    <div class="row ">
        <h4>Suggested Connections</h4>
        
        <ul class="example-orbit-content panel" data-orbit>
            <li class="medium-centered">
        <?php
             $count=0;
             foreach($suggestions as $row => $value) { 
                if($count==6){
                    echo "</li> <li>";
                    $count=0;
                    }
                $count++;

                $link = $value[0]->student_no;
                $image = $value[0]->imagepath;
                $lastname = $value[0]->lastname;
                $firstname = $value[0]->firstname;
        ?>
            <div class="yearbook-year medium-2 columns end">
                <a class="th" role="button" aria-label="Thumbnail" href="<?php echo base_url("/index.php/c_user/add?stno2=$link"); ?>">
                <img aria-hidden=true src="<?php echo $image;?>"/>
                </a>
                <?php echo $lastname.", ".$firstname;?>
            </div>
        <?php }?>

        </ul>
    </div>

        <div id="connection_searchbar" class="medium-6 medium-centered columns">
            <label> Search <label>
            <form method='post' action='<?php echo base_url('/index.php/c_user/add_connection_search')?>'>
                <input type="text" id="add_connection_search" name="add_connection_search"/>
            </form>
        </div>
        <div class="medium-12 columns panel" id="add_connection_result">
            <?php 
                if(isset($results)){
                    if (!empty($results)){
                        foreach ($results as $key => $value) { ?>
                            
                            <div class="yearbook-year medium-2 columns end">
                                <a class="th" role="button" aria-label="Thumbnail" href="<?php echo base_url("/index.php/c_user/add?stno2=$value->student_no"); ?>">
                                <img aria-hidden=true src="<?php echo $value->imagepath; ?>"/>
                                </a>
                                <?php echo $value->lastname.", ".$value->firstname."<br>";?>
                            </div>



                        <?php }
                    }
                    else echo "No results found";
                }
            ?>
        </div>




    <!-- <div class="row panel">
        <h4>Connections</h4>
        <table id="sugcon">
            <thead>
                <th>St. No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Field</th>
            </thead>
            <?php foreach($suggestions as $row) { ?>
            <tr>
                <td><?php echo $row['student_no']?> </td>
                <td><?php echo $row['firstname']?> </td>
                <td><?php echo $row['lastname']?> </td>
            </tr>
            <?php }?>
        </table>
    </div> -->

<!--
    <form method="post" id="formself" class="filtered">
        <div id="wizard" class="wizard clearfix vertical" role="application">
            <div class="steps clearfix">
                <ul role="tablist">
                    <li aria-selected="true" aria-disabled="false" class="first current" role="tab"><a class="httponly" id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="current-info audible">current step: </span><span class="number">1.</span> Personal Information</a></li>
                    <li aria-disabled="true" class="disabled" role="tab"><a class="httponly" id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">2.</span> Contact Information</a></li>
                    <li aria-disabled="true" class="disabled" role="tab"><a class="httponly" id="wizard-t-2" href="#wizard-h-2" aria-controls="wizard-p-2"><span class="number">3.</span> Family Information</a></li>
                </ul>
            </div>
            <div class="content clearfix">
                <h3 class="title current" tabindex="-1" id="wizard-h-0">Personal Information</h3>
                <div aria-hidden="false" class="body current" aria-labelledby="wizard-h-0" role="tabpanel" id="wizard-p-0"> <div class="row"> <div class="large-3 columns"> <label>Last Updated</label> <input readonly="" disabled="" value="Feb 11, 7:51 pm" type="text"> </div> <div class="large-6 columns"> <label>Full Name <span class="tip tooltipstered">[?]</span></label> <input readonly="" disabled="" value="DIABORDO, LEO ANGELO C." type="text"> </div> <div class="large-3 columns"> <label>Nickname*</label> <input name="nickname" required="" class="tip filtered tooltipstered" value="Leo" type="text"> </div> </div> <div class="row"> <div class="large-3 columns"> <label>Student No. <span class="tip tooltipstered">[?]</span></label> <input readonly="" disabled="" value="2011-69306" type="text"> </div> <div class="large-3 columns"> <label>Biological Sex <span class="tip tooltipstered">[?]</span></label> <select name="sex" disabled="" readonly=""> <option>-- sex --</option> <option selected="" value="M">Male</option><option value="F">Female</option> </select> </div> <div class="large-3 columns"> <label>College <span class="tip tooltipstered">[?]</span></label> <input readonly="" disabled="" value="CAS" type="text"> </div> <div class="large-3 columns"> <label>Course <span class="tip tooltipstered">[?]</span></label> <input readonly="" disabled="" value="BSCS" type="text"> </div> </div> <div class="row"> <div class="large-3 columns"> <label>Marital Status*</label> <select class="filtered" name="marital_status" required=""> <option value="" disabled="" selected="">-- select status --</option> <option selected="" value="S">Single</option><option value="M">Married</option><option value="D">Divorced/Separated</option><option value="W">Widowed</option> </select> </div> <div class="large-3 columns"> <label>Birthdate <span class="tip tooltipstered">[?]</span></label> <input name="birthdate" readonly="" disabled="" value="20 APR 1995" type="text"> </div> <div class="large-3 columns"> <label>Birthplace*</label> <input class="filtered" name="birthplace" required="" value="Cagayan de Oro City" type="text"> </div> <div class="large-3 columns"> <label>Religion*</label> <input class="filtered" name="religion" required="" value="Roman Catholic" type="text"> </div> </div> <div class="row"> <div class="large-3 columns"> <label>Nationality*</label> <input class="filtered" name="nationality" required="" value="Filipino" type="text"> </div> <div class="large-9 columns"> <label>Talents, Skills, and Abilities*</label> <input class="filtered" name="talents" required="" value="n/a" type="text"> </div> </div> <div class="row"> <div class="large-3 columns"> <label>Blood Type*</label> <select class="filtered" name="bloodtype" required=""> <option value="">-- blood type --</option> <option value="A">A</option><option value="B">B</option><option value="AB">AB</option><option selected="" value="O">O</option><option value="UN">unknown</option> </select> </div> <div class="large-9 columns"> <label>Scholarships</label> <input name="scholarships" value="n/a" type="text"> </div> </div> </div>
                <h3 class="title" tabindex="-1" id="wizard-h-1">Contact Information</h3>
                <div aria-hidden="true" style="display: none;" class="body" aria-labelledby="wizard-h-1" role="tabpanel" id="wizard-p-1"> <div class="row"> <div class="large-12 column"> <label>College Address*</label> <input name="address_college" required="" class="tip filtered tooltipstered" value="Room 204, Bella Cartash Apartel, UPLB" type="text"> </div> </div> <div class="row"> <div class="large-8 column"> <label>Permanent Address*</label> <input name="address_permanent" required="" class="tip filtered tooltipstered" value="Amparo Village, EL Salvador CIty, Misamis Oriental" type="text"> </div> <div class="large-4 column"> <label>Region*</label> <select class="filtered" name="region" required=""> <option value="" disabled="" selected="">-- select region --</option> <option value="NCR">NCR - National Capital Region</option><option value="CAR">CAR - Cordillera Administrative Region</option><option value="Region I">Region I - Ilocos Region</option><option value="Region II">Region II - Cagayan Valley</option><option value="Region III">Region III - Central Luzon</option><option value="Region IVA">Region IVA - CALABARZON</option><option value="Region IVB">Region IVB - MIMAROPA</option><option value="Region V">Region V - Bicol Region</option><option value="Region VI">Region VI - Western Visayas</option><option value="Region VII">Region VII - Central Visayas</option><option value="Region VIII">Region VIII - Eastern Visayas</option><option value="Region IX">Region IX - Zamboanga Peninsula</option><option selected="" value="Region X">Region X - Northern Mindanao</option><option value="Region XI">Region XI - Davao Region</option><option value="Region XII">Region XII - SOCCKSARGEN</option><option value="Region XIII">Region XIII - Caraga</option><option value="ARMM">ARMM - Autonomous Region in Muslim Mindanao</option> </select> </div> </div> <div class="row"> <div class="large-4 column"> <label>Landline No.</label> <input name="landline" placeholder="e.g. (049) 536-7132" value="" type="text"> </div> <div class="large-4 column"> <label>Primary Mobile No.*</label> <input name="mobile_no" required="" placeholder="09xxxxxxxxx" class="tip filtered tooltipstered" value="09355872344" type="text"> </div> <div class="large-4 column"> <label>Mobile Device <span class="tip tooltipstered">[?]</span></label> <select name="mobile_device"> <option value="" disabled="" selected="">-- select device --</option> <option>Android OS</option><option>Blackberry</option><option>iPhone</option><option>Windows Phone</option><option selected="">Other</option> </select> </div> </div> <div class="row"> <div class="large-4 column"> <label>Email*</label> <input name="email" required="" class="tip filtered tooltipstered" value="leodiabordo@gmail.com" type="email"> </div> <div class="large-4 column"> <label>Facebook Username or ID <span class="tip tooltipstered">[?]</span></label> <input name="facebook" value="1838517821" placeholder="e.g. uplbosa" type="text"> </div> <div class="large-4 column"> <label>Twitter Username</label> <input name="twitter" value="" type="text"> </div> </div> <div class="row"> <div class="large-6 column"> <label>Contact Person*</label> <input class="filtered" name="contact" required="" value="Samuel Diabordo" type="text"> </div> <div class="large-6 column"> <label>Contact Number of Contact Person*</label> <input class="filtered" name="contact_no" required="" placeholder="enter mobile # or landline # with area code" value="09056933485" type="text"> </div> </div> </div>
                <h3 class="title" tabindex="-1" id="wizard-h-2">Family Information</h3>
                <div aria-hidden="true" style="display: none;" class="body" aria-labelledby="wizard-h-2" role="tabpanel" id="wizard-p-2"> <div class="row"> <div class="large-6 column"> <label>Mother's Name*</label> <input class="filtered" name="mother_name" required="" value="Anecita C. Diabordo" type="text"> </div> <div class="large-6 column"> <label>Mother's Work*</label> <input class="filtered" name="mother_work" required="" value="n/a" type="text"> </div> </div> <div class="row"> <div class="large-6 column"> <label>Mother's Education*</label> <select class="filtered" name="mother_educ" required=""> <option value="" disabled="" selected="">-- select --</option> <option>Elementary</option><option>High School</option><option>Vocational/Technical</option><option selected="">College</option><option>Masteral</option><option>Doctoral</option><option>None</option> </select> </div> <div class="large-6 column"> <label>Mother's Birthdate*</label> <input placeholder="e.g. 02/14/2002" class="filtered" name="mother_bday" required="" value="1965-07-12" type="date"> </div> </div> <div class="row"> <div class="large-6 column"> <label>Father's Name*</label> <input class="filtered" name="father_name" required="" value="Samuel S. Diabordo" type="text"> </div> <div class="large-6 column"> <label>Father's Work*</label> <input class="filtered" name="father_work" required="" value="Employee" type="text"> </div> </div> <div class="row"> <div class="large-6 column"> <label>Father's Education*</label> <select class="filtered" name="father_educ" required=""> <option value="" disabled="" selected="">-- select --</option> <option>Elementary</option><option>High School</option><option>Vocational/Technical</option><option selected="">College</option><option>Masteral</option><option>Doctoral</option><option>None</option> </select> </div> <div class="large-6 column"> <label>Father's Birthdate*</label> <input placeholder="e.g. 02/14/2002" class="filtered" name="father_bday" required="" value="1962-11-15" type="date"> </div> </div> <div class="row"> <div class="large-3 column"> <label>Number of Siblings*</label> <input class="filtered" name="siblings" required="" min="0" value="1" type="number"> </div> </div> </div>
            </div>
            <div class="actions clearfix">
                <ul role="menu" aria-label="Pagination">
                    <li aria-disabled="true" class="disabled">
                        <a class="httponly" href="#previous" role="menuitem">Previous</a>
                    </li>
                    <li aria-disabled="false" aria-hidden="false">
                        <a class="httponly" href="#next" role="menuitem">Next</a>
                    </li>
                    <li aria-hidden="true" style="display: none;">
                        <a class="httponly" href="#finish" role="menuitem">Finish</a>
                    </li></ul></div>
        </div>
    </form> 
-->
    
    
</div>