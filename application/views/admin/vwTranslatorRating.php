<style>
 @import url(http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
.backend-raterev{ text-align:center;}
/* Ratings widget */
.rate {
    display: inline-block;
    border: 1px solid #CCC;
}
/*.valid ~ label{color: #73B100 !important;  }*/
/* Hide radio */
.rate > input {
    display: none;
}
/* Order correctly by floating highest to the right */
.rate > label {
    float: right;
}
/* The star of the show */
.rate > label:before {
    display: inline-block;
    font-size: 1.1rem;
    padding: .3rem .2rem;
    margin: 0;
    cursor: pointer;
    font-family: FontAwesome;
    content: "\f005 "; /* full star */
}
/* Zero stars rating */
.rate > label:last-child:before {
    content: "\f089 "; /* empty star outline */
}
/* Half star trick */
.rate .half:before {
    content: "\f089 "; /* half star no outline */
    position: absolute;
    padding-right: 0;
}

.valid ~ label{color: #73B100 !important;  }
.valid ~ label:hover{color: #A6E72D !important;  }
/* Click + hover color */
input:checked ~ label, /* color current and previous stars on checked */
label:hover, label:hover ~ label { color: #73B100;  } /* color previous stars on hover */

/* Hover highlights */
input:checked + label:hover, input:checked ~ label:hover, /* highlight current and previous stars */
input:checked ~ label:hover ~ label, /* highlight previous selected stars for new rating */
label:hover ~ input:checked ~ label /* highlight previous selected stars */ { color: #A6E72D;  }
.backend-raterev{ margin:0px auto; width:400px; border:1px solid #ccc; padding:10px; min-height:150px;}
.reviewfor-user{ font-family: 'Open Sans', sans-serif; font-size:20px; color:#5bbc2e; font-weight:300; padding-bottom:10px; text-align:center;}
.reviewfor-user:after{ width:70px; height:2px; background-color:#5bbc2e; display:block; content:''; margin:0px auto; margin-top:10px; margin-bottom:10px;}
.rev-work{ font-size:14px; font-family: 'Open Sans', sans-serif; color:#494949; padding-bottom:10px; font-weight:700; }
.rating-hedaer{ font-size:14px; font-family: 'Open Sans', sans-serif; color:#494949; padding-bottom:10px; font-weight:bold; }
.rating-hedaer:after{ width:100px; height:2px; background-color:#ccc; display:block; content:''; margin:0px auto; margin-top:10px;}
.rating-hedaer span{ color:#5bbc2e; padding-left:5px; }
.rating-hedaer1{ font-size:14px; font-family: 'Open Sans', sans-serif; color:#494949; padding-bottom:10px; font-weight:bold; margin-top:10px; }
.rating-hedaer1:after{ width:100px; height:2px; background-color:#ccc; display:block; content:''; margin:0px auto; margin-top:10px;}
.rating-hedaer1 span{ color:#5bbc2e; padding-left:5px; }
.revboxx{ border:1px solid #ccc; width:94%; min-height:100px; margin-bottom:10px; color:#494949; padding:1% 3%; font-size:14px; }
.myrevsub{ margin-top:0px; padding:10px 20px; color:#fff; border:none; background-color:#5bbc2e;font-size:15px; font-family: 'Open Sans', sans-serif; font-weight:bold; cursor:pointer; }
.myrevsub:hover{ background-color:#000;}
.inner{    margin: 0px auto; width: 1150px; padding: 0px 10px;}
.frtnd-header{font-size: 24px;   text-align: center;  font-family: 'Open Sans', sans-serif;  width: 100%;  color: #494949; padding-bottom:10px;}
.part-rev1{ width:47%; margin-right:1%; padding:10px; border:1px solid #ccc; overflow: hidden; float:left; margin-top:15px; margin-bottom:10px;}
.part-rev2{ width:47%; margin-left:1%; border:1px solid #ccc; overflow: hidden; float:right; padding:10px; margin-top:15px; margin-bottom:10px;}


.rev-user{font-family: 'Open Sans', sans-serif; font-size:18px; color:#494949; padding-bottom:10px;}
.rev-user:after{ width:70px; height:1px; background-color:#494949; display:block; content:'';margin-top:5px; margin-bottom:10px; }
.total-revrt{ }
.total-revrt span{ padding-right:10px; float:left; color:#5bbc2e;}
.given-rev{color: #9E9B9B; font-family: Lato, "Myriad Pro"; font-size:14px; line-height:20px; margin-top:10px; }
.revby{color: #666666; font-family: Lato, "Myriad Pro"; font-size:12px; float:left; font-weight:bold; padding-top:10px;}
.revby span{ padding-right:10px;}
.revdate{color: #666666; font-family: Lato, "Myriad Pro"; font-size:12px; float:right; font-weight:bold; padding-top:10px;}
.revdate span{ padding-right:10px;}
.totr-bnu{ color:#fff !important; margin-right:15px; background-color:#5bbc2e; text-align:center; padding:5px 10px; border-radius:2px; font-weight:bold;font-family: Lato, "Myriad Pro";    position: relative;  margin-top: -7px;}


</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
$(document).on('click', 'label', function () {
var myid = (this.id);
var value=jQuery("#"+myid).val();
var translator_id=jQuery('#translator_id').val();
var job_id=jQuery('#job_id').val();

var formData = {value:value,translator_id:translator_id,job_id:job_id };
jQuery.ajax({
url : "<?php echo base_url(); ?>" + "admin_awardjob/give_rating",
type: "POST",
data : formData,
success: function(data) {},
error: function (textStatus) {}
});

});
</script>


<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" />

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:300,400,700&amp;subset=latin,latin-ext"/>
</head>
<body>
<div>
<?php if($this->session->flashdata('error_message')){ ?>
<div class="alert alert-block alert-danger">
<button type="button" class="close" data-dismiss="alert">
<i class="ace-icon fa fa-times"></i>
</button>
<p> <?php echo $this->session->flashdata('error_message'); ?> </p>
</div>
<?php } ?>

<?php if($this->session->flashdata('success_message')){ ?>
<div class="alert alert-block alert-success">
<button type="button" class="close" data-dismiss="alert">
<i class="ace-icon fa fa-times"></i>
</button>
<p> <?php echo $this->session->flashdata('success_message'); ?> </p>

</div>
<?php } ?>
</div>
<div class="backend-raterev">
<?php
$translator_id=$this->uri->segment(3);
$job_id=$this->uri->segment(4);
$sql="select * from `translator` where `id`='".$translator_id."' ";
$query=$this->db->query($sql);
$fetch=$query->row();


$sql1="select * from `jobpost` where `id`='".$job_id."' ";
$query1=$this->db->query($sql1);
$fetch1=$query1->row();
?>

<div class="reviewfor-user"><?php echo $fetch->first_name.'&nbsp;'.$fetch->last_name ;?></div>
<div class="rev-work">Work :<?php echo $fetch1->name ;?></div>





<div>

                <?php
                $sql2="select * from `review` where `job_id`='".$job_id."' and `translator_id`='".$translator_id."' ";
                $query2=$this->db->query($sql2);
                $num2=$query2->num_rows();
                if($num2>0)
                {

                $result2=$query2->row();
				//echo '<pre>';print_r($result2);die;
                $rating=$result2->rating;
				?>
                Your Rating::
                <?php
				if(round($rating)==$rating)
				{
				$gray_total=5;
				$gray_due=$gray_total-$rating;

				for($i=1;$i<=$rating;$i++)
				{
				?>
				<img src="<?php echo HTTP_FRONT_IMAGES_PATH;?>yellow_star.png"/>
				<?php
				}
				if($gray_due>0)
				{
				for($i=1;$i<=$gray_due;$i++)
				{
				?>
				<img src="<?php echo HTTP_FRONT_IMAGES_PATH;?>gray_star.png"/>
				<?php
				}
				}
				}else
			    {

				$gray_total=5;
				$rating=$rating-0.5;
				$gray_due=$gray_total-($rating+1);

				for($i=1;$i<=$rating;$i++)
				{
				?>
				<img src="<?php echo HTTP_FRONT_IMAGES_PATH;?>yellow_star.png"/>
				<?php
				}
				?>
				<img src="<?php echo HTTP_FRONT_IMAGES_PATH;?>half_star.png"/>
				<?php
				if($gray_due>0)
				{
				for($i=1;$i<=$gray_due;$i++)
				{
				?>
				<img src="<?php echo HTTP_FRONT_IMAGES_PATH;?>gray_star.png"/>
				<?php
				}
				}


				}

				if($result2->comment!='')
				{
				?>
                </br>
                Your Comment::<?php echo $result2->comment ; ?>
                <?php
				}
                }
                ?>


</div>











<div class="rating-hedaer">Give Rating to<span><?php echo $fetch->first_name.'&nbsp;'.$fetch->last_name ;?></span></div>
<div id="userrating">
<fieldset  class="rate">
<input type="hidden" id="translator_id" value="<?php echo $translator_id ; ?>" >
<input type="hidden" id="job_id" value="<?php echo $job_id ; ?>" >


<input class="n" type="radio" id="star103" name="rating" value="10" />
<label class="full" for="star103" title="Awesome - 10 stars" value="10" id="star103" ></label>
<input class="n" type="radio" id="star9half3" name="rating" value="9.5" />
<label class="half" for="star9half3" title="Pretty good - 9.5 stars" value="9.5" id="star9half3"></label>

<input class="n" type="radio" id="star93" name="rating" value="9" />
<label class="full" for="star93" title="Awesome - 9 stars" value="9" id="star93" ></label>
<input class="n" type="radio" id="star8half3" name="rating" value="8.5" />
<label class="half" for="star8half3" title="Pretty good - 8.5 stars" value="8.5" id="star8half3"></label>

<input class="n" type="radio" id="star83" name="rating" value="8" />
<label class="full" for="star83" title="Awesome - 8 stars" value="8" id="star83" ></label>
<input class="n" type="radio" id="star7half3" name="rating" value="7.5" />
<label class="half" for="star7half3" title="Pretty good - 7.5 stars" value="7.5" id="star7half3"></label>

<input class="n" type="radio" id="star73" name="rating" value="7" />
<label class="full" for="star73" title="Awesome - 7 stars" value="6" id="star73" ></label>
<input class="n" type="radio" id="star6half3" name="rating" value="6.5" />
<label class="half" for="star6half3" title="Pretty good - 6.5 stars" value="6.5" id="star6half3"></label>

<input class="n" type="radio" id="star63" name="rating" value="6" />
<label class="full" for="star63" title="Awesome - 6 stars" value="6" id="star63" ></label>
<input class="n" type="radio" id="star5half3" name="rating" value="5.5" />
<label class="half" for="star5half3" title="Pretty good - 5.5 stars" value="5.5" id="star5half3"></label>

<input class="n" type="radio" id="star53" name="rating" value="5" />
<label class="full" for="star53" title="Awesome - 5 stars" value="5" id="star53" ></label>
<input class="n" type="radio" id="star4half3" name="rating" value="4.5" />
<label class="half" for="star4half3" title="Pretty good - 4.5 stars" value="4.5" id="star4half3"></label>
<input class="n" type="radio" id="star43" name="rating" value="4" />
<label clas ="full" for="star43" title="Pretty good - 4 stars" value="4" id="star43"></label>
<input class="n" type="radio" id="star3half3" name="rating" value="3.5" />
<label class="half" for="star3half3" title="Meh - 3.5 stars" value="3.5" id="star3half3"></label>
<input class="n" type="radio" id="star33" name="rating" value="3" />
<label class="full" for="star33" title="Meh - 3 stars" value="3" id="star33"></label>
<input class="n" type="radio" id="star2half3" name="rating" value="2.5" />
<label class="half" for="star2half3" title="Kinda bad - 2.5 stars" value="2.5" id="star2half3"></label>
<input class="n" type="radio" id="star23" name="rating" value="2" />
<label class="full" for="star23" title="Kinda bad - 2 stars" value="2" id="star23"></label>
<input class="n" type="radio" id="star1half3" name="rating" value="1.5" />
<label class="half" for="star1half3" title="Meh - 1.5 stars" value="1.5" id="star1half3"></label>
<input class="n" type="radio" id="star13" name="rating" value="1" />
<label class="full" for="star13" title="Sucks big time - 1 star" value="1" id="star13"></label>
<input class="n" type="radio" id="starhalf3" name="rating" value="0.5" />
<label class="half" for="starhalf3" title="Sucks big time - 0.5 stars" value="0.5" id="starhalf3"></label>
</fieldset>
<div id='feedback'></div>
</div>

<form action="<?php echo base_url().'admin_awardjob/give_rating_comment/'.$translator_id.'/'.$job_id;?>" method="post">
<div class="rating-hedaer1">Give Review for<span><?php echo $fetch->first_name.'&nbsp;'.$fetch->last_name ;?></span></div>
<textarea name="message" cols="" rows="" class="revboxx" placeholder="Your Comment"></textarea>
<div style="clear:both"></div>
<input name="" type="submit" value="Submit" class="myrevsub">
</form>
</div>
