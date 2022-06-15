<h1><?= $title ?></h1>
<h2 id="competition" class="mt-4">Competition 10.00 AM - 4.00 PM</h2>
<div class="table-responsive">
<table class="table table-bordered table-timetable table-hover">
<thead class="thead-light"><th>Sports</th><th>2 August</th><th>3 August</th><th>4 August</th><th>5 August</th><th>6 August</th><th>7 August</th><th>8 August</th></thead>
<?php foreach ($compeition as $row) : ?>
<tr>
  <td><a href="<?php echo base_url("timetable/sports/".$row->sport_slug); ?>/1"><?php echo $row->sport_name; ?></a></td>

  <td>
    <?php if(!empty($row->{'2020 2 August'})): ?>
    <a class="imgChg" data-toggle="tooltip" title="<?php echo $row->{'2 August Winner'}; ?>"
      href="<?php echo base_url("timetable/book/".$row->{'2020 2 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 3 August'})): ?>
    <a class="imgChg" data-toggle="tooltip" title="<?php echo $row->{'3 August Winner'}; ?>"
      href="<?php echo base_url("timetable/book/".$row->{'2020 3 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 4 August'})): ?>
    <a class="imgChg" data-toggle="tooltip" title="<?php echo $row->{'4 August Winner'}; ?>"
      href="<?php echo base_url("timetable/book/".$row->{'2020 4 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 5 August'})): ?>
    <a class="imgChg" data-toggle="tooltip" title="<?php echo $row->{'5 August Winner'}; ?>"
      href="<?php echo base_url("timetable/book/".$row->{'2020 5 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 6 August'})): ?>
    <a class="imgChg" data-toggle="tooltip" title="<?php echo $row->{'6 August Winner'}; ?>"
      href="<?php echo base_url("timetable/book/".$row->{'2020 6 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 7 August'})): ?>
    <a class="imgChg" data-toggle="tooltip" title="<?php echo $row->{'7 August Winner'}; ?>"
      href="<?php echo base_url("timetable/book/".$row->{'2020 7 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 8 August'})): ?>
    <a class="imgChg" data-toggle="tooltip" title="<?php echo $row->{'8 August Winner'}; ?>"
      href="<?php echo base_url("timetable/book/".$row->{'2020 8 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" hei8ght="32" ></a>
    <?php endif; ?>
  </td>

</tr>
<?php endforeach; ?>
</table>
</div>

<h2 id="class" class="mt-4">Class  4.00 PM - 10.00 PM</h2>
<div class="table-responsive">
<table class="table table-bordered table-timetable table-hover">
<thead class="thead-light"><th>Sports</th><th>2 August</th><th>3 August</th><th>4 August</th><th>5 August</th><th>6 August</th><th>7 August</th><th>8 August</th></thead>
<?php foreach ($class as $row) : ?>
<tr>
  <td><a href="<?php echo base_url("timetable/sports/".$row->sport_slug); ?>/2"><?php echo $row->sport_name; ?></a></td>

  <td>
    <?php if(!empty($row->{'2020 2 August'})): ?>
    <a class="imgChg" href="<?php echo base_url("timetable/book/".$row->{'2020 2 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 3 August'})): ?>
    <a class="imgChg" href="<?php echo base_url("timetable/book/".$row->{'2020 3 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 4 August'})): ?>
    <a class="imgChg" href="<?php echo base_url("timetable/book/".$row->{'2020 4 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 5 August'})): ?>
    <a class="imgChg" href="<?php echo base_url("timetable/book/".$row->{'2020 5 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 6 August'})): ?>
    <a class="imgChg" href="<?php echo base_url("timetable/book/".$row->{'2020 6 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 7 August'})): ?>
    <a class="imgChg" href="<?php echo base_url("timetable/book/".$row->{'2020 7 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

  <td>
    <?php if(!empty($row->{'2020 8 August'})): ?>
    <a class="imgChg" href="<?php echo base_url("timetable/book/".$row->{'2020 8 August'}); ?>">
    <img src="<?php echo base_url('assets/images/icon_circle.svg'); ?>" width="16" height="32" ></a>
    <?php endif; ?>
  </td>

</tr>
<?php endforeach; ?>
</table>
</div>


<h1><?= $title2 ?></h1>
<ul class="sports_row row">
<?php foreach($sports as $sport) : ?>
  <li class="sports_item col-4 col-md-2">
    <a class="sports_link" href="<?php echo site_url('timetable/sports/'.$sport['sport_slug']); ?>">
      <div class="sports_pic">
        <img class="image_responsive d-block" src="<?php echo site_url(); ?>assets/images/sports/<?php echo $sport['sport_img']; ?>"
          onerror="this.onerror=null;this.src='<?php echo site_url(); ?>assets/images/noimage.jpg';">
      </div>
      <h4 class="sports_title">
          <?php echo $sport['sport_name']; ?>
      </h4>
    </a>
  </li>
<?php endforeach; ?>
</ul>
