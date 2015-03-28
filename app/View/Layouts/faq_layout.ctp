<?php
    $cakeDescription = __d('cake_dev', 'IRBNet Support Portal');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
            echo $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon'));

            echo $this->Html->css(array('faq', 'jquery-ui.min'));
            echo $this->Html->script(array('jquery', 'jquery-ui-1.10.4.custom.min', 'Markdown_Converter', 'irbnet_admin'));

            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');

            echo $this->Js->writeBuffer();
        ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="folio">
                <div id="site_wrapper">
                    <div id="top_strip">
                        <div class="logo">
                            <?php echo $this->Html->image('irbnet.gif', array('alt' => 'IRBNet', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>
                        </div>
                        <div class="tagline">
                            <h1>&nbsp;<br />&nbsp;</h1><br />
                        </div>
                    </div>
                    <div id="navigation">
                    </div>
                    <div id="main_content">
                        <div id="left_col">
                            <div class="left_content">
                                <?php echo $this->Session->flash(); ?>
                                <?php echo $this->fetch('content'); ?>
                            </div>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div id="footer">
                        <p>Copyright &copy; 2002-2015 Research Dataware, LLC.&nbsp;&nbsp;&nbsp;All Rights Reserved.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
