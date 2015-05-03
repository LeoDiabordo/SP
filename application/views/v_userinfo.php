<div id="content-box" class="content-box clearfix" style="display: block;">
    <h2>Career Information</h2>
        <div class="row">
            <div class="large-9 columns">
                <ul class="tabs" data-tab>
                  <li class="tab-title active"><a href="#panel1">Experience</a></li>
                  <li class="tab-title"><a href="#panel2">Education</a></li>
                  <li class="tab-title"><a href="#panel3">Projects</a></li>
                  <li class="tab-title"><a href="#panel3">Publications</a></li>
                </ul>
                <div class="tabs-content">
                  <div class="content active" id="panel1">
                    <div class="row">
                        <form method='post' action='<?php echo base_url('/index.php/c_user/add_experience')?>'>
                            <div class="large-12 columns">
                            <label> Company</label>
                            <input type="text" name="exp-company-name" id="exp-company-name"/>
                            </div>
                            <div class="large-12 columns">
                            <label> Location</label>
                            <input type="text" name="exp-company-loc" id="exp-company-loc"/>
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
                        <form>
                            <div class="large-12 columns">
                            <label> Company</label>
                            <input type="text" name="exp-company" id="exp-company" class="exp-company" placeholder="Student Number" />
                            </div>
                            <div class="large-12 columns">
                            <label> Location</label>
                            <input type="text" name="exp-company" id="exp-company" class="exp-company" placeholder="Student Number" />
                            </div>
                            <div class="large-4 columns">
                                <label> Company Type </label>
                                <input type="text" name="exp-company" id="exp-company" class="exp-company" placeholder="Student Number" />
                            </div>
                            <div class="large-4 columns"> </div>
                            <div class="large-4 columns"> </div>
                            <div class="large-12 columns">
                                <label>Job Title</label>
                                <input type="text" name="exp-company" id="exp-company" class="exp-company" placeholder="Student Number" />
                            </div>
                            <div class="large-4 columns">
                                <label> Salary </label>
                                <input type="text" name="exp-company" id="exp-company" class="exp-company" placeholder="Student Number" />
                            </div>
                            <div class="large-8 columns">
                                <label> Employment type</label>
                                <input type="text" name="exp-company" id="exp-company" class="exp-company" placeholder="Student Number" />
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
                    <p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
                  </div>
                </div>
            </div> 
            <div class="large-3 columns">
                <label>History</label>
                text text text text text text text text text texttext text text text texttext text text text texttext text text text texttext text text text text
            </div>
        </div>
    
    
</div>