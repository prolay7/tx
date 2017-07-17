
        <div id="search-filter" class="block background">
         <?php 
		  $lansql="select * from `languages`";
		  $lanquery=mysql_query($lansql);
		  ?>
          <h2 class="title-1">Search</h2>
          <div class="block-content">
          		<?php
                $attributes = array('class' => 'form-inline reset-margin', 'id' => 'search-job-page');
                $options_category = array();
                foreach ($jobpost as $array) {
					foreach ($array as $key => $value) {
						$options_category[$key] = $key;
					}
					break;
                }
                echo form_open('jobs', $attributes);
				
				?>
                 <style type="text/css">
			.order_by_cls {
				display:none !important;	
			}
		</style>
       
            <!--<form id="search-job-page" action="post">-->
              <label>Search By Language</label>
                <?php									
                //echo form_label('Search:', 'search_string');
                //echo form_input('search_string', $search_string_selected, 'style="width: 170px; height: 26px;"');
                echo form_dropdown('order', $options_category, $order, 'class="span2 order_by_cls"');
                $data_submit= array('name' => 'mysubmit', 'class' => 'btn btn-primary btn-sm', 'value' => 'Go');
                $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 order_by_cls"');
				?>
              <select id="search-select" class="select validate[required]" name="job_language">
               
                <option value=""> Select Language </option>
                <?php while($lanfetch=mysql_fetch_array($lanquery)) {?>
 <option value="<?php echo $lanfetch['id']; ?>" <?php if($lanfetch['id']==$language_selected){echo 'selected';} ?>><?php echo $lanfetch['name']; ?></option>
                <?php }?>
                
              </select>
             <!-- <input type="text" placeholder="Search" class="textfield-with-callback"/>-->
               <input type="text" name="search_string" value="<?php echo $search_string_selected; ?>" placeholder="Search..."  id="textfield-with-callback"  />
              <input type="submit" value="Search" id="search-job-page-submit"/>&nbsp;<!--<input type="reset" class="btn gray next-btn" value="Reset">--> <a href="<?php base_url().'jobs'?>" class="btn gray next-btn" > Reset</a> 
            </form>
          </div>
          
          
        </div>
        
        
