<?php 
  if ($page->show_content()->toBool() != true) {
    $redirectUrl = $page->main_pdf()->toFile()->url();
    header("Location: " . $redirectUrl);
    exit();
  }
?>

<?php snippet('header'); ?>
  <div class="layout-wrapper--contained">
    <div class="student__title">
      <a href="<?= $site->url(); ?>">&larr; <?= $page->title() ?></a>
    </div>
  </div>
  <div class="layout-wrapper">
    <?php snippet('content', ['contentBlocks' => $page->main_content()->toBlocks()]); ?>
  </div>
<?php snippet('footer'); ?>
