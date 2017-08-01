<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!-- Include external files and scripts here (See HTML helper for more info.) -->
    <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('style');
    ?>
</head>
<body>
    <div class="main">
        <div class="header" style="font-family: Chalkduster, fantasy;font-size: 42px;; margin-bottom: -10px;">Photo Stock</div>
        <marquee style="color: white;margin-left: 100px;margin-right: 900px;margin-bottom: 50px;font-family: Comic Sans MS;font-size: 17px;"> Welcome in Photo Stock! Have a good day!</marquee>

        <div class="container">
            <?php //echo $this->Flash->render(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>

</body>
</html>