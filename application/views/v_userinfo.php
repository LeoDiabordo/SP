<div id="content-box" class="content-box clearfix" style="display: block;">
    <h2>Career Information</h2>
        <div class="row">
            <div class="large-9 columns">
                <ul class="tabs" data-tab>
                  <li class="tab-title active"><a href="#panel1">Experience</a></li>
                  <li class="tab-title"><a href="#panel2">Education</a></li>
                  <li class="tab-title"><a href="#panel3">Projects</a></li>
                  <li class="tab-title"><a href="#panel4">Publications</a></li>
                </ul>
                <div class="tabs-content">
                  <div class="content active" id="panel1">
                    <div class="row">
                        <form method='post' action='<?php echo base_url('/index.php/c_user/add_experience')?>'>
                            <div class="large-12 columns">
                            <label> Company</label>
                            <input type="text" name="exp-company-name" id="exp-company-name"/>
                            </div>
                           

                            <div class="large-6 columns">
                                <label> Country </label>
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
                            </div>
                            <div class="large-6 columns">
                                <label> Province </label>
                                <select id="state_dropdown" name="state">
                                    <option value="-1">Select State/Province/Region</option>
                                </select>
                            </div>

                            <div class="large-4 columns">
                                <label> Company Type </label>
                                <select name="exp-company-type">
                                    <option value=""> -- Select -- </option>
                                    <option value="0"> Self-employed </option>
                                    <option value="0"> Private </option>
                                    <option value="1"> Government </option>
                                </select>
                            </div>
                            <div class="large-8 columns">
                            <label> Position</label>
                            <input type="text" name="exp-job-position" id="exp-job-position"/>
                            </div>
                            <div class="large-4 columns"> </div>
                            <div class="large-4 columns"> </div>
                            <div class="large-12 columns">
                                <label>Job Title</label>
                                <input type="text" name="exp-job-title" id="exp-job-title"/>
                            </div>
                            <div class="large-4 columns">
                                <label> Salary (Php)</label>
                                <select name="exp-job-salary">
                                    <option value=""> -- Select -- </option>
                                    <option value="0"> Less than 20,000 </option>
                                    <option value="1"> 20,001 - 40,000 </option>
                                    <option value="2"> 40,001 - 60,000 </option>
                                    <option value="3"> 60,001 - 80,000 </option>
                                    <option value="4"> 80,001 - 100,000 </option>
                                    <option value="5"> 100,001 - 150,000 </option>
                                    <option value="6"> 150,001 and above </option>                     
                                </select>
                            </div>
                            <div class="large-8 columns">
                                <label> Employment type</label>
                                <select name="exp-job-type">
                                    <option value=""> -- Select -- </option>
                                    <option value="Regular"> Regular </option>
                                    <option value="Permanent"> Permanent </option>
                                    <option value="Temporary"> Temporary </option>
                                    <option value="Casual"> Casual </option>
                                    <option value="Contractual"> Contractual </option>
                                    <option value="Self-employed"> Self-employed </option>
                                </select>
                            </div>

                            <div class="large-12 columns">
                                <label> Current Job? </label>
                                <input type="radio" name="exp-current" value="1" checked>Yes
                                <input type="radio" name="exp-current" value="0">No
                            </div>

                            <div class="large-12 columns">
                                <label> Time Period</label>
                                <div class="large-4 columns">
                                    <input type="date" name="exp-job-start" id="exp-job-start"/>
                                </div>
                                
                                <div class="large-4 columns">
                                    <input type="date" name="exp-job-end" id="exp-job-end"/>
                                </div>
                                <div class="large-1 columns"> </div>
                            </div>
                            <div class="large-2 large-offset-10 columns">
                                <div class="large-12 columns">
                                    <input class="button" type="submit" name="submit" value="Save" id="exp-submit"/>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                  <div class="content" id="panel2">
                    <div class="row">
                        <form method='post' action='<?php echo base_url('/index.php/c_user/add_education')?>'>
                            <div class="large-12 columns">
                                <label> School Name</label>
                                <input type="text" name="educ-school-name" id="educ-school-name" class="educ-school-name" placeholder="School Name" />
                            </div>
                            

                            <div class="large-6 columns">
                                <label> Country </label>
                                <select name="educ_country" onchange="selectEducState(this.options[this.selectedIndex].value)">
                                    <option value="-1">Select country</option>
                                        <?php
                                            foreach($list->result() as $listElement){
                                                ?>
                                                    <option value="<?php echo $listElement->alpha_2?>"><?php echo $listElement->name?></option>
                                                <?php
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="large-6 columns">
                                <label> Province </label>
                                <select id="educ_state_dropdown" name="educ_state">
                                    <option value="-1">Select State/Province/Region</option>
                                </select>
                            </div>


                            <div class="large-12 columns">
                                <label> Level </label>
                                <select name="educ-school-level" onchange="enableTertiary(this.options[this.selectedIndex].value)">
                                    <option value=""> -- Select -- </option>
                                    <option value="Primary"> Primary </option>
                                    <option value="Secondary"> Secondary </option>
                                    <option value="Tertiary"> Tertiary </option>
                                </select>
                            </div>
                            
  
                            <div class="large-12 columns">
                                <label> Course </label>
                                <input type="text" name="educ-course" id="educ-course" class="educ-course" placeholder="Course Degree for Tertiary Education" disabled/>
                            </div>

                            <div class="large-12 columns">
                                <label> Graduated? </label>
                                <input type="radio" name="educ-grad" value="1" checked>Yes
                                <input type="radio" name="educ-grad" value="0">No
                            </div>

                            <div class="large-6 columns">
                                <label> Batch </label>
                                <select name="educ-batch" id="educ-batch">
                                    <option value=""> -- Select -- </option>
                                    <option value="1990"> 1990 </option>
                                    <option value="1991"> 1991 </option>
                                    <option value="1992"> 1992 </option>
                                    <option value="1993"> 1993 </option>
                                    <option value="1994"> 1994 </option>
                                    <option value="1995"> 1995 </option>
                                    <option value="1996"> 1996 </option>
                                    <option value="1997"> 1997 </option>
                                    <option value="1998"> 1998 </option>
                                    <option value="1999"> 1999 </option>
                                    <option value="2000"> 2000 </option>
                                    <option value="2001"> 2001 </option>
                                    <option value="2002"> 2002 </option>
                                    <option value="2003"> 2003 </option>
                                    <option value="2004"> 2004 </option>
                                    <option value="2005"> 2005 </option>
                                    <option value="2006"> 2006 </option>
                                    <option value="2007"> 2007 </option>
                                    <option value="2008"> 2008 </option>
                                    <option value="2009"> 2009 </option>
                                    <option value="2010"> 2010 </option>
                                    <option value="2011"> 2011 </option>
                                    <option value="2012"> 2012 </option>
                                    <option value="2013"> 2013 </option>
                                    <option value="2014"> 2014 </option>
                                    <option value="2015"> 2015 </option>
                                    <option value="2016"> 2016 </option>
                                </select>
                            </div>
                            <div class="large-6 columns">    
                                <label> Class </label>
                                <select name="educ-class" id="educ-class">
                                    <option value=""> -- Select -- </option>
                                    <option value="1990"> 1990 </option>
                                    <option value="1991"> 1991 </option>
                                    <option value="1992"> 1992 </option>
                                    <option value="1993"> 1993 </option>
                                    <option value="1994"> 1994 </option>
                                    <option value="1995"> 1995 </option>
                                    <option value="1996"> 1996 </option>
                                    <option value="1997"> 1997 </option>
                                    <option value="1998"> 1998 </option>
                                    <option value="1999"> 1999 </option>
                                    <option value="2000"> 2000 </option>
                                    <option value="2001"> 2001 </option>
                                    <option value="2002"> 2002 </option>
                                    <option value="2003"> 2003 </option>
                                    <option value="2004"> 2004 </option>
                                    <option value="2005"> 2005 </option>
                                    <option value="2006"> 2006 </option>
                                    <option value="2007"> 2007 </option>
                                    <option value="2008"> 2008 </option>
                                    <option value="2009"> 2009 </option>
                                    <option value="2010"> 2010 </option>
                                    <option value="2011"> 2011 </option>
                                    <option value="2012"> 2012 </option>
                                    <option value="2013"> 2013 </option>
                                    <option value="2014"> 2014 </option>
                                    <option value="2015"> 2015 </option>
                                    <option value="2016"> 2016 </option>
                                <select>
                            </div>

                            <div class="large-2 columns">
                                <div class="large-12 columns">
                                    <input class="button" type="submit" name="submit" value="Save" id="login-submit" class="login-submit" />
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                <div class="content" id="panel3">
                    <div class="row">
                        <form method='post' action='<?php echo base_url('/index.php/c_user/add_project')?>'>
                            <div class="large-12 columns">
                                <label> Project Title</label>
                                <input type="text" name="proj-title" id="proj-title"/>
                            </div>
                           

                            <div class="large-12 columns">
                                <label> Project Description </label>
                                <textarea maxlength="300" name="proj-desc" id="proj-desc" ></textarea>
                            </div>

                            <div class="large-12 columns">
                                <label> On Going? </label>
                                <input type="radio" name="proj-ongoing" value="1">Yes
                                <input type="radio" name="proj-ongoing" value="0">No
                            </div>

                            <div class="large-12 columns">
                                <label> Time Period</label>
                                <div class="large-4 columns">
                                    <input type="date" name="proj-start" id="proj-start"/>
                                </div>
                                
                                <div class="large-4 columns">
                                    <input type="date" name="proj-end" id="proj-end"/>
                                </div>
                                <div class="large-1 columns"> </div>
                            </div>
                            <div class="large-2 large-offset-10 columns">
                                <div class="large-12 columns">
                                    <input class="button" type="submit" name="submit" value="Save" id="proj-submit"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="content" id="panel4">
                    <div class="row">
                        <form method='post' action='<?php echo base_url('/index.php/c_user/add_publication')?>'>
                            <div class="large-12 columns">
                                <label> Publication Title</label>
                                <input type="text" name="pub-title" id="pub-title"/>
                            </div>
                           

                            <div class="large-12 columns">
                                <label> Publication Description </label>
                                <textarea maxlength="300" name="pub-desc" id="pub-desc" ></textarea>
                            </div>

                            <div class="large-12 columns">
                                <label> Publication Body </label>
                                <input type="text" name="pub-body" id="pub-body">
                            </div>

                            <div class="large-12 columns">
                                <label> Publication Date</label>
                                <div class="large-4 columns">
                                    <input type="date" name="pub-date" id="pub-date"/>
                                </div>
                            </div>
                            <div class="large-2 large-offset-10 columns">
                                <div class="large-12 columns">
                                    <input class="button" type="submit" name="submit" value="Save" id="proj-submit"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div> 
            <div class="large-3 columns">
                <label>History</label>
                <div class="tabs-content">
                    <div class="content active" id="panel1">
                        <?php
                            foreach($histExp->result() as $expElement){
                                ?>
                                    <div>
                                        <?php
                                            echo $expElement->workdatestart."<br>";

                                        ?>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="content" id="panel2">
                        
                    </div>
                </div>
            </div>
        </div>
    
</div>

