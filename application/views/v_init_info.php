<div id="content-box" class="content-box clearfix" style="display: block;">
    <h2>Initialize Account Information</h2>
       
                <div class="row">
                    <div class="large-9 columns">

                    <div class="row">
                        <form method='post' action='<?php echo base_url('/index.php/c_user/add_info')?>'>
                            <div class="large-4 columns">
                            <label> First Name</label>
                            <input type="text" name="grad-first-name" id="grad-first-name"/>
                            </div>
                            <div class="large-4 columns">
                            <label> Middle Name</label>
                            <input type="text" name="grad-mid-name" id="grad-mid-name"/>
                            </div>
                            <div class="large-4 columns">
                            <label> Last Name</label>
                            <input type="text" name="grad-last-name" id="grad-last-name"/>
                            </div>

                            <div class="large-2 columns">
                            <label> Sex</label>
                            <input type="text" name="grad-sex" id="grad-sex"/>
                            </div>
                            <div class="large-4 columns">
                            <label> Birthdate</label>
                            <input type="date" name="grad-bdate" id="grad-bdate"/>
                            </div>

                            <div class="large-6 columns">
                            <label> Email</label>
                            <input type="text" name="grad-email" id="grad-email"/>
                            </div>

                            <div class="large-6 columns">
                            <label> Mobile No</label>
                            <input type="text" name="grad-mobile" id="grad-mobile"/>
                            </div>

                            <div class="large-6 columns">
                            <label> Tel No</label>
                            <input type="text" name="grad-tel" id="grad-tel"/>
                            </div>

                            <div class="large-12 columns">
                                <select name="country" onchange="selectState(this.options[this.selectedIndex].value)">
                                    <option value="-1">Select country</option>
                                        <?php
                                            foreach($list->result() as $listElement){
                                                ?>
                                                    <option value="<?php echo $listElement->alpha_2?>"><?php echo $listElement->name?></option>
                                                <?php
                                            }
                                        ?>
                                </select>

                                <select id="state_dropdown" name="state">
                                    <option value="-1">Select state</option>
                                </select>

                            </div>


                            <input class="button small-offset-10" type="submit" name="submit" value="Proceed" id="grad-submit"/>
                        </form>
                    </div>
                </div>
                </div>
    
</div>