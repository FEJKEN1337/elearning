<br>
<div class="row">
    <div class=span4>
        <a href="http://elearning.ron.int/"><img src="/le/assets/img/01.png"></a>
    </div>
    <div class=span4>
        <a href="http://elearning.ron.int/"><img src="/le/assets/img/02.png"></a>
    </div>
    <div class=span4>
        <a href="http://elearning.ron.int/"><img src="/le/assets/img/03.png"></a>
    </div>

</div>

<br><br><br>



<!--<table border="1">-->

          <!-- Dla każdego wpisu wykonujemy pętlę -->
            <?php foreach ($posts as $p): ?>


       <?php echo "<h4>".nl2br(htmlspecialchars($p['temat'])) . "</h4>"; ?>
       <?php echo nl2br(htmlspecialchars($p['tresc'])); ?>




      <?php echo nl2br(htmlspecialchars($p['id'])); ?>
      <?php echo "<!-- <br>"
                . "<a href=" .site_url('setup'). "/s_artykul?id=".$p['id']."><i class=icon-edit></i></a>-->"
                . "<br><hr>" ?>

       <?php


       ?>






         <?php endforeach; ?>