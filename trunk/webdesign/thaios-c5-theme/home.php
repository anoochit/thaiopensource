<html>
<head>
<?php Loader::element('header_required'); ?>
<link rel="stylesheet" type="text/css" href="<?=$this->getThemePath();?>/styles.css" />
<link rel="stylesheet" type="text/css" href="<?=$this->getThemePath();?>/slide.css" />
<!-- JavaScripts -->
<script type="text/javascript" src="<?=$this->getThemePath();?>/js/jquery.js"></script>
<script type="text/javascript" src="<?=$this->getThemePath();?>/js/s3Slider.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#slider1').s3Slider({
            timeOut: 3000 
        });
    });
</script> 
</head>
<body>

<div id="wrap">
	<div id="subheader">
        <!-- menu -->
        <?php
               $a = new Area('Header Nav');
               $a->display($c);
        ?>
    </div>
	<div id="header"><img src="<?=$this->getThemePath();?>/images/logo.png" alt="Thai OS"></div>
	<div id="nav">
<!-- slide -->
<div id="slider1">
        <ul id="slider1Content">
            <li class="slider1Image">
                <img src="<?=$this->getThemePath();?>/images/slide01.png" alt="1" />
                <span class="left"><strong>เสรีภาพ</strong><br />ไทยโอเอสให้เสรีภาพในการใช้ พัฒนา และแจกจ่ายกับคุณ คุณสามารถใช้งานไทยโอเอสเพื่อความต้องการใดๆ ก็ได้ตามต้องการ โดยไม่มีการจำกัดความสามารถ</span>
            </li>
            <li class="slider1Image">
                <img src="<?=$this->getThemePath();?>/images/slide02.png" alt="2" />
                <span class="left"><strong>เสมอภาค</strong><br />ทุกคนสามารถใช้งาน พัฒนา และแจกจ่ายได้อย่างเท่าเทียมกัน มีสิทธิ์ในตัวของไทยโอเอสร่วมกัน</span>
            </li>
            <li class="slider1Image">
                <img src="<?=$this->getThemePath();?>/images/slide03.png" alt="3" />
                <span class="left"><strong>เอกภาพ</strong><br/>เอกลักษณ์เฉพาะตัว มีความเป็นเอกภาพเป็นของตนเอง และความสามารถที่ไม่ด้อยไปกว่าระบบปฏิบัติการใดๆ ที่มีอยู่ในโลก </span>
            </li>
            <li class="slider1Image">
                <img src="<?=$this->getThemePath();?>/images/slide04.png" alt="4" />
                <span class="left"><strong>ภราดรภาพ</strong><br />ไทยโอเอสเหมาะสมและเข้ากันได้กับพี่น้องชาวไทยทุกคน รองรับภาษาไทยทั้งการพิมพ์ การแสดงผล และแบบอักษร</span>
            </li>
            <div class="clear slider1Image"></div>
        </ul>
    </div>
<!-- slide -->
	</div>
	<div id="main">
	  <div id="round" >
		<?php
		   $a = new Area('Main Content 1');
		   $a->display($c);
		?>	
	    </div>		
        <img src="<?=$this->getThemePath();?>/images/space.png">
        <div id="round" >
		<?php
		   $a = new Area('Main Content 2');
		   $a->display($c);
		?>		
        </div>		
	</div>
	<div id="sidebar">
        <div id="round" >
		<?php
		   $a = new Area('Main Content 3');
		   $a->display($c);
		?>		
        </div>		
        <img src="<?=$this->getThemePath();?>/images/space.png">
        <div id="round" >
		<?php
		   $a = new Area('Main Content 4');
		   $a->display($c);
		?>		
        </div>		
	</div>
	<div id="footer">
		<p>สนับสนุนโดย สำนักงานส่งเสริมอุตสาหกรรมซอฟต์แวร์แห่งชาติ (องค์การมหาชน)</p>
	</div>
</div> 
</body>
</html>
