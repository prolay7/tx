<form method="post" action="<?= base_url(); ?>admin/invoice/edit/<?= $id; ?>" id="edit_invoice">
    <div class="control-group">
        <label class="control-label" for="txt_email">Email:</label>
        <div class="controls">
            <select class = "form-control selectpicker" data-live-search="true" id="trans_id_edit" name="trans_id">
                <?php ?>
                <option value="">Select Translator</option>
                <?php foreach($translator as $tr) { ?>
                    <option value="<?php echo $tr->id;?>" <?php echo ($data->trans_id == $tr->id)?'selected':''; ?>><?php echo $tr->first_name.''.$tr->last_name.'('.$tr->email_address.')';?></option>
                <?php } ?>
            </select>
            <p class="help-block"></p>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="txt_email">Translate From:</label>
        <div class="controls">
            <select class = "form-control selectpicker" data-live-search="true" id="from_language_edit" name="from_language">
                <option value="">Select Language</option>
                <?php
                $language = explode('/',$jobpost->language);
                foreach($list_languages as $fr) { ?>
                    <option value="<?php echo $fr->id;?>" <?php echo ($language[0] == $fr->id)?'selected':''; ?>><?php echo $fr->name;?></option>
                <?php } ?>
            </select>
            <p class="help-block"></p>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="txt_email">Translate To:</label>
        <div class="controls">
            <select class = "form-control selectpicker" data-live-search="true" id="to_language_edit" name="to_language">
                <option value="">Select Languate</option>
                <?php foreach($list_languages as $to) { ?>
                    <option value="<?php echo $to->id;?>" <?php echo ($language[1] == $to->id)?'selected':''; ?>><?php echo $to->name;?></option>
                <?php } ?>
            </select>
            <p class="help-block"></p>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="txt_email">Line Number:</label>
        <div class="controls">
            <?php
            $curr_month = date("m"); $curr_year = date("y");
            if (isset($curr_values['lineMonth'])) {
                $curr_month = $curr_values['lineMonth'];
            }

            if (isset($curr_values['lineYear'])) {
                $curr_year = $curr_values['lineYear'];
            }

            ?>
            <div class="row">
                <div class="col-md-3">
                    <select name="lineMonth" id="lineMonth_edit" class="form-control selectpicker" >
                        <option value="01" <?php if($jobpost->lineMonth == "01") echo "selected"; ?>>January</option>
                        <option value="02" <?php if($jobpost->lineMonth == "02") echo "selected"; ?>>February</option>
                        <option value="03" <?php if($jobpost->lineMonth == "03") echo "selected"; ?>>March</option>
                        <option value="04" <?php if($jobpost->lineMonth == "04") echo "selected"; ?>>April</option>
                        <option value="05" <?php if($jobpost->lineMonth == "05") echo "selected"; ?>>May</option>
                        <option value="06" <?php if($jobpost->lineMonth == "06") echo "selected"; ?>>June</option>
                        <option value="07" <?php if($jobpost->lineMonth == "07") echo "selected"; ?>>July</option>
                        <option value="08" <?php if($jobpost->lineMonth == "08") echo "selected"; ?>>August</option>
                        <option value="09" <?php if($jobpost->lineMonth == "09") echo "selected"; ?>>September</option>
                        <option value="10" <?php if($jobpost->lineMonth == "10") echo "selected"; ?>>October</option>
                        <option value="11" <?php if($jobpost->lineMonth == "11") echo "selected"; ?>>November</option>
                        <option value="12" <?php if($jobpost->lineMonth == "12") echo "selected"; ?>>December</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="lineYear" id="lineYear_edit"class="form-control selectpicker" >
                        <?php foreach(range(date('Y'), 2050) as $year) { ?>
                            <option value="<?php echo substr($year, -2); ?>" <?php if($jobpost->lineYear == substr($year, -2)) echo 'selected'; ?>><?php echo $year; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input name="lineNumber" type="text" id="lineNumber_edit" class="form-control" value="<?php echo $jobpost->lineNumber; ?>" />
                    <input type="hidden" id="_lineMonth" name="_lineMonth_edit" value="<?php echo $jobpost->lineMonth; ?>" />
                    <input type="hidden" id="_lineYear" name="_lineYear_edit" value="<?php echo $jobpost->lineYear; ?>" />
                    <input type="hidden" id="_lineNumber" name="_lineNumber_edit" value="<?php echo $jobpost->lineNumber; ?>" />
                </div>
            </div>

            <p class="help-block"></p>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="txt_email">Amount Charged to Client:</label>
        <div class="controls">
            <input class = "form-control" name="price" id="price_edit" value="<?php echo $jobpost->price; ?>">
            <p class="help-block"></p>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="txt_email">Amount owed to translator:</label>
        <div class="controls">
            <input class = "form-control" name="amount_owed" id="amount_owed_edit" value="<?php echo $bidjob->price; ?>">
            <p class="help-block"></p>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="txt_email">Awarded Date:</label>
        <div class="controls">
            <div class="form-group">
                <div class='input-group date' id='awarded_date'>
                    <input id="awarded_date_edit" name="awarded_date" type='text' onkeypress="return false" onkeyup="return false" class="form-control" value="<?php echo date('m/d/Y h:i A',strtotime($bidjob->award_date)); ?>" />
                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
                </div>
            </div>
            <p class="help-block"></p>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="txt_email">Date the job was handed in by the translator:</label>
        <div class="controls">
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input id="datetimepicker1_edit" name="datetimepicker1" onkeypress="return false" onkeyup="return false" type='text' class="form-control" value="<?php echo date('m/d/Y h:i A',strtotime($bidjob->complete_date)); ?>" />
                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
                </div>
            </div>
            <p class="help-block"></p>
        </div>
    </div>

    <p><h2>Rating</h2></p>
    <p>How good did the original translator do?</p>
    <p><i>10 being the highest</i></p>

    <div class="control-group">
        <div class="controls">
            <div class="form-group">
                <div class="form-inline">
                    <label class="radio" id="poor">
                        1
                        <input type="radio" <?php echo ($rating->rating == 1)?'checked':''; ?> value="1" name="rate" id="rate"/>
                    </label>
                    <label class="radio" id="poor">
                        2
                        <input type="radio" value="2" <?php echo ($rating->rating == 2)?'checked':''; ?> name="rate" id="rate"/>
                    </label>
                    <label class="radio" id="poor">
                        3
                        <input type="radio" value="3" <?php echo ($rating->rating == 3)?'checked':''; ?> name="rate" id="rate"/>
                    </label>
                    <label class="radio" id="poor">
                        4
                        <input type="radio" value="4" <?php echo ($rating->rating == 4)?'checked':''; ?> name="rate" id="rate"/>
                    </label>
                    <label class="radio" id="poor">
                        5
                        <input type="radio" value="5" <?php echo ($rating->rating == 5)?'checked':''; ?> name="rate" id="rate"/>
                    </label>
                    <label class="radio" id="average">
                        6
                        <input type="radio" value="6" <?php echo ($rating->rating == 6)?'checked':''; ?> name="rate" id="rate"/>
                    </label>
                    <label class="radio" id="average">
                        7
                        <input type="radio" value="7" <?php echo ($rating->rating == 7)?'checked':''; ?> name="rate" id="rate"/>
                    </label>
                    <label class="radio" id="pass">
                        8
                        <input type="radio" value="8" <?php echo ($rating->rating == 8)?'checked':''; ?> name="rate" id="rate"/>
                    </label>
                    <label class="radio" id="pass">
                        9
                        <input type="radio" value="9" <?php echo ($rating->rating == 9)?'checked':''; ?> name="rate" id="rate"/>
                    </label>
                    <label class="radio" id="pass">
                        10
                        <input type="radio" value="10" <?php echo ($rating->rating == 10)?'checked':''; ?> name="rate" id="rate"/>
                    </label>
                    <input type="hidden" name="rating_id" value="<?php echo $rating->id; ?>">
                </div>
            </div>
        </div>
    </div>



    <div class="control-group">
        <div class="q1" style="margin-top: 10px;">
            <p>1. Is all spelling and grammar now accurate?</p>
            <input type="radio" id="q1-yes-answer" name="q1" <?php echo ($data->text == 'Is all spelling and grammar now accurate? Yes')?'checked':''; ?> value="Is all spelling and grammar now accurate? Yes" /><label for="q1-yes-answer">Yes</label>
            <input type="radio"  id="q1-no-answer" name="q1" <?php echo ($data->text == 'Is all spelling and grammar now accurate? No')?'checked':''; ?> value="Is all spelling and grammar now accurate? No" /><label for="q1-no-answer">No</label>
        </div>
    </div>

    <div class="control-group">
        <div class="q2">
            <p>2. Has literal translation been avoided?</p>
            <input type="radio" id="q2-answer" name="q2" <?php echo ($data->text == 'Has literal translation been avoided? Yes')?'checked':''; ?> value="Has literal translation been avoided? Yes" /><label for="q2-yes-answer">Yes</label>
            <input type="radio" id="q2-answer" name="q2" <?php echo ($data->text == 'Has literal translation been avoided? No')?'checked':''; ?> value="Has literal translation been avoided? No" /><label for="q2-no-answer">No</label>
        </div>
    </div>

    <div class="control-group">
        <div class="q3">
            <p>3. Have numbers and money quantities been changed to match the target text style.</p>
            <p>For Example: 10.000 to 10,000 if translating or vise versa?</p>
            <input type="radio" id="q3-answer" name="q3" <?php echo ($data->text == 'Have numbers and money quantities been changed to match the target text style Yes')?'checked':''; ?> value="Have numbers and money quantities been changed to match the target text style Yes" /><label for="q3-yes-answer">Yes</label>
            <input type="radio" id="q3-answer" name="q3" <?php echo ($data->text == 'Have numbers and money quantities been changed to match the target text style No')?'checked':''; ?> value="Have numbers and money quantities been changed to match the target text style No" /><label for="q3-no-answer">No</label>
            <input type="radio" id="q4-answer" name="q3" <?php echo ($data->text == "Have numbers and money quantities been changed to match the target text styleDon't know")?'checked':''; ?> value=" Have numbers and money quantities been changed to match the target text styleDon't know" /><label for="q4-no-answer">Dont know</label>
        </div>
    </div>

    <div class="control-group">
        <div class="q4">
            <p>4. Has the terminology been consistent throughout the text?</p>
            <input type="radio" id="q4-answer" name="q4" <?php echo ($data->text == "Has the terminology been consistent throughout the text? Yes")?'checked':''; ?> value="Has the terminology been consistent throughout the text? Yes" /><label for="q4-yes-answer">Yes</label>
            <input type="radio" id="q4-answer" name="q4" <?php echo ($data->text == "Has the terminology been consistent throughout the text? No")?'checked':''; ?> value="Has the terminology been consistent throughout the text? No" /><label for="q4-no-answer">No</label>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#edit_invoice").validate({
            ignore: [],
            rules: {
                amount_owed:"required",
                datetimepicker1:"required",
                trans_id:"required",
                to_language:"required",
                from_language:"required",
                lineNumber:"required",
                price:"required",
                amount_owed:"required",
                awarded_date:"required",
                rate:"required"
            },
            errorPlacement: function(error, element) {
                if (element.attr("type") == "radio") {
                    error.insertBefore(element);
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>