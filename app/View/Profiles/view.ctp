<!-- File: /app/View/Profile/view.ctp -->

<h1><?php echo 'Profile of: '.($profile['User']['username']); ?></h1>

<h1><?php echo 'Name: '.($profile['Profile']['name']); ?></h1>

<p><?php echo 'Address: '.($profile['Profile']['address']); ?></p>

<p><small>Created: <?php echo $profile['Profile']['created']; ?></small></p>




            