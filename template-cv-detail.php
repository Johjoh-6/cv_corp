<?php
/* Template Name: CV Detail*/

get_header(); 
//For get the current user
$id_user = get_current_user_id();
$meta_user = get_user_meta($id_user);

//For get the current CV
$id_cv = $_GET['cv'];
$cv = getCvById($id_cv);
debug($cv);
?>

<h1>cv details</h1>

<section id="pdf-cv">
    <div id="pdf-cv_model">
        <div id="pdf-cv_info_box">
            <img id="pdf-cv_img" src="<?= !empty($cv->id_picture) ? wp_get_attachment_image_url($cv->id_picture, 'img_compte') : ''; ?>" alt="photo de <?= !empty($cv->user_lastname) ?  $cv->user_lastname : '';?>">
            <div id="pdf-cv_info">
                <p>Nom : <?= !empty($cv->user_lastname) ?  $cv->user_lastname : ''; ?></p>
                <p>Prénom : <?= !empty($cv->user_firstname) ? $cv->user_firstname : ''; ?></p>
                <p>Email : <?= !empty($cv->user_email) ? $cv->user_email : '' ; ?></p>
                <p>Tél : <?=  !empty($cv->user_phone) ? $cv->user_phone : ''; ?></p>
                <p>Adresse : <?= !empty($cv->user_adress) ? $cv->user_adress : ''; ?></p>
            </div>
        </div>
        <div id="pdf-cv_box">
            <div>
                <?php if(!empty($cv->langues)){ ?>
                <div id="pdf-cv_langue">
                    <h3>Langue</h3>
                    <ul>
                    <?php foreach($cv->langues as $langue){ ?>
                        <li>
                            <p><?= $langue['langue_name'];?></p>
                            <span><?= $langue['langue_level'];?></span>
                        </li>
                   <?php }?>
                   </ul>
                </div>
                <?php } 
                if(!empty($cv->skills)){ ?>
                <div id="pdf-cv_skill">
                    <h3>Skill</h3>
                    <ul>
                    <?php foreach($cv->skills as $skill){ ?>
                        <li>
                            <p><?= $skill['skill_name'];?></p>
                            <span><?= $skill['skill_level'];?></span>
                        </li>
                   <?php }?>
                   </ul>
                </div>
                <?php } 
                if(!empty($cv->hobbie)){ ?>
                <div id="pdf-cv_hobbie">
                    <h3>Hobbie</h3>
                    <ul>
                    <?php foreach($cv->hobbie as $hobbie){ ?>
                        <li>
                            <p><?= $hobbie['hobbie_name'];?></p>
                            <span><?= $hobbie['hobbie_details'];?></span>
                        </li>
                   <?php }?>
                   </ul>
                </div>
                <?php } ?>
            </div>
            <div>
                <?php if(!empty($cv->experience)) { ?>
                <div id="pdf-cv_exp_list">
                    <h3>Épérience Professionnel</h3>
                    <?php 
                    $experiences = array_slice($cv->experience, -3, 3, true);
                    foreach($experiences as $experience) { ?>
                        <div class="pdf-cv_exp_box">
                            <h4><?= $experience['job_name'];?></h4>
                            <p><?= $experience['company_name'];?></p>
                            <p><?= $experience['date_start'];?> - <?= $experience['date_end'];?></p>
                            <p><?= $experience['details'];?></p>
                        </div>
                     <?php 
                    }
                    ?>
                </div>
                <?php } if(!empty($cv->studies)){ ?>
                <div id="pdf-cv_studie_list">
                    <h3>Formation et Diplôme</h3>
                    <?php 
                    $studies = array_slice($cv->studies, -3, 3, true);
                    foreach($studies as $study) { ?>
                        <div class="pdf-cv_studie_box">
                            <h4><?= $study['study_name'];?></h4>
                            <p><?= $study['school_name'];?></p>
                            <p><?= $study['school_location'];?></p>
                            <p><?= $study['date_start'];?> - <?= $study['date_end'];?></p>
                            <p><?= $study['study_details'];?></p>
                        </div>
                     <?php 
                    }
                    ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<button id="getPdf" data-fisrt-name="<?=  metaField($meta_user, 'first_name');?>" data-last-name="<?=  metaField($meta_user, 'last_name');?>">Click here</button>
<input type="hidden" name="jsonarray" value="<?= htmlspecialchars(json_encode($cv),ENT_QUOTES); ?>" id="jsonarray">


<?php get_footer();