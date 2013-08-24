<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Framgia Viet Nam');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription; ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
            'style', 
            'bootstrap', 
            'bootstrap.min', 
            'bootstrap-responsive', 
            'bootstrap-responsive.min'
            ));
        
        echo $this->Html->script('jquery-2.0.3.min');
        echo $this->Html->script(array(
            'jquery-2.0.3.min.map',
            'jquery-ui',
            'bootstrap.min',
            'bootstrap',
            'bootstrap-carousel',
            'layout',
            'device',
            'jquery-latest',
        ));
 		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/hook/hook.css" type="text/css" />
    <script src="/hook/hook.js" type="text/javascript"></script>
    <meta property="fb:admins" content="{100001154855280}"/>
</head>
<body>
	<div id="container">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>


        <div id="header">
        <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar">
                    <div class="navbar-inner">
                      <a class="brand" href="#">Framgia Viet Nam</a>
                      <ul class="nav">
                        <li class="active"><?php echo $this->Html->link('Home', '/'); ?></li>
                        <li><?php echo $this->Html->link('Users', '/users'); ?></li>
                        <li><a href="#">Link</a></li>
                      </ul>
                    <ul class="nav pull-right">
                       <?php 
                          if ($current_user) {
                              $count_product = count($this->Session->read('Product'));
                              echo "<li>{$this->Html->link("Cart ($count_product)", '/productorders/view')}</li>";
                            echo '<li class="divider-vertical"></li>';
                          }
                       ?> 
                      <li>
                          <?php
                              if ($current_user) { 
                                  echo $this->Html->link('Hello: '.$current_user['username'], '/users/logout');
                              } else {
                                  echo $this->Html->link('Xin vui long dang nhap he thong', '/users/login');
                              }
                           ?>
                      </li>
                   </ul>
                   </div>
                </div>
            </div>
        
		    
		    </div>
        
        <div id="content">

            <div class="container-fluid">
                <?php if (!$this->App->isAdmin($current_user)) { ?>
                <div id="myCarousel" class="carousel slide">
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>
                      <!-- Carousel items -->
                      <div class="carousel-inner">
                        <div class="item">
                            <?php echo "<img src='{$this->webroot}img/thumbnails/thum2.jpg'>";?>
                        </div>
                        <div class="active item">
                            <?php echo "<img src='{$this->webroot}img/thumbnails/thum4.jpg'>";?>
                        </div>
                        <div class="item">
                            <?php echo "<img src='{$this->webroot}img/thumbnails/thum5.jpg'>";?>
                        </div>
                      </div>
                      <!-- Carousel nav -->
                      <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                      <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                  </div>
                <?php } ?>
                
                <div class="row-fluid">
                    <div class="span3">
                        <!--Sidebar content-->
                        <ul class="nav nav-tabs nav-stacked">
                            <?php
                                $categories = $this->App->getObject('Categories');
                                foreach ($categories as $category) {
                                    echo '<li>'.$this->Html->link(
                                        $category['Categories']['name'], '/devices/index/'.$category['Categories']['id']
                                    ).'</li>';
                                }
                            ?>
                            <li><?php echo $this->Html->link('All Product', '/devices'); ?></li>
                        </ul>
                        <div class="fb-like" data-href="https://www.facebook.com/pages/Webviet1234/450363101744588" data-width="280" data-show-faces="true" data-send="true"></div>
                    </div>
                    <div class="span9" style="float: right !important;">
                    <div id="hook">
<div id="loader">
<div class="spinner"></div>
</div>
<span id="hook-text">Reloading...</span>
</div>
                      <!--Body content-->
                        <?php echo $this->Session->flash(); ?>

                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
			
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
