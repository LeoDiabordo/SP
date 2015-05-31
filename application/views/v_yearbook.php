<div id="content-box" class="content-box clearfix" style="display: block;">
    <h2>UPLB Graduates</h2>
        <div class="row panel" id="yearbook">
            <?php foreach($yearlist->result() as $row) { ?>
            <!-- <div class="yearbook-year medium-2 end columns">
                <a class="th" role="button" aria-label="Thumbnail" href="../assets/img/examples/space.jpg">
                <img aria-hidden=true src="<?php echo base_url();?>/assets/img/uplb-logo.png"/>
                </a>
                <?php echo $row->class;?>
            </div> -->
            <?php }?>
            <div class="large-3 columns">
            <select name="class-list" onchange="loadStudents(this.options[this.selectedIndex].value); enableViewList(this.options[this.selectedIndex].value); ">
                <option value="-1">Select Class</option>
                    <?php
                        foreach($yearlist->result() as $listElement){
                            ?>
                                <option value="<?php echo $listElement->class?>"><?php echo $listElement->class?></option>
                            <?php
                        }
                    ?>
            </select>
            </div>
            <div class="large-3 end columns">
            <select name="view-list" id="view-list" disabled>
                <option value="0"> View All </option>
                <option value="1"> View by College </option>
                <option value="2"> View by Degree Program</option>>
            </select>
            </div>

            <div class="large-3 end columns" hidden>
            <select name="college-list" id="college-list" onchange="" disabled>
                <option value="0">Select College</option>
                <option value="1"> View All </option>
                <option value="2"> View by College </option>
                <option value="3"> View by Course</option>>
            </select>
            </div>

            <div class="large-3 end columns">
            <select name="degree-list" id="degree-list" onchange="" disabled>
                <option value="0">Select Degree Program</option>
                <?php
                        foreach($degreelist->result() as $listElement){
                            ?>
                                <option value="<?php echo $listElement->course?>"><?php echo $listElement->course?></option>
                            <?php
                        }
                ?>
            </select>
            </div>
        </div>
        <div class="row panel" >
        <div class="large-12 columns" id="Students">
        </div>
        </div>
</div>
