<?php snippet('header'); ?>
  <div class="show__container">
    <div class="show" data-overlay="true">
      <?php snippet('students', ['studentList' => $site->index()->filterBy('intendedTemplate', 'senior')->listed()]) ?>
      <div class="show__overlay">
        <div class="text">
          <h2><?= $site->senior_title(); ?></h2>
          <h3><?= $site->senior_subtitle(); ?></h3>
        </div>
      </div>
    </div>
    <div class="show" data-overlay="true">
      <?php snippet('students', ['studentList' => $site->index()->filterBy('intendedTemplate', 'junior')->listed()]) ?>
      <div class="show__overlay">
        <div class="text">
          <h2><?= $site->junior_title(); ?></h2>
          <h3><?= $site->junior_subtitle(); ?></h3>
        </div>
      </div>
    </div>
  </div>
  <div class="overlay__button">
    <span class="overlay__button__text">i</span>
  </div>
  <div class="overlay">
    <div class="overlay__close">×</div>
    <div class="layout-wrapper--contained overlay__text text">
      <?= $site->about()->kt(); ?>
    </div>
  </div>
<?php snippet('footer'); ?>

<?php
  function getAverage($sourceURL){
    $img = @imagecreatefromstring(file_get_contents($sourceURL));
    $x = imagesx($img);
    $y = imagesy($img);
    $tmp_img = ImageCreateTrueColor(1,1);
    ImageCopyResampled($tmp_img,$img,0,0,0,0,1,1,$x,$y);
    $rgb = ImageColorAt($tmp_img,0,0);
    $r   = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b  =  $rgb & 0xFF;
    return sprintf('#%02X%02X%02X', $r, $g, $b); 
 }
?>

<script>
  document.addEventListener('DOMContentLoaded',() => {
    [].forEach.call(document.querySelectorAll('.show'), (s) => {
      [].forEach.call(s.querySelectorAll('.student__list__item a'), (a) => {
        a.addEventListener('mouseover', (e) => {
          s.style.setProperty('--bg-color', a.dataset.dominantColor);
        });
        a.addEventListener('mouseout', (e) => {
          s.style.removeProperty('--bg-color');
        });
        a.addEventListener('click', (e) => {
          if (s.dataset.overlay === 'true')
            e.preventDefault();
        })
      });

      s.addEventListener('click', (e) => {
        if (s.dataset.overlay === 'true') {
          e.stopPropagation();
          s.dataset.overlay = false;
        }
      })
    });

    const o = document.querySelector('.overlay');
    document.querySelector('.overlay__button').addEventListener('click',(e) => o.classList.add('overlay--active'));
    document.querySelector('.overlay__close').addEventListener('click',(e) => o.classList.remove('overlay--active'));
  });
</script>