<div id="content-box" class="content-box clearfix" style="display: block;">
    <h2>UPLB Graduates</h2>
        <div class="row panel" id="yearbook">
            <?php /* foreach($yearlist->result() as $row) { ?>
            <div class="yearbook-year medium-2 columns">
                <a class="th" role="button" aria-label="Thumbnail" href="../assets/img/examples/space.jpg">
                <img aria-hidden=true src="<?php echo base_url();?>/assets/img/uplb-logo.png"/>
                </a>
                <?php echo $row->class;?>
            </div>
            <?php }*/?>
            <div class="large-offset-5 large-2 columns">
            <select name="class-list" onchange="loadStudents(this.options[this.selectedIndex].value)">
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
            <div id="Students">

            </div>
        </div>
</div>
